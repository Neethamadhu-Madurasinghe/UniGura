<?php

class AdminStudentProfile extends Controller{

    private mixed $studentModel;

    public function __construct(){
        $this->studentModel = $this->model('ModelStudent');
    }

    public function viewStudentProfile(Request $request){

        if($request->isGet()){
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];

            $student = $this->studentModel->getStudent($studentId);

            $student->studentDetails = $this->studentModel->getStudentById($studentId);



            $allActiveClasses = $student->activeClasses = $this->studentModel->getActiveTutorialClass($studentId);

            $student->completedClasses = $this->studentModel->getCompletedTutorialClass($studentId);

            $allActiveClasses = array_map(function($aActiveClass){
                $aActiveClass->tutor = $this->studentModel->getTutorById($aActiveClass->tutor_id);
                $aActiveClass->student = $this->studentModel->getStudentById($aActiveClass->student_id);
                $aActiveClass->tutorialClassTemplate = $this->studentModel->getClassTemplateById($aActiveClass->class_template_id);
                $aActiveClass->subject = $this->studentModel->getSubjectById($aActiveClass->tutorialClassTemplate->subject_id);
                $aActiveClass->module = $this->studentModel->getModuleById($aActiveClass->tutorialClassTemplate->module_id);
                return $aActiveClass;
            },$allActiveClasses);


            echo '<pre>';
            print_r($allActiveClasses);
            echo '</pre>';

        }

        
        $this->view('admin/student_profile',$request);
    }
}