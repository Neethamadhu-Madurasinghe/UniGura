<?php


class AdminStudent extends Controller{
    private mixed $studentModel;

    public function __construct(){
        $this->studentModel = $this->model('ModelStudent');
    }

    public function student(Request $request){

        $allStudent = $this->studentModel->getAllStudent();

        foreach($allStudent as $aStudent){
            $studentID = $aStudent->user_id;

            $student = $this->studentModel->getStudentById($studentID);

            $aStudent->student = $student;
        }

        $data = $allStudent;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/student', $request, $data);
    }

}