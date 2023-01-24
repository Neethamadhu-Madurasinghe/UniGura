<?php

class AdminStudentComplaint extends Controller
{
    private mixed $studentComplaintModel;

    public function __construct()
    {
        $this->studentComplaintModel = $this->model('ModelRequirementComplaints');
    }

    public function studentComplaint(Request $request)
    {

        $allStudentComplaints = $this->studentComplaintModel->getStudentComplaints();

        // echo '<pre>';
        // print_r($allStudentComplaints);
        // echo '</pre>';

        foreach ($allStudentComplaints as $x) {
            $reasonID = $x->reason_id;
            $reportReason = $this->studentComplaintModel->reportSeasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->studentComplaintModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
            $student = $this->studentComplaintModel->userById($studentID);
            $x->student = $student;
        }


        $data = [
            'allStudentComplaints' => $allStudentComplaints
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        $this->view('admin/student_complaint', $request, $data);
    }
}