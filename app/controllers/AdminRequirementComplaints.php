<?php

class AdminRequirementComplaints extends Controller
{

    private mixed $requirementComplaintsModel;
    private ModelTutorStudentCompleteProfile $tutorStudentModel;

    public function __construct()
    {
        $this->requirementComplaintsModel = $this->model('ModelAdminRequirementComplaints');
        $this->tutorStudentModel = $this->model('ModelTutorStudentCompleteProfile');
    }

    public function requirementComplaints(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

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
            'allTutorRequest' => $allTutorRequest,

            'errors' => [
                'student_reason' => '',
            ]
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        $this->view('admin/requirement_complaints', $request, $data);
    }



    public function addStudentComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            $data = [
                'student_reason' => $body['inputStudentReason'],
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason,

                'errors' => [
                    'student_reason' => validateStudentReportReason($body['inputStudentReason'], $this->tutorStudentModel)
                ]
            ];

            $hasErrors = FALSE; // has not errors 

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if ($hasErrors) {
                $this->view('admin/complaint_settings', $request, $data);
            }


            if (!$hasErrors) {
                $this->requirementComplaintsModel->addStudentComplainReason($data['student_reason']);
                redirect('admin/complaintSetting');
            }
        }
    }



    public function addTutorComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


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

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

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

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


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



    public function acceptTutorRequest(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $data = $request->getBody();

            $tutorID = $data['tutorID'];

            $this->requirementComplaintsModel->acceptTutorRequest($tutorID);

            redirect('admin/tutorRequest');
        }
    }



    public function rejectTutorRequest(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $data = $request->getBody();

            $tutorID = $data['tutorID'];

            $this->requirementComplaintsModel->rejectTutorRequest($tutorID);

            redirect('admin/tutorRequest');
        }
    }
}
