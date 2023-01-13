<?php

class AdminStudentProfile extends Controller{

    private mixed $studentModel;

    public function __construct(){
        $this->studentModel = $this->model('ModelStudent');
    }

    public function viewStudentProfile(Request $request){
        $this->view('admin/student_profile',$request);
    }
}