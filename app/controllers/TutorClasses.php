<?php 
class TutorClasses extends Controller{
    private ModelTutorClass $tutorClasses;

    public function __construct(){
        $this->tutorClasses = $this->model('ModelTutorClass');
    }

    public function tutorClass(Request $request){

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

        $data['tutor_class'] = json_encode($this->tutorClasses->getTutorClasses($request->getUserId()));
    }
}





?>