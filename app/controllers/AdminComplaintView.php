<?php

class AdminComplaintView extends Controller
{
    private mixed $viewComplaintModel;

    public function __construct()
    {
        $this->viewComplaintModel = $this->model('ModelAdminComplaintView');
    }

    public function viewStudentComplaint(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $data = $request->getBody();

            $studentComplainID = $data['studentComplaintId'];

            $oneStudentComplaint = $this->viewComplaintModel->studentReportById($studentComplainID);

            $oneStudentComplaint->tutor = $this->viewComplaintModel->userById($oneStudentComplaint->tutor_id);
            $oneStudentComplaint->student = $this->viewComplaintModel->userById($oneStudentComplaint->student_id);


            $allStudentComplaints = $this->viewComplaintModel->getStudentComplaints();

            foreach($allStudentComplaints as $aStudentComplaints){
                $aStudentComplaints->tutor = $this->viewComplaintModel->userById($aStudentComplaints->tutor_id);
                $aStudentComplaints->student = $this->viewComplaintModel->userById($aStudentComplaints->student_id);
            }

            
            $otherStudentComplaints = [];

            foreach ($allStudentComplaints as $aStudentComplaints) {
                if ($aStudentComplaints->studentReportID != $studentComplainID && $aStudentComplaints->tutor_id == $oneStudentComplaint->tutor_id) {
                    $otherStudentComplaints[] = $aStudentComplaints;
                }
            }

            $data = [
                'oneStudentComplaint' => $oneStudentComplaint,
                'otherStudentComplaints' => $otherStudentComplaints
            ];
        }


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/studentComplaintView', $request, $data);
    }


    public function viewTutorComplaint(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $data = $request->getBody();

            $tutorComplainID = $data['tutorComplaintId'];

            $oneTutorComplaint = $this->viewComplaintModel->tutorReportById($tutorComplainID);

            $oneTutorComplaint->tutor = $this->viewComplaintModel->userById($oneTutorComplaint->tutorID);
            $oneTutorComplaint->student = $this->viewComplaintModel->userById($oneTutorComplaint->studentID);


            $allTutorComplaints = $this->viewComplaintModel->getTutorComplaints();

            foreach($allTutorComplaints as $aTutorComplaints){
                $aTutorComplaints->tutor = $this->viewComplaintModel->userById($aTutorComplaints->tutor_id);
                $aTutorComplaints->student = $this->viewComplaintModel->userById($aTutorComplaints->student_id);
            }


            $otherTutorComplaints = [];

            foreach ($allTutorComplaints as $complaint) {
                if ($complaint->tutorReportID != $tutorComplainID && $complaint->tutor_id == $oneTutorComplaint->tutorID) {
                    $otherTutorComplaints[] = $complaint;
                }
            }

            $data = [
                'oneTutorComplaint' => $oneTutorComplaint,
                'otherTutorComplaints' => $otherTutorComplaints
            ];
        }


        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/tutorComplaintView', $request, $data);
    }



    public function updateStudentComplainInquire(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $data = $request->getBody();

            $complainStatus = $data['complainStatus'];
            $studentComplainID = $data['studentComplaintId'];

            $studentId = $data['studentId'];
            $tutorId = $data['tutorId'];

            if ($complainStatus == 1) {
                $this->viewComplaintModel->updateStudentComplainStatus($studentComplainID, 0);
                $this->viewComplaintModel->addNotification($studentId,"Your complain has been rejected","We have carefully reviewed your report, but we were unable to take action due to a lack of evidence or information.");

            } else {
                $this->viewComplaintModel->updateStudentComplainStatus($studentComplainID, 1);
                $this->viewComplaintModel->addNotification($studentId,"Your complain has been accepted","We have carefully reviewed your report, and we have taken action against the tutor.");
                $this->viewComplaintModel->addNotification($tutorId,"You have been reported","We will review the report carefully and we will take action against you.");
            }

            redirect('/admin/studentComplaint');
        }
    }


    public function updateTutorComplainInquire(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $data = $request->getBody();

            $complainStatus = $data['complainStatus'];
            $tutorComplainID = $data['tutorComplaintId'];


            $studentId = $data['studentId'];
            $tutorId = $data['tutorId'];

            if ($complainStatus == 1) {
                $this->viewComplaintModel->updateTutorComplainStatus($tutorComplainID, 0);
                // $this->viewComplaintModel->addNotification($tutorId,"Your complain has been rejected","We have carefully reviewed your report, but we were unable to take action due to a lack of evidence or information.");

            } else {
                $this->viewComplaintModel->updateTutorComplainStatus($tutorComplainID, 1);
                // $this->viewComplaintModel->addNotification($tutorId,"Your complain has been accepted","We have carefully reviewed your report, and we have taken action against the student.");
                // $this->viewComplaintModel->addNotification($studentId,"You have been reported","We will review the report carefully and we will take action against you.");
            }

            redirect('/admin/tutorComplaint');
        }
    }


    public function updateTutoringClassSuspended(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $data = $request->getBody();

            $suspendStatus = $data['suspendStatus'];
            $tutorClassId = $data['tutorClassId'];


            $studentId = $data['studentId'];
            $tutorId = $data['tutorId'];

            if ($suspendStatus == 1) {
                $this->viewComplaintModel->updateSuspendStatusTutorialClass($tutorClassId, 0);
                $this->viewComplaintModel->addNotification($studentId,"Now you can continue your class","We remove the your class from the suspended list.");

            } else {
                $this->viewComplaintModel->updateSuspendStatusTutorialClass($tutorClassId, 1);
                $this->viewComplaintModel->addNotification($studentId,"Your class has been suspended","We got report against your class, so we have suspended your class.");
            }

            redirect('/admin/studentComplaint');
        }
    }


    public function updateClassTemplateSuspended(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $data = $request->getBody();

            $suspendStatus = $data['suspendStatus'];
            $tutorClassTemplateId = $data['tutorClassTemplateId'];

            $studentId = $data['studentId'];
            $tutorId = $data['tutorId'];

            if ($suspendStatus == 1) {
                $this->viewComplaintModel->updateSuspendStatusAllClassByClassTemplateById($tutorClassTemplateId, 0);
                $this->viewComplaintModel->addNotification($tutorId,"Now you can continue your classes","We remove the your classes from the suspended list.");

            } else {
                $this->viewComplaintModel->updateSuspendStatusAllClassByClassTemplateById($tutorClassTemplateId, 1);
                $this->viewComplaintModel->addNotification($tutorId,"Your classes has been suspended","We got report against your classes, so we have suspended your classes.");
            }

            redirect('/admin/tutorComplaint');
        }
    }
}
