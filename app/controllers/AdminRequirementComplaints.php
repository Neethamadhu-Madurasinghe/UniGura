<?php

class AdminRequirementComplaints extends Controller
{

    private mixed $requirementComplaintsModel;

    public function __construct()
    {
        $this->requirementComplaintsModel = $this->model('ModelRequirementComplaints');
    }

    public function requirementComplaints(Request $request)
    {

        $allStudentComplaints = $this->requirementComplaintsModel->getStudentComplaints();
        $allTutorComplaints = $this->requirementComplaintsModel->getTutorComplaints();
        $allTutorRequest = $this->requirementComplaintsModel->getTutorRequest();

        // echo '<pre>';
        // print_r($allStudentComplaints);
        // echo '</pre>';


        foreach ($allTutorRequest as $x) {
            $tutorID = $x->user_id;
            $tutor = $this->requirementComplaintsModel->userById($tutorID);
            $x->tutor = $tutor;
        }


        foreach ($allStudentComplaints as $x) {
            $reasonID = $x->reason_id;
            $reportReason = $this->requirementComplaintsModel->reportSeasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->requirementComplaintsModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
            $student = $this->requirementComplaintsModel->userById($studentID);
            $x->student = $student;
        }


        foreach ($allTutorComplaints as $x) {
            $reasonID = $x->reason_id;
            $reportReason = $this->requirementComplaintsModel->reportReasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->requirementComplaintsModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
            $student = $this->requirementComplaintsModel->userById($studentID);
            $x->student = $student;
        }



        $data = [
            'allStudentComplaints' => $allStudentComplaints,
            'allTutorComplaints' => $allTutorComplaints,
            'allTutorRequest' => $allTutorRequest
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        $this->view('admin/requirement_complaints', $request, $data);
    }



    public function addStudentComplainReason(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();

            $inputStudentReason = $data['inputStudentReason'];

            $this->requirementComplaintsModel->addStudentComplainReason($inputStudentReason);

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();

            $data = [
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason
            ];

            $this->view('admin/complaint_settings', $request, $data);
        }
    }

    public function addTutorComplainReason(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();

            $inputTutorReason = $data['inputTutorReason'];

            $this->requirementComplaintsModel->addTutorComplainReason($inputTutorReason);

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();

            $data = [
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason
            ];

            $this->view('admin/complaint_settings', $request, $data);
        }
    }

    public function updateStudentComplainReason(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();

            $inputStudentReason = $data['inputStudentReason'];
            $studentReasonId = $data['studentReasonId'];


            $this->requirementComplaintsModel->updateStudentComplainReason($studentReasonId, $inputStudentReason);

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();

            $data = [
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason
            ];

            $this->view('admin/complaint_settings', $request, $data);
        }
    }

    public function updateTutorComplainReason(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();

            $inputTutorReason = $data['inputTutorReason'];
            $tutorReasonId = $data['tutorReasonId'];

            $this->requirementComplaintsModel->updateTutorComplainReason($tutorReasonId, $inputTutorReason);

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();

            $data = [
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason
            ];

            $this->view('admin/complaint_settings', $request, $data);
        }
    }


}
