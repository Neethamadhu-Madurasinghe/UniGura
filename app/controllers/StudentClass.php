<?php

class StudentClass extends Controller {
    private ModelStudentTutoringClass $tutoringClassModel;
    private ModelActivity $activityModel;
    private ModelStudentReportReason $reportReasonModel;
    private ModelFeedback $feedbackModel;
    private ModelStudentReschedule $rescheduleModel;
    private ModelStudentTimeSlot $timeSlotModel;
    private ModelStudentNotification $notificationModel;
    private ModelUser $userModel;

    public function __construct() {
        $this->tutoringClassModel = $this->model('ModelStudentTutoringClass');
        $this->activityModel = $this->model('ModelActivity');
        $this->reportReasonModel = $this->model('ModelStudentReportReason');
        $this->feedbackModel = $this->model('ModelFeedback');
        $this->rescheduleModel = $this->model('ModelStudentReschedule');
        $this->timeSlotModel = $this->model('ModelStudentTimeSlot');
        $this->notificationModel = $this->model('ModelStudentNotification');
        $this->userModel = $this->model('ModelUser');
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

//            If the user is banned he cannot access this page
        if ($this->userModel->isBanned($request->getUserId())) {
            redirect('/logout');
            return;
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

//        Add payment detail for each DAY
        function mapDaysAndPaymentDetails($day) {
            $hash = strtoupper(
                md5(
                    MERCHANT_ID .
                    $day['id'] .
                    number_format($day['session_rate'], 2, '.', '') .
                    'LKR' .
                    strtoupper(md5(MERCHANT_SECRET))
                )
            );

            $day['payment'] = [
                'order_id' => $day['id'],
                'items' => $day['title'],
                'hash' => $hash,
            ];

            return $day;
        }

        $data['days'] = array_map('mapDaysAndPaymentDetails', $data['days']);

//        Add all the payment data
        $data['payment'] = [
            'amount' => $data['session_rate'],
            'merchant_id' => MERCHANT_ID,
            'notify_url' => tunnel_link,
            'return_url' => URLROOT . '/student/tutoring-class?id=' . $data['id'],
            'cancel_url' => URLROOT . '/student/tutoring-class?id=' . $data['id'],
            'currency' => 'LKR',
            'first_name' => 'samplefirstname',
            'last_name' => 'samplelastname',
            'email' => 'sample@gmail.com',
            'phone' =>  '0000000000',
            'address' => 'sampleaddress',
            'city' => 'city',
            'student_id' => $data['student_id'],
            'tutor_id' => $data['tutor_id']
        ];

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

            //           Check whether time slots are consecutive
            $previousTimeSlot = [];
            for ($i = 1; $i < count($body['time_slots']); $i++) {
                if ($i == 1) {
                    $previousTimeSlot = $this->timeSlotModel->getTimeSlot($body['time_slots'][$i - 1]);
                }
                $currentTimeSlot = $this->timeSlotModel->getTimeSlot($body['time_slots'][$i]);

                if (
                    $currentTimeSlot['day'] != $previousTimeSlot['day'] ||
                    abs(getTimeDifference($previousTimeSlot['time'], $currentTimeSlot['time'])) != 2
                ) {
                    $isValid = false;
                }

                $previousTimeSlot = $currentTimeSlot;
            }


            if ($isValid) {
                if ($this->rescheduleModel->reschedule($body)) {
//                    Send a notification to tutor
                    $this->notificationModel->createNotification(
                        $body['tutor_id'],
                        "A Student has rescheduled a class"
                    );
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

    public function toggleActivityComplete(Request $request) {
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
                !isset($body['activity_id']) ||
                !isset($body['is_select'])
            ) {
                $isValid = false;
            }

//            Check if the user has access to this activity
            function mapActivityToID($activity) {
                return $activity['id'];
            }
//            Get all the activities user is related to and map them to their id and check a requested id is in it
            $activities = $this->activityModel->getAllActivitiesByUser($request->getUserId());
            $activityIds = array_map('mapActivityToID', $activities);

            if (isset($body['activity_id']) && !in_array($body['activity_id'], $activityIds)) {
                $isValid = false;
            }

            if ($isValid) {
                if ($this->activityModel->setActivityCompletion($body['activity_id'], $body['is_select'])) {
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

// Just a helper function to get a different between two times in hours
function getTimeDifference($start_time, $end_time) {
    $start = strtotime($start_time);
    $end = strtotime($end_time);
    $diff = $end - $start;
    return floor($diff / (60 * 60));;
}