<?php 

class AdminTutor extends Controller{

    private mixed $tutorModel;

    public function __construct(){
        $this->tutorModel = $this->model('ModelTutor');
    }

    public function tutor(Request $request){
        $allTutors = $this->tutorModel->getAllTutor();

        foreach ($allTutors as $tutor){
            $tutorID = $tutor->user_id;
            $tutorContactDetails = $this->tutorModel->getTutorContactDetails($tutorID);
            $tutor->contactDetails = $tutorContactDetails;
        }

        $data = $allTutors;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/tutor', $request, $data);
    }

}