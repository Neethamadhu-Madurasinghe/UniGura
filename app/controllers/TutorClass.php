<?php
class TutorClass extends Controller
{
    private ModelTutorClass $classModel;
    public function __construct()
    {
        $this->classModel = $this->model('ModelTutorClass');
    }
    public function mainpage(Request $request)
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


        $data['tutor_classes'] = json_encode($this->classModel->getTutoringClasses($request->getUserId()));


        $this->view('tutor/classes', $request, $data);
    }

    public function getclassdetails(Request $request)
    {
        $body = $request->getBody();

        $data = $this->classModel->getsingleclassdetails(intval($body['id']));  //class id pass as the body id
        $days = $this->classModel->getTutoringClassDays(intval($body['id']));
        $activities = $this->classModel->getActivities(intval($body['id']));

        header('Content-Type: application/json');
        echo json_encode([
            "data" => $data,
            "days" => $days,
            "activities" => $activities

        ]);
    }

    public function day_unhide(Request $request)
    {
        $body = $request->getBody();

        if ($this->classModel->setIshidden($body['id'])) {
            echo json_encode([
                "message" => "Day Unhideded"
            ]);
        } else {
            echo json_encode([
                "message" => "Day Hided"
            ]);
        };
    }

    public function addActivity(Request $request)
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



        if ($request->isGet()) {
            $data = [];

            $body = $request->getBody();

            $data = [
                'id' => $body['id']
            ];

            $this->view('tutor/classaddactivity', $request, $data);
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $activityPath = handleUpload(
                array('pdf'),
                '\\user_files\\',
                'activity-doc'
            );

            $data = [
                'id' => $body['id'],
                'link' => $activityPath,
                'type' => $body['type'],
                'description' => $body['description']
            ];

            if ($this->classModel->setActivity($data)) {
                redirect('tutor/classes', $request, $data);
            }
        }

        //        If the request is a GET request, then serve the page
    }

    public function markdayashide(Request $request)
    {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);


        if (!$request->isLoggedIn() || !$request->isTutor()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
          
            if (isset($body['day_id'])) {
                $this->classModel->markDayAsHiden($body['day_id']);
            }else{
                echo "Error". $body['day_id'];
            }
        }
    }

    public function markdayasunhide(Request $request)
    {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);


        if (!$request->isLoggedIn() || !$request->isTutor()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
          
            if (isset($body['day_id'])) {
                $this->classModel->markDayAsUnHiden($body['day_id']);
            }else{
                echo "Error". $body['day_id'];
            }
        }
    }


    public function markdayascomplete(Request $request)
    {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);


        if (!$request->isLoggedIn() || !$request->isTutor()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
          
            if (isset($body['day_id'])) {
                $this->classModel->markDayAsComplete($body['day_id']);
            }else{
               
            }
        }
    }


    public function createcustomday(Request $request)
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

        //Fetch all the visible subjects, modules and maximum class price

        if ($request->isGet()) {
            $body = $request->getBody();
            $position_count = $this->classModel->getDayCounts($body['id']);
            $position_count =  $position_count + 1;
            $data = [
                'id' => $body['id'],
                'title' => "",
                'position' => $position_count,
                'errors' => [
                    'title_error' => ""
                ]
            ];
        };


        if ($request->isPost()) {
            $body = $request->getBody();
            $data = [];
            $data = [
                'id' => $body['id'],
                'title' => $body['title'],
                'position' => $body['position'],
                'errors' => [
                    'title_error' => ""
                ]
            ];

            $data['errors']['title_error'] = $this->validateTitle($body['title'], $body['id']);


            $hasErrors = FALSE;

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if (!$hasErrors) {

                if ($this->classModel->setClassDay($data)) {
                    redirect('tutor/classes');
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }

                $this->view('tutor/createcustomday', $request, $data);

                //If the request is a GET request, then serve the page

            } else {
                $this->view('tutor/createcustomday', $request, $data);
            }
        }

        $this->view('tutor/createday', $request, $data);
    }


    public function validateTitle(string $name, $c_id): String
    {
        if (empty($name)) {
            return 'Please enter a valid name';
        } elseif ($this->classModel->findDayByName($name, $c_id)) {
            return 'Title Already Exist';
        } else {
            return '';
        }
    }
}
