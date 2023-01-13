<?php 

class AdminRequirementComplaints extends Controller
{
    private mixed $requirementComplaintsModel;

    public function __construct(){
        $this->requirementComplaintsModel = $this->model('ModelRequirementComplaints');
    }

    public function requirementComplaints(Request $request){

        $allStudentComplaints = $this->requirementComplaintsModel->getStudentComplaints();
        $allTutorComplaints = $this->requirementComplaintsModel->getTutorComplaints();

        $allTutorRequest = $this->requirementComplaintsModel->getTutorRequest();

        foreach ($allStudentComplaints as $x) {
            $reportID = $x->report_id;
            $studentReport = $this->requirementComplaintsModel->studentReportById($reportID);
            $x->studentReport = $studentReport;

            $reasonID = $x->reason_id;
            $reportReason = $this->requirementComplaintsModel->reportSeasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->studentReport->tutor_id;
            $tutor = $this->requirementComplaintsModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->studentReport->student_id;
            $student = $this->requirementComplaintsModel->userById($studentID);
            $x->student = $student;
        }



        foreach ($allTutorComplaints as $x) {
            $reportID = $x->report_id;
            $tutorReport = $this->requirementComplaintsModel->tutorReportById($reportID);
            $x->tutorReport = $tutorReport;

            $reasonID = $x->reason_id;
            $reportReason = $this->requirementComplaintsModel->reportReasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutorReport->tutor_id;
            $tutor = $this->requirementComplaintsModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->tutorReport->student_id;
            $student = $this->requirementComplaintsModel->userById($studentID);
            $x->student = $student;
        }


        foreach($allTutorRequest as $x){
            $tutorID = $x->user_id;
            $tutor = $this->requirementComplaintsModel->userById($tutorID);
            $x->tutor = $tutor;
        }


        $data = [
            'allStudentComplaints' => $allStudentComplaints,
            'allTutorComplaints' => $allTutorComplaints,
            'allTutorRequest' => $allTutorRequest
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        $this->view('admin/requirement_complaints', $request,$data);
    }
}