<?php


class AdminTutorComplaint extends Controller
{
    private mixed $tutorComplaintModel;

    public function __construct()
    {
        $this->tutorComplaintModel = $this->model('ModelRequirementComplaints');
    }

    public function tutorComplaint(Request $request)
    {

        $allTutorComplaints = $this->tutorComplaintModel->getTutorComplaints();

        // echo '<pre>';
        // print_r($allTutorComplaints);
        // echo '</pre>';

        foreach ($allTutorComplaints as $x) {
            $reasonID = $x->reason_id;
            $reportReason = $this->tutorComplaintModel->reportReasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->tutorComplaintModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
            $student = $this->tutorComplaintModel->userById($studentID);
            $x->student = $student;
        }

        $data = [
            'allTutorComplaints' => $allTutorComplaints
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/tutor_complaints', $request, $data);

    }
}