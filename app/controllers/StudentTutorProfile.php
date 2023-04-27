<?php

require_once ROOT . '/lib/phpmailer/src/Exception.php';
require_once ROOT . '/lib/phpmailer/src/PHPMailer.php';
require_once ROOT . '/lib/phpmailer/src/SMTP.php';

class StudentTutorProfile extends Controller {
    private ModelStudentReport $reportModel;
    private ModelStudentClassTemplate $classTemplateModel;
    private ModelStudentReview $reviewModel;
    private ModelStudentReportReason $reportReasonModel;
    private ModelTutorStudentAuth $userModel;

    public function __construct() {
        $this->reportModel = $this->model('ModelStudentReport');
        $this->classTemplateModel = $this->model('ModelStudentClassTemplate');
        $this->reviewModel = $this->model('ModelStudentReview');
        $this->reportReasonModel = $this->model('ModelStudentReportReason');
        $this->userModel = $this->model('ModelTutorStudentAuth');
    }

    public function tutorProfile(Request $request) {
//       Redirect user to login page if not logged in
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

//       Redirect user to correct page is user is not a student
        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
        }

        $body = $request->getBody();
        if (!(isset($body['template_id']) && $this->classTemplateModel->doesTemplateExist($body['template_id']))) {
//            TODO: Handle
            redirect('/not-found');
        }

        if (!isset($body['mode'])) {
            $body['mode'] = "none";
        }

        $data = [
            'template_id' => $body['template_id'],
            'mode' => $body['mode']
        ];


        $classTemplateData = $this->classTemplateModel->getClassTemplateById($body['template_id']);

//      Add required template data into $data[] array
        $data['profile_picture'] = $classTemplateData->profile_picture ?: '/public/img/common/profile.png';
        $data['module_name']  = $classTemplateData->module_name? : 'Not Available';
        $data['class_type']  = ucfirst($classTemplateData->class_type)? : 'Not Available';
        $data['name'] = $classTemplateData->first_name . " " . $classTemplateData->last_name;
            $data['tutor_id'] = $classTemplateData->user_id;

        switch ($classTemplateData->education_qualification) {
            case 'advanced-level':
                $data['education_qualification'] = 'Advanced Level';
                break;
            case 'bachelor-degree':
                $data['education_qualification'] = 'Bachelors Degree';
                break;
            case 'masters-degree':
                $data['education_qualification'] = 'Master Degree';
                break;
            default:
                $data['education_qualification'] = 'Not Specified';
                break;
        }

        $data['city'] = $classTemplateData->city ?: '';
        $data['duration'] = $classTemplateData->duration;
        $data['session_rate'] = $classTemplateData->session_rate;
        $data['description'] = $classTemplateData->description;
        $data['current_rating'] = $classTemplateData->current_rating;
        $data['mode_on_template'] = $classTemplateData->mode;

//      Get number of day of classTemplate
        $numberOfDays = $this->classTemplateModel->getNumberOfDayOfClass($body['template_id']);
        $data['number_of_days'] = $numberOfDays ? $numberOfDays : 0;

//      Get all reviews
        $data['reviews'] = $this->reviewModel->getReviewsWithDescriptionByTemplateId($body['template_id']);

//      Get all the report reasons to report a tutor
        $data['report_reasons'] = $this->reportReasonModel->getStudentReportReason();

//      Get all the other class templates this tutor
        $tutorId = $this->classTemplateModel->getTutorIdByClassTemplateId($data['template_id']);
        $otherClasses = $this->classTemplateModel->getClassTemplateByTutorId($tutorId, $data['template_id']);

//      Format data
        foreach ($otherClasses as $key => $value) {
            $otherClasses[$key]['mode_display'] = ucfirst($value['mode']);
        }

        $data['other_classes'] = $otherClasses;
        $this->view('student/tutorProfile', $request, $data);



    }


    public function reportTutor(Request $request) {
//      Cors support
        cors();

//      Making a report is a POST
        if ($request->isPost()) {
//          Unauthorized error code
            if (!$request->isLoggedIn() || !$request->isStudent()) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

            $body = json_decode(file_get_contents('php://input'), true);
            $body['student_id'] = $request->getUserId();

//          Validate incoming payload
            $isError = false;

            if (
                !(isset($body['description']) &&
                    isset($body['tutor_id']) &&
                    isset($body['reason_id']))
            ) {
                $isError = true;
            }

            if ($isError) {
                header("HTTP/1.0 400 Bad Request");
                return;
            }

//          Check if the same student has submitted a report for same tutor that is not inquired
            if ($this->reportModel->doesReportExist($body)) {
                header("HTTP/1.0 403 Forbidden");
                return;
            }

//          If all the checks are passed, then make the report
            if ($this->reportModel->saveStudnetReport($body)) {
                header("HTTP/1.0 200 Success");
                return;
            }

            header("HTTP/1.0 500 Internal Server Error");

        }else {
//          This route has no get requests
            header("HTTP/1.0 404 Not found");
        }

    }

//    Initiate change password use case, sends an email to the user's email address
    public function changePasswordInitiate(Request $request) {
        cors();

        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        $code = generateCode();
        if (sendCodeAsEmail($request, $code)) {
            $this->userModel->setVerificationCode($request->getUserId(), $code);
            header("HTTP/1.0 200 Success");

        } else {
            header("HTTP/1.0 500 Internal Server Error");
        }

    }

//    confirms whether the user entered OTP code is valid or no
    public function changePasswordValidation(Request $request) {
        cors();

        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        $body = $request->getBody();
        if (!isset($body['code'])) {
            header("HTTP/1.0 400 Bad Request");
            return;
        }

        if (!$this->userModel->isCodeValid($request->getUserId(), $body)) {
            header("HTTP/1.0 403 Forbidden");
            return;
        }

        header("HTTP/1.0 200 Success");
    }
}