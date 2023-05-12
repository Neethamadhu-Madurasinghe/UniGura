<?php
class TutorCourse extends Controller
{

    private ModelTutorCourse $courseModel;


    public function __construct()
    {
        $this->courseModel = $this->model('ModelTutorCourse');
    }

    public function viewcourse(Request $request)
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
        $days = json_encode($this->courseModel->getTutoringClassTemplateDays($body['id']));

        $details = $this->courseModel->getTutoringClassTemplateDetails($body['id']);
        $subject = $this->courseModel->getSubjectName($details[0]['subject_id']);
        $module = $this->courseModel->getModuleName($details[0]['module_id']);

        if ($request->isGet()) {
            $data = [
                'id' => $body['id'],
                'subject' => $subject[0]['subject'],
                'module' =>  $module[0]['module'],
                'mode' => $details[0]['mode'],
                'days' => $days,
                'tutor_id' => $details[0]['tutor_id'],
                'is_hidden'=>$details[0]['is_hidden']
            ];
        };

        $days = $this->courseModel->getTutoringClassTemplateDays($data['id']);
        $activities = $this->courseModel->getActivities($data['id']);

        $data['days'] = $days;
        $data['activities'] = $activities;

        $this->view('tutor/course', $request, $data);
    }



    public function createDay(Request $request)
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
            $position_count = $this->courseModel->getDayCounts($body['class_template_id']);
            $position_count = $position_count + 1;
            $data = [
                'id' => $body['class_template_id'],
                'title' => "",
                'position' => $position_count,
                'subject' => $body['subject'],
                'module'=> $body['module'],
                'errors' => [
                    'title_error' => "",
                    "position_error" => ""
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
                    'title_error' => "",
                    'position_error' => ""
                ]
            ];

            $data['errors']['title_error'] = $this->validateTitle($body['title'],$body['id']);
            $data['errors']['position_error'] = $this->validatePosition($body['position'], $body['id']);

       


            $hasErrors = FALSE;

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if (!$hasErrors) {

                if ($this->courseModel->setClassTemplateDay($data)) {
                    redirect('tutor/viewcourse?id=' . $data['id']);
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }

                $this->view('tutor/createday', $request, $data);

                //If the request is a GET request, then serve the page

            } else {
                $this->view('tutor/createday', $request, $data);
            }
        }

        $this->view('tutor/createday', $request, $data);
    }

    public function sendposition(Request $request)
    {
        $body = file_get_contents('php://input');
        $array = json_decode($body, true);

        // Now you can access the elements of the JavaScript array in the PHP script
        $data = $array['data'];

        // Do something with the data, such as saving it to a database

        $model_data = $this->courseModel->setDayPosition($data);

        echo json_encode([
            "message" => "Data saved successfully"
        ]);
    }


    public function validateTitle(string $name,$c_id): String
    {
        if (empty($name)) {
            return 'Please enter a valid name';
        } elseif ($this->courseModel->findDayByName($name,$c_id)) {
            return 'Title Already Exist';
        } else {
            return '';
        }
    }

    public function validatePosition(string $name, string $id): String
    {
        if (empty($name) || !preg_match("/^[0-9]*$/", $name)) {
            return 'Position must be a valid numeber';
        } elseif ($this->courseModel->findDayPosition($name, $id)) {
            return 'Position Already Exist';
        } else {
            return '';
        }
    }


    public function updateClassTemplate(Request $request)
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

            $details = $this->courseModel->getTutoringClassTemplateDetails($body['id']);

            $data = [
                'id' => $body['id'],
                'mode' => $details[0]['mode'],
                'session_rate' => $details[0]['session_rate'],
                'duration' => $details[0]['duration'],
                'errors' => [
                    'session_rate_error' => ''
                ]
            ];

            $this->view('tutor/updateclasstemplate', $request, $data);
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $data = [
                'id' => $body['id'],
                'session_rate' => $body['session_rate'],
                'mode' => $body['mode'],
                'duration' => $body['duration'],
                'errors' => [
                    'session_rate_error' => ''
                ]

            ];

            //Validate all the fields
            $data['errors']['session_rate_error'] = validateRate($data['session_rate']);


            if ($data['errors']['session_rate_error'] == '') {

                if ($this->courseModel->updateClassTemplate($data)) {
                    redirect('tutor/dashboard');
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }
            }
            $this->view('tutor/updateclasstemplate', $request, $data);
        }



        //        If the request is a GET request, then serve the page
    }

    public function deleteClassTemplate(Request $request)
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
            echo $body['id'];
            $this->view('tutor/deleteclasstemplate', $request, $data);
        }

        if ($request->isPost()) {
            $body = $request->getBody();
            if ($this->courseModel->deleteClassTemplate($body['id'])) {
                redirect('tutor/dashboard');
            } else {
                header("HTTP/1.0 500 Internal Server Error");
                die('Something went wrong');
            }

            $this->view('tutor/deleteclasstemplate', $request, $data);
        }
        //        If the request is a GET request, then serve the page
    }

    public function addActivityTemplate(Request $request)
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
                'id' => $body['id'],
                'c_id' => $body['course_id'],
                'subject' => $body['subject'],
                'module' => $body['module']
            ];

            $this->view('tutor/addactivity', $request, $data);
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $activityPath = handleUpload(
                array( 'pdf'),
                '\\user_files\\',
                'activity-doc'
            );

            $data = [
                'id' => $body['id'],
                'activity' => $activityPath,
                'c_id' => $body['course_id'],
                'type' => $body['type'],
                'description' => $body['description']
            ];

            if ($this->courseModel->setActivityTemplate($data)) {
                redirect('tutor/viewcourse?subject='. $body['subject'] . '&module=' . $body['module'] . '&id=' . $body['c_id'] , $request, $data);

            }
        }
        
        //        If the request is a GET request, then serve the page
    }

    public function loadTutorFile(Request $request): void {
        if(!$request->isLoggedIn()) {
            die('Please log in to download the file');
        }
//        if request was ...?file= error message should be displayed
//        __nofile is a dummy name used for indicate to unavailable file
        $fileName = $request->getBody()['file'] ?? '';
        $fileName = $fileName !== '' ? $fileName : '__nofile';
        $file = ROOT . $fileName;

        if (file_exists($file)) {
            $type = 'application/pdf';
            header('Content-Type:'.$type);
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }else {
            echo 'Requested file is not available';
            //TODO: Redirect to a new page
        }
    }

    public function updateDay(Request $request)
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
            $position_count = $this->courseModel->getDayCounts($body['course_id']);
            $details = $this->courseModel->getDayTemplateDetails($body['id']);
            $position_count = $position_count + 1;
            $data = [
                'id' => $body['id'],
                'title' =>  $details[0]['title'],
                'course_id' => $body['course_id'],
                'errors' => [
                    'title_error' => "",
                    "position_error" => ""
                ]
            ];
        };


        if ($request->isPost()) {
            $body = $request->getBody();
            $data = [];
            $data = [
                'id' => $body['id'],
                'title' => $body['title'],
                'course_id' => $body['course_id'],
                'errors' => [
                    'title_error' => "",
                    'position_error' => ""
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

                if ($this->courseModel->updateDayTemplate($data)) {
                    redirect('tutor/viewcourse?id=' . $data['course_id']);
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }

                $this->view('tutor/updateday', $request, $data);

                //If the request is a GET request, then serve the page

            } else {
                $this->view('tutor/updateday', $request, $data);
            }
        }

        $this->view('tutor/updateday', $request, $data);
    }

    public function deleteDayTemplate(Request $request)
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
                'id' => $body['id'],
                'course_id' => $body['course_id']
            ];

            $this->view('tutor/deleteday', $request, $data);

        }

        if ($request->isPost()) {
            $body = $request->getBody();

            if ($this->courseModel->deleteDayTemplate($body['id'])) {
                redirect('tutor/viewcourse?id=' . $body['course_id']);
            } else {
                header("HTTP/1.0 500 Internal Server Error");
                die('Something went wrong');
            }


            $this->view('tutor/deleteday', $request, $data);

        }

       



        //        If the request is a GET request, then serve the page
    }
    public function changeClassTemplateStatus(Request $request){
        cors();

        $body = json_decode(file_get_contents('php://input'), true);


        if (!$request->isLoggedIn() || !$request->isTutor()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
            if($body['tutor_id'] === $request->getUserId()){
                if (isset($body['course_id'])) {
                    $this->courseModel->changeClassTemplateStatus($body['course_id'],$body['is_hidden']);
                }else{
                    header("HTTP/1.0 400 Bad Request");
                }
            }
            else{
                header("HTTP/1.0 401 Unauthorized Tutor");
                return;
            }
        }
    }  

    public function deleteActivityTemplate(Request $request){
        cors();

        $body = json_decode(file_get_contents('php://input'), true);


        if (!$request->isLoggedIn() || !$request->isTutor()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
            if($body['tutor_id'] === $request->getUserId()){
                if (isset($body['activity_id'])) {
                    $this->courseModel->deleteActivityTemplate($body['activity_id']);
                }else{
                    header("HTTP/1.0 400 Bad Request");
                }
            }
            else{
                header("HTTP/1.0 401 Unauthorized Tutor");
                return;
            }
        }
    }  
}
