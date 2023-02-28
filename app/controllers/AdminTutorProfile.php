<?php

class AdminTutorProfile extends Controller{

    private mixed $tutorModel;

    public function __construct() {
        $this->tutorModel = $this->model('ModelAdminTutor');
    }

    public function viewTutorProfile(Request $request) {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()){
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];

            $tutor = $this->tutorModel->getTutorById($tutorId);

            $tutor->tutorDetails = $this->tutorModel->getTutorByUserId($tutorId);

            $tutor->allClassDays = $this->tutorModel->getAllClassDays();

            $tutor->allTimeSlots = $this->tutorModel->getAllTimeSlotsByTutorId($tutorId);

            foreach ($tutor->allClassDays as $classDay){
                $classDay->tutorialClass = $this->tutorModel->getAllTutorialClassesByClassId($classDay->class_id);
                $classDay->classTemplateDetails = $this->tutorModel->getClassTemplateByClassTemplateId($classDay->tutorialClass->class_template_id);
                $classDay->student = $this->tutorModel->getStudentById($classDay->tutorialClass->student_id);
                $classDay->studentDetails = $this->tutorModel->getStudentContactDetails($classDay->tutorialClass->student_id);
                $classDay->subject = $this->tutorModel->getSubjectById($classDay->classTemplateDetails->subject_id);
                $classDay->module = $this->tutorModel->getModuleById($classDay->classTemplateDetails->module_id);
            }
        }

        $data = [$tutor];

        $this->view('admin/tutor_profile', $request, $data);
    }


}