<?php
class TutorDashboard extends Controller
{
    private ModelTutorDashboard $dashboardModel;
    private ModelStudentNotification $notificationModel;
    private ModelStudentRequest $requestModel;

    public function __construct()
    {
        $this->dashboardModel = $this->model('ModelTutorDashboard');
        $this->notificationModel = $this->model('ModelStudentNotification');
        $this->requestModel = $this->model('ModelStudentRequest');
    }

    public function dashboard(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        $data = [];

        //Fetch all the classes of this student
        $data['tutor_name'] = get_object_vars($this->dashboardModel->getTutorName($request->getUserId()));
        $data['active_class_count'] = json_encode($this->dashboardModel->countTutoringActiveClasses($request->getUserId()));
        $data['tutoring_class_template'] = json_encode($this->dashboardModel->getTutoringClassTemplates($request->getUserId()));
        $data['tutor_time_slots'] = json_encode($this->dashboardModel->getTutorTimeSlots($request->getUserId()));
        $data['payments'] = json_encode($this->dashboardModel->getAllPaymentDetails($request->getUserId()));

        $data['tutor_requests'] = json_encode($this->dashboardModel->getStudentRequests($request->getUserId()));

        $this->view('tutor/dashboard', $request, $data);
    }

    public function createClassTemplate(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }


        $data = ['modules' => []];

        //      Fetch all the visible subjects, modules and maximum class price
        $subjects = $this->dashboardModel->getVisibleSubjects(true);


        if (count($subjects) > 0) {
            $modules = $this->dashboardModel->getModulesBySubjectId($subjects[0]['id']);
        }

        if ($request->isPost()) {
            $body = $request->getBody();


            $data = [
                'id' => $request->getUserId(),
                'subject_id' => $body['subject'],
                'module_id' => $body['module'],
                'session_rate' => $body['session_rate'],
                'class_type' => $body['class_type'],
                'mode' => $body['mode'],
                'duration' => $body['duration'],
                'medium' => $body['medium'],

                'errors' => [
                    'session_rate_error' => '',
                    'class_template_duplipate_error' => ''
                ]

            ];

            //Validate all the fields
            $data['errors']['session_rate_error'] = validateRate($data['session_rate']);


            if ($data['errors']['session_rate_error'] == '') {

                if ($this->dashboardModel->getTutoringClassDetails($data) == 0) {
                    if ($this->dashboardModel->setTutorclassTemplate($data)) {
                        redirect('tutor/dashboard');
                    } else {
                        header("HTTP/1.0 500 Internal Server Error");
                        die('Something went wrong');
                    }
                } else {
                    $data['errors']['class_template_duplipate_error'] = 'Class Template Already Exists!';
                }
            }

            $data['subjects'] = $subjects;
            $data['modules'] = $modules;
            //        Get tutor's preferred class mode
            $data['preferred_mode'] = $this->dashboardModel->getTutorSelectedClassMode($request->getUserId())['mode'];

            $this->view('tutor/createcclasstemplate', $request, $data);

            //        If the request is a GET request, then serve the page
        } else {
            $data = [
                'id' => $request->getUserId(),
                'subjects' => $subjects,
                'modules' => $modules,
                'session_rate' => '',
                'class_type' => '',
                'mode' => '',
                'duration' => '',
                'medium' => '',

                'errors' => [
                    'session_rate_error' => '',
                    'class_template_duplipate_error' => ''
                ]

            ];
            //        Get tutor's preferred class mode
            $data['preferred_mode'] = $this->dashboardModel->getTutorSelectedClassMode($request->getUserId())['mode'];
        }

        $this->view('tutor/createcclasstemplate', $request, $data);
    }

    public function getModule(Request $request)
    {
        //      Cors support
        cors();

        $body = $request->getBody();

        $data = [
            'modules' => []
        ];

        $data['modules'] = $this->dashboardModel->getModulesBySubjectId($body['subject_id']);


        header('Content-type: application/json');
        echo json_encode($data['modules']);
    }

    //Student request component

    public function viewrequest(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        $data = [];

        $body = $request->getBody();


        if ($request->isPost()) {
            $body = $request->getBody();


            $data = [
                'id' => $body['id'],
                'c_id' => $body['c_id'],
                'mode' => $body['mode'],
                'student_id' => $body['student_id'],
                'tutor_id' => $body['tutor_id'],
                'date' => $body['date'],
                'time' => $body['time'],
                'duration' => $body['duration'],
                'rate' => $body['rate'],
                'time_slot_id'=> $body['time_slot_id'],
                'type' => $body['type'],
                'medium' => $body['medium'],
                'time_slot_list' => $body['time_slot_list']
            ];



            if ($this->dashboardModel->setClass($data)) {
                redirect('tutor/dashboard');
            } else {
                header("HTTP/1.0 500 Internal Server Error");
                die('Something went wrong');
            }
            $this->view('tutor/dashboard', $request);
        }

        $data['tutor_request'] = json_encode($this->dashboardModel->viewStudentRequests($body['id']));
        $data['time_slots'] = json_encode($this->dashboardModel->getRequestTimeSlots($body['id']));
      

        $this->view('tutor/viewstudentrequest', $request, $data);
    }

    public function requestDecline(Request $request)
    {

        $body = $request->getBody();

        if ($this->dashboardModel->declineStudentAproveRequest($body['id'])) {
//            Send a notification to student
            $studentId = $this->requestModel->getStudentIdByRequestId($body['id']);

            $this->notificationModel->createNotification(
                $studentId,
                "Your request has been declined",
                "#",
                "Requested tutor has declined your request");
            echo json_encode([
                "message" => "Data saved successfully",
                "id" => $body['id']
            ]);
        } else {
            echo json_encode([
                "message" => "Data not saved successfully",
                "id" => $body['id']
            ]);
        };
    }

    public function payment(Request $request)
    {

        $merchant_id = '1222629';
        $order_id = 3;
        $amount = 900;
        $currency = 'LKR';
        $student_id = 17;
        $tutor_id = 38;
        $merchant_secret = 'MzI5Mjg5NDU5OTM4MTgyMzMwMTYyODM1MjUyODE0MzI2MjYzNTE1Nw==';



        $items = 'Occilation_Waves';
        $first_name = 'Sachithra';
        $last_name = 'Kavinda';
        $email = 'test@gmail.com';
        $phone = '0765443312';
        $address = '143/43, Flower Road , Colombo';
        $city = 'Kandy';
      


        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );



        $data = [
            'order_id' => $order_id,
            'merchant_id' => $merchant_id,
            'amount' => $amount,
            'currency' => $currency,
            'items' => $items,
            'hash' => $hash,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' =>  $phone,
            'address' => $phone,
            'city' => $city,
            'address' => $address,
            'student_id' => $student_id,
            'tutor_id' => $tutor_id
        ];

        $this->view('tutor/payment', $request, $data);
    }

    public function savepayment()
    {
        $merchant_id         = $_POST['merchant_id'];
        $order_id            = $_POST['order_id'];
        $payhere_amount      = $_POST['payhere_amount'];
        $payhere_currency    = $_POST['payhere_currency'];
        $status_code         = $_POST['status_code'];
        $md5sig              = $_POST['md5sig'];
        $merchant_secret = 'MzI5Mjg5NDU5OTM4MTgyMzMwMTYyODM1MjUyODE0MzI2MjYzNTE1Nw==';

        $local_md5sig = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    $payhere_amount .
                    $payhere_currency .
                    $status_code .
                    strtoupper(md5($merchant_secret))
            )
        );

        $data['day_id'] = $order_id;
        $data['student_id'] = $_POST['custom_1'];
        $data['tutor_id'] = $_POST['custom_2'];
        $data['amount'] =  $payhere_amount;


        if (($local_md5sig === $md5sig) && ($status_code == 2) ){
            $this->dashboardModel->paymentUpdate($data);
    }
    }
}
