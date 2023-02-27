<?php
class TutorDashboard extends Controller
{
    private ModelTutorDashboard $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = $this->model('ModelTutorDashboard');
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
                
                if ($this->dashboardModel->getTutoringClassDetails($data) == 0){
                    if ($this->dashboardModel->setTutorclassTemplate($data)) {
                        redirect('tutor/dashboard');
                    } else {
                        header("HTTP/1.0 500 Internal Server Error");
                        die('Something went wrong');
                    }
                }
                else{
                    $data['errors']['class_template_duplipate_error'] = 'Class Template Already Exists!';
                }

                
            }
            
            $data['subjects'] = $subjects;
            $data['modules'] = $modules;

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
        }

        $this->view('tutor/createcclasstemplate', $request, $data);
    }




    public function getModule(Request $request) {
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

            
        }


    
        
