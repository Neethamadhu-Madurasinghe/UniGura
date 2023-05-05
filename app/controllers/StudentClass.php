<?php

class StudentClass extends Controller {
    private ModelStudentTutoringClass $tutoringClassModel;
    private ModelActivity $activityModel;
    private ModelStudentReportReason $reportReasonModel;
    private ModelFeedback $feedbackModel;
    private ModelStudentReschedule $rescheduleModel;
    private ModelStudentTimeSlot $timeSlotModel;

    public function __construct() {
        $this->tutoringClassModel = $this->model('ModelStudentTutoringClass');
        $this->activityModel = $this->model('ModelActivity');
        $this->reportReasonModel = $this->model('ModelStudentReportReason');
        $this->feedbackModel = $this->model('ModelFeedback');
        $this->rescheduleModel = $this->model('ModelStudentReschedule');
        $this->timeSlotModel = $this->model('ModelStudentTimeSlot');
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
        $data['date'] = $this->convertShortDayToFullDay($data['date']);
        $data['time'] = $this->convertTimeTo12HourFormat($data['time']);
        $data['report_reasons'] = $this->reportReasonModel->getStudentReportReason();
        $data['does_reschedule_exit'] = $this->rescheduleModel->doesRequestExist($body['id']);
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

    public function requestReschedule(Request $request) {
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
                !isset($body['class_id']) ||
                !isset($body['duration']) ||
                !isset($body['tutor_id']) ||
                count($body['time_slots']) != $body['duration'] /2
            ) {
                $isValid = false;
            }

//           Check the validity of timeslots
//           Check whether each slot is a free slot
            foreach ($body['time_slots'] as $timeSlotId) {
                if (!$this->timeSlotModel->isTimeSlotFree($timeSlotId)) {
                    $isValid = false;
                }
            }

//          Check if the rescheduling request has been sent previously
            if ($this->rescheduleModel->doesRequestExist($body['class_id'])) {
                header("HTTP/1.0 403 Forbidden");
                return;
            }

            if ($isValid) {
                if ($this->rescheduleModel->makeRequest($body)) {
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

    public function cancelReschedule(Request $request) {
        cors();

//      Sending a tutor request is a POST
        if ($request->isPost()) {
//          Unauthorized error code
            if (!$request->isLoggedIn() || !$request->isStudent()) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

            $body = json_decode(file_get_contents('php://input'), true);
            $body['student_id'] = $request->getUserId();

//            Validate request
            if (!isset($body['class_id'])) {
                header("HTTP/1.0 400 Bad Request");
                return;
            }

//        Check if the student has access to the corresponding rescheduling request
            function mapTutoringClassToID($tutoringClass) {
                return $tutoringClass['id'];
            }
            $allTutoringClasses = $this->tutoringClassModel->getTutoringClassByStudentId($request->getUserId());
            $allTutoringClassesId = array_map('mapTutoringClassToID', $allTutoringClasses);

            if (!in_array($body['class_id'], $allTutoringClassesId)) {
                header("HTTP/1.0 400 Bad Request");
                return;
            }

//            Delete the request
            if ($this->rescheduleModel->deleteRequestByClassId($body['class_id'])) {
                header("HTTP/1.0 200 Success");
            }else {
                header("HTTP/1.0 500 Internal Server Error");
            }
        }
    }

//    Helper function for format dates
    private function convertShortDayToFullDay(string $shortDay): string {
        switch(strtolower($shortDay)) {
            case 'mon':
                return 'Monday';
                break;
            case 'tue':
                return 'Tuesday';
                break;
            case 'wed':
                return 'Wednesday';
                break;
            case 'thu':
                return 'Thursday';
                break;
            case 'fri':
                return 'Friday';
                break;
            case 'sat':
                return 'Saturday';
                break;
            case 'sun':
                return 'Sunday';
                break;
            default:
                return false; // Return false if an invalid short day name is provided
        }
    }

//    Helper function for format times
    private function convertTimeTo12HourFormat($time) {
        // Convert time to DateTime object
        $dateTime = new DateTime($time);

        // Format time as 12-hour format with AM/PM indicator
        $formattedTime = $dateTime->format('g:i A');

        return $formattedTime;
    }


}