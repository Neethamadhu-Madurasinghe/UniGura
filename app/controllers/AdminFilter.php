<?php

class AdminFilter extends Controller
{
    private mixed $classModel;

    public function __construct()
    {
        $this->classModel = $this->model('ModelClass');

    }

    public function filter(Request $request)
    {
        $allClasses = $this->classModel->getAllClasses();

        foreach ($allClasses as $x) {
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

        $data = $allClasses;

        // $data = $this->filterModel->filterAll($beforeFilter, $request);

        // echo '<pre>';
        // print_r($allClasses);
        // echo '</pre>';

        $this->view('admin/adminFilter', $request, $data);
    }
}
