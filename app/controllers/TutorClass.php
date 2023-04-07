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

        $data = [];


        $data = $this->classModel->getsingleclassdetails(intval($body['id']));
  
        header('Content-Type: application/json');
        echo json_encode([
            "data" => $data
        ]);

        
    }
   
}
