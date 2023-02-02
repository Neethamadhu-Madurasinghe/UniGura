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
        $data['active_class_count'] = json_encode($this->dashboardModel->countTutoringActiveClasses($request->getUserId()));
        $this->view('tutor/dashboard', $request, $data);
    }

    public function createClassTemplate(Request $request)
    {
        $data = ['modules' => []];

        //      Fetch all the visible subjects, modules and maximum class price
        $subjects = $this->dashboardModel->getVisibleSubjects(true);


        if (count($subjects) > 0) {
            $modules = $this->dashboardModel->getModulesBySubjectId($subjects[0]['id']);
        }
        if ($request->isPost()) {
            $body = $request->getBody();

            //print_r($body);

            $data = [
                'id' => $request->getUserId(),
                'subject_id' => $body['subject-id'],
                'module_id' => $body['module_id'],
                'session_rate' => $body['session_rate'],
                'class_type' => $body['class_type'],
                'mode' => $body['mode'],
                'duration' => $body['duration'],
                'medium' => $body['medium'],

                'errors' => [
                    'session_rate_error' => ''
                ]

            ];

            //           Validate all the fields
            // $data['errors']['session_rate_error'] = validateName($data['session_rate']);

            $hasErrors = FALSE;


            if (!$hasErrors) {

                if ($this->dashboardModel->setTutorclassTemplate($data)) {
                    redirect('tutor/dashboard');
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }
            }

            $this->view('tutor/dashboard', $request, $data);

            //        If the request is a GET request, then serve the page
        } else {
            $data = [
                'id' => $request->getUserId(),
                'subjects' => $subjects,
                'modules' => $modules,
                'subject_id'=> '',
                'module_id'=> '',
                'session_rate' => '',
                'class_type' => '',
                'mode' => '',
                'duration' => '',
                'medium' => '',

                'errors' => [
                    'session_rate_error' => ''
                ]

            ];
            print_r($data);
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
        
                if (isset($body['subject_id'])) {
                    $data['modules'] = $this->dashboardModel->getModulesBySubjectId($body['subject_id']);
                }
        
                header('Content-type: application/json');
                echo json_encode($data);
            }
        
}
