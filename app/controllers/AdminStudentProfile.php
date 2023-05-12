<?php

class AdminStudentProfile extends Controller
{

    private mixed $studentModel;

    public function __construct()
    {
        $this->studentModel = $this->model('ModelAdminStudent');
    }

    public function viewStudentProfile(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];

            $allClasses = $this->studentModel->getAllTutorialClassesByStudentId($studentId);
            $studentDetails = $this->studentModel->getStudent($studentId);

            $numberOfActiveClasses = $this->studentModel->getCountActiveTutorialClassesByStudentId($studentId);
            $numberOfCompletedClasses = $this->studentModel->getCountCompletedTutorialClassesByStudentId($studentId);


            foreach ($allClasses as $x) {
                $tutorId = $x->tutor_id;

                $tutor = $this->studentModel->findTutor($tutorId);

                $x->tutor = $tutor;
            }

            $data = [
                'allClasses' => $allClasses,
                'studentDetails' => $studentDetails,
                'numberOfActiveClasses' => $numberOfActiveClasses,
                'numberOfCompletedClasses' => $numberOfCompletedClasses
            ];
        }



        $this->view('admin/student_profile', $request, $data);
    }
}
