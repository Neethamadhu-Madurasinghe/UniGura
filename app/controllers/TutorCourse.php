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
                'days' => $days
            ];
        };

        $days = json_encode($this->courseModel->getTutoringClassTemplateDays($data['id']));

        $data['days'] = $days;

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
                'meeting_link' => "",
                'position' => $position_count,
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
                'meeting_link' => $body['meeting_link'],
                'position' => $body['position'],
                'errors' => [
                    'title_error' => "",
                    'position_error' => ""
                ]
            ];

            $data['errors']['title_error'] = $this->validateTitle($body['title']);
            $data['errors']['position_error'] = $this->validatePosition($body['position'], $body['id']);

            echo $body['position'];


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



    public function validateTitle(string $name): String
    {
        if (empty($name)) {
            return 'Please enter a valid name';
        } elseif ($this->courseModel->findDayByName($name)) {
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
        
}

