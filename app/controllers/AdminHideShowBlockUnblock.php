<?php


class AdminHideShowBlockUnblock extends Controller{
    private mixed $hideShowBlockUnblockModel;

    public function __construct(){
        $this->hideShowBlockUnblockModel = $this->model('ModelAdminHideShowBlockUnblock');
    }

    public function hideTutor(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGet()){
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->hideTutor($tutorId);

            redirect('/admin/viewTutorProfile?tutorID='.$tutorId);
        }   
    }

    public function showTutor(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGet()){
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->showTutor($tutorId);

            redirect('/admin/viewTutorProfile?tutorID='.$tutorId);
        }   
    }

    public function blockTutor(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGet()){
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->blockTutor($tutorId);

            redirect('/admin/viewTutorProfile?tutorID='.$tutorId);
        }   
    }

    public function unblockTutor(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGet()){
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->unblockTutor($tutorId);

            redirect('/admin/viewTutorProfile?tutorID='.$tutorId);
        }   
    }

    public function blockStudent(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGet()){
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];
            $this->hideShowBlockUnblockModel->blockStudent($studentId);

            redirect('/admin/viewStudentProfile?studentID='.$studentId);
        }
    }

    public function unblockStudent(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGet()){
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];
            $this->hideShowBlockUnblockModel->unblockStudent($studentId);

            redirect('/admin/viewStudentProfile?studentID='.$studentId);
        }
    }
}
