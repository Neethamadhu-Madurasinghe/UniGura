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

        

        $data = $this->classModel->getsingleclassdetails(intval($body['id']));
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
   
}
