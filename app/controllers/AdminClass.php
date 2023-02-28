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
            $studentId = $x->student_id;
            $tutorId = $x->tutor_id;
            $classId = $x->id;
            $classTemplateId = $x->class_template_id;

            $student = $this->classModel->findStudent($studentId);
            $tutor = $this->classModel->findTutor($tutorId);
            $classDay = $this->classModel->findClassDay($classId);
            $classTemplate = $this->classModel->findTutoringClassTemplate($classTemplateId);

            $x->student = $student;
            $x->tutor = $tutor;
            $x->classDay = $classDay;
            $x->classTemplate = $classTemplate;
        
        
            $module = $this->classModel->findModule($classTemplate->module_id);
            $x->module = $module;

            $subject = $this->classModel->findSubject($classTemplate->subject_id);
            $x->subject = $subject;
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
