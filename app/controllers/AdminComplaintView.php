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
            $oneStudentComplaint->reportReason = $this->viewComplaintModel->reportSeasonById($oneStudentComplaint->reason_id);


            $allStudentComplaints = $this->viewComplaintModel->getStudentComplaints();
            $allStudentComplaints = array_map(function ($complain) {
                $complain->tutor = $this->viewComplaintModel->userById($complain->tutor_id);
                $complain->student = $this->viewComplaintModel->userById($complain->student_id);
                $complain->reportReason = $this->viewComplaintModel->reportSeasonById($complain->reason_id);
                return $complain;
            }, $allStudentComplaints);


            $otherStudentComplaints = [];

            foreach ($allStudentComplaints as $complain) {
                if ($complain->id != $studentComplainID && $complain->tutor_id == $oneStudentComplaint->tutor_id) {
                    $otherStudentComplaints[] = $complain;
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

            $oneTutorComplaint->tutor = $this->viewComplaintModel->userById($oneTutorComplaint->tutor_id);
            $oneTutorComplaint->student = $this->viewComplaintModel->userById($oneTutorComplaint->student_id);
            $oneTutorComplaint->reportReason = $this->viewComplaintModel->reportSeasonById($oneTutorComplaint->reason_id);


            $allTutorComplaints = $this->viewComplaintModel->getTutorComplaints();
            $allTutorComplaints = array_map(function ($complain) {
                $complain->tutor = $this->viewComplaintModel->userById($complain->tutor_id);
                $complain->student = $this->viewComplaintModel->userById($complain->student_id);
                $complain->reportReason = $this->viewComplaintModel->reportSeasonById($complain->reason_id);
                return $complain;
            }, $allTutorComplaints);


            $otherTutorComplaints = [];

            foreach ($allTutorComplaints as $complaint) {
                if ($complaint->id != $tutorComplainID && $complaint->student_id == $oneTutorComplaint->student_id) {
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

            if ($complainStatus == 1) {
                $this->viewComplaintModel->updateStudentComplainStatus($studentComplainID, 0);
            } else {
                $this->viewComplaintModel->updateStudentComplainStatus($studentComplainID, 1);
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

            if ($complainStatus == 1) {
                $this->viewComplaintModel->updateTutorComplainStatus($tutorComplainID, 0);
            } else {
                $this->viewComplaintModel->updateTutorComplainStatus($tutorComplainID, 1);
            }

            redirect('/admin/tutorComplaint');
        }
    }
}
