<?php

class AdminStudentProfile extends Controller{

    private mixed $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('ModelAdminStudent');
    }

    public function viewStudentProfile(Request $request) {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()){
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];

            $student = $this->studentModel->getStudent($studentId);

            $student->studentDetails = $this->studentModel->getStudentById($studentId);

            $student->allClassDays = $this->studentModel->getAllClassDays();

            foreach ($student->allClassDays as $classDay){
                $classDay->tutorialClass = $this->studentModel->getAllTutorialClassesByClassId($classDay->class_id);
                $classDay->classTemplateDetails = $this->studentModel->getClassTemplateByClassTemplateId($classDay->tutorialClass->class_template_id);
                $classDay->tutorDetails = $this->studentModel->getTutorById($classDay->tutorialClass->tutor_id);
                $classDay->subject = $this->studentModel->getSubjectById($classDay->classTemplateDetails->subject_id);
                $classDay->module = $this->studentModel->getModuleById($classDay->classTemplateDetails->module_id);
            }
        }

        $data = [$student];

        
        $this->view('admin/student_profile',$request,$data);
    }
}