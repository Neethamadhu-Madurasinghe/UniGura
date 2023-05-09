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


            $allClasses = $this->tutorModel->getAllTutorialClassesByTutorId($tutorId);
            $tutorDetails = $this->tutorModel->getTutor($tutorId);            
            $allTimeSlots = $this->tutorModel->getAllTimeSlotsByTutorId($tutorId);

            $numberOfActiveClasses = $this->tutorModel->getCountActiveTutorialClassesByTutorId($tutorId);
            $numberOfCompletedClasses = $this->tutorModel->getCountCompletedTutorialClassesByTutorId($tutorId);



            foreach ($allClasses as $x) {
                $studentId = $x->student_id;

                $student = $this->tutorModel->findStudent($studentId);

                $x->student = $student;
            }

            $data = [
                'allClasses' => $allClasses,
                'tutorDetails' => $tutorDetails,
                'allTimeSlots' => $allTimeSlots,
                'numberOfActiveClasses' => $numberOfActiveClasses,
                'numberOfCompletedClasses' => $numberOfCompletedClasses
            ];

        }


        $this->view('admin/tutor_profile', $request, $data);
    }


}