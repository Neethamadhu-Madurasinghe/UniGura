<?php



class TutorPending extends Controller
{
    private ModelTutorPending $tutorPendingModel;

    public function __construct()
    {
        $this->tutorPendingModel = $this->model('ModelTutorPending');
    }

    public function tutorPending(Request $request)
    {


        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $is_approved = $this->tutorPendingModel->getTutorRole($_SESSION['user_id']);
        if ($is_approved == 1) {
            $_SESSION['user_role'] = 8;
            $this->tutorPendingModel->setUserRole($request->getUserId(), 8);
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }


        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isTutor()) {
            redirectBasedOnUserRole($request);
        }

        $username = $this->tutorPendingModel->getTutorName($_SESSION['user_id']);

        $data = [
            'user_name' => $username
        ];

        $this->view('tutor/pending', $request, $data);

        // need to check if the tutor is approved

    }



    public function tutorAproved(Request $request)
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

        if ($request->isTutor()) {
            redirectBasedOnUserRole($request);
        }


        $username = $this->tutorPendingModel->getTutorName($_SESSION['user_id']);

        $data = [
            'user_name' => $username
        ];

        $this->view('tutor/approve', $request, $data);
    }

    public function tutorCompleteBankDetials(Request $request)
    {
        //      If the user is not a student who has not completed the profile details, redirect him
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }
        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($_SESSION['user_role'] !== 9) {
            $_SESSION['user_role'] = 9;
            $this->tutorPendingModel->setUserRole($request->getUserId(), 9);
        }



        if ($request->isPost()) {
            $body = $request->getBody();


            $data = [
                'bank' => $body['bank'],
                'account_number' => $body['account-number'],
                'account_name' => $body['account-name'],
                'branch' => $body['branch'],
                'errors' => [
                    'account_number_error' => '',
                    'account_name_error' => '',
                    'branch_error' => '',
                    'bank_error' => ''
                ]
            ];

            //           Validate all the fields -- must implement

            $hasErrors = FALSE;

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }
            if (!$hasErrors) {
                //              Not storing user's location if he selected online mode
                $tutor_id = $request->getUserId();
                if ($this->tutorPendingModel->setTutorBankDetails($data, $tutor_id) && $this->tutorPendingModel->setUserRole($tutor_id, 10)) {
                    $_SESSION['user_role'] = 1;
                    redirect('tutor/tutor-time-slot-input');
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }
            }

            $this->view('tutor/completebankdetails', $request, $data);

            //        If the request is a GET request, then serve the page
        } else {
            $data = [
                'id' => $request->getUserId(),
                'bank' => "",
                'account_number' => "",
                'account_name' => "",
                'branch' => "",
                'time_slots' => "",
                'errors' => [
                    'account_number_error' => '',
                    'account_name_error' => '',
                    'branch_error' => '',
                    'bank_error' => ''
                ]
            ];
        }

        $this->view('tutor/completebankdetails', $request, $data);
    }


    public function tutorTimeSlotInput(Request $request)
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

        if ($request->isTutor()) {
            redirectBasedOnUserRole($request);
        }

        echo $_SESSION['user_role'];

        $this->view('tutor/timeslotinputform', $request);
    }



    public function help(Request $request)
    {
        $body = file_get_contents('php://input');
        $array = json_decode($body, true);

        // Now you can access the elements of the JavaScript array in the PHP script
        $data = $array['data'];

        // Do something with the data, such as saving it to a database



        $tutor_id = $request->getUserId();


        $model_data = $this->tutorPendingModel->setTutorTimeSlots($data, $tutor_id);
        $model_user = $this->tutorPendingModel->setUserRole($tutor_id, 1);
        $_SESSION['user_role'] = 1;
        

        echo json_encode([
            "message" => "Data saved successfully"
        ]);

        

        
    }
}
