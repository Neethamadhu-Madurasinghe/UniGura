<?php

class AdminTutorProfile extends Controller{

    private mixed $tutorModel;

    public function __construct(){
        $this->tutorModel = $this->model('ModelTutor');
    }

    public function viewTutorProfile(Request $request){
        $this->view('admin/tutor_profile', $request);
    }


}