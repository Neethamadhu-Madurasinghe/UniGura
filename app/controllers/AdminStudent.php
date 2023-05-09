<?php

class AdminStudent extends Controller{
    private mixed $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('ModelAdminStudent');
    }

    public function student(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }
        

        $allStudent = $this->studentModel->getAllStudent();

        $data = $allStudent;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/student', $request, $data);
    }

}