<?php

class StudentClass extends Controller {
    private ModelStudentTutoringClass $tutoringClassModel;
    private ModelActivity $activityModel;
    private ModelStudentReportReason $reportReasonModel;
    private ModelFeedback $feedbackModel;

    public function __construct() {
        $this->tutoringClassModel = $this->model('ModelStudentTutoringClass');
        $this->activityModel = $this->model('ModelActivity');
        $this->reportReasonModel = $this->model('ModelStudentReportReason');
        $this->feedbackModel = $this->model('ModelFeedback');
    }

    public function tutoringClass(Request $request) {
        $data = [
            'errors' => [
                'assignment_document_error' => '',
                'activity_id_error' => ''
            ]
        ];
        //      Student should be logged in
        if (!$request->isLoggedIn()) {
            redirect('/login');
            die;
        }

        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
            die;
        }

        $body = $request->getBody();

//        If body does not contain a class id, then redirect user to home page
        if (!isset($body['id'])) {
            redirect('/student/dashboard');
            die;
        }

//        Check if the student has access to the requested tutoring class
        function mapTutoringClassToID($tutoringClass) {
            return $tutoringClass['id'];
        }
        $allTutoringClasses = $this->tutoringClassModel->getTutoringClassByStudentId($request->getUserId());
        $allTutoringClassesId = array_map('mapTutoringClassToID', $allTutoringClasses);

        if (!in_array($body['id'], $allTutoringClassesId)) {
            redirect('/student/dashboard');
            die;
        }


//        If the request is a POST request then get the file student is trying to upload
        if ($request->isPost()) {

            $assignmentDocumentPath = handleUpload(
                array('.png', 'jpeg', 'jpg', 'JPG', 'pdf', 'docx'),
                '\\user_files\\',
                'assignment-file'
            );

            $data['errors']['assignment_document_error'] = validateFilePath(
                $assignmentDocumentPath,
                'Error uploading the file'
            );

            if (!isset($body['activity-id'])) {
                $data['errors']['activity_id_error'] = "Please send a valid activity";
            }
            $data['activity_id'] = $body['activity-id'];

//            Check if the user has access to this activity
            function mapActivityToID($activity) {
                return $activity['id'];
            }
//            Get all the activities user is related to and map them to their id and check a requested id is in it
            $activities = $this->activityModel->getAllActivitiesByUser($request->getUserId());
            $activityIds = array_map('mapActivityToID', $activities);
            if (isset($data['activity_id']) && !in_array($data['activity_id'], $activityIds)) {
                $data['errors']['activity_id_error'] = "Please send a valid activity";
            }

            if ($data['errors']['assignment_document_error'] != '' && $data['errors']['activity_id_error'] != '') {
                unlink(ROOT . $assignmentDocumentPath);
                redirect('/student/dashboard');
                die;
            }

//            If no error occurred, save the document
            try {
                $this->activityModel->setActivityDocument($data['activity_id'], $assignmentDocumentPath);
            }catch (Exception $e) {
                unlink(ROOT . $assignmentDocumentPath);
                echo $e;
                die;
            }

        }

        //        Once validation has completed (optionally , POST request is server), get the required data

        $data = $this->tutoringClassModel->getFullTutoringClassDetails($body['id']);
        $data['report_reasons'] = $this->reportReasonModel->getStudentReportReason();
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        $this->view('/student/tutoringClass', $request, $data);
    }

    public function createReview(Request $request) {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);

        if (!$request->isLoggedIn() || !$request->isStudent()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
            //        validate
            $isValid = true;
            if (
                !isset($body['tutoring_class_id']) ||
                !isset($body['rating']) ||
                !isset($body['description'])
            ) {
                $isValid = false;
            }

            if ($body['rating'] > 5) {
                $isValid = false;
            }


            $tutoringClass = $this->tutoringClassModel->getFullTutoringClassDetails($body['tutoring_class_id']);
            if (isset($tutoringClass['template'])) {
                $isValid = false;
            }


            if ($isValid) {
                if ($this->feedbackModel->createReview(
                    $tutoringClass['tutor_id'],
                    $request->getUserId(),
                    $tutoringClass['class_template_id'],
                    $body['rating'],
                    $body['description']
                )) {
                    header("HTTP/1.0 200 Success");
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                }
            } else {
                header("HTTP/1.0 400 Bad Request");
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }


    }

}