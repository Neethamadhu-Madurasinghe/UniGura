<?php


class AdminSearchFilter extends Controller{
    private mixed $ModelAdminSearchFilter;

    public function __construct(){
        $this->ModelAdminSearchFilter = $this->model('ModelAdminSearchFilter');
    }

    public function studentComplainFilter(Request $request){
        $allStudentComplaints = $this->ModelAdminSearchFilter->getStudentComplaints();
        $allTutorComplaints = $this->ModelAdminSearchFilter->getTutorComplaints();
        $allTutorRequest = $this->ModelAdminSearchFilter->getTutorRequest();

        // echo '<pre>';
        // print_r($allStudentComplaints);
        // echo '</pre>';

        foreach ($allTutorRequest as $x) {
            $tutorID = $x->user_id;
            $tutor = $this->ModelAdminSearchFilter->userById($tutorID);
            $x->tutor = $tutor;
        }

        
        
        foreach ($allTutorComplaints as $x) {
            $reportID = $x->report_id;
            $tutorReport = $this->ModelAdminSearchFilter->tutorReportById($reportID);
            $x->tutorReport = $tutorReport;

            $reasonID = $x->reason_id;
            $reportReason = $this->ModelAdminSearchFilter->reportReasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutorReport->tutor_id;
            $tutor = $this->ModelAdminSearchFilter->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->tutorReport->student_id;
            $student = $this->ModelAdminSearchFilter->userById($studentID);
            $x->student = $student;
        }



        foreach ($allStudentComplaints as $x) {
            $reasonID = $x->reason_id;
            $reportReason = $this->ModelAdminSearchFilter->reportSeasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->ModelAdminSearchFilter->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
            $student = $this->ModelAdminSearchFilter->userById($studentID);
            $x->student = $student;
        }

        $filterResult = [];
        $studentName = '';

        if($request->isGet()){
            $bodyData = $request->getBody();
            $studentName = $bodyData['search_student_name_value'];
        }


        foreach ($allStudentComplaints as $x) {
            echo $x->student->first_name;
            // echo $studentName;
            if(str_contains(strtolower($x->student->first_name), strtolower($studentName))){
                array_push($filterResult, $x);
            }
        }
        
        $data = [
            'allTutorComplaints' => $allTutorComplaints,
            'allTutorRequest' => $allTutorRequest,
            'filterResult' => $filterResult,
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/studentComplainSearchResult', $request, $data);

    }
}