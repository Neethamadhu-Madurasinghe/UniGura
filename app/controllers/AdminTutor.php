<?php 

class AdminTutor extends Controller{

    private mixed $tutorModel;

    public function __construct(){
        $this->tutorModel = $this->model('ModelTutor');
    }

    public function tutor(Request $request){
        $allTutors = $this->tutorModel->getAllTutor();
        $data = array($allTutors);
        $this->view('admin/tutor', $request,$data);
    }

}