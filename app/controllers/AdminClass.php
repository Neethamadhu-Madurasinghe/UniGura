<?php

class AdminClass extends Controller{
    private mixed $classModel;

    public function __construct()
    {   
        $this->classModel = $this->model('ModelAdminClass');
    }

    public function class(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $allClasses = $this->classModel->getAllClasses();

        $allSubjects = $this->classModel->getAllSubjects();

        foreach($allClasses as $x){
            $tutorId = $x->tutorID;

            $tutor = $this->classModel->findTutor($tutorId);

            $x->tutor = $tutor;
        }

        $data = [
            'allClasses' => $allClasses,
            'allSubjects' => $allSubjects
        ];

        // echo '<pre>';
        // print_r($allClasses);
        // echo '</pre>';


        $this->view('admin/class',$request,$data);
    }
}
