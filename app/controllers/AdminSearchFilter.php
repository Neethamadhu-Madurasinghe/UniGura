<?php


class AdminSearchFilter extends Controller{
    private mixed $ModelAdminSearchFilter;

    public function __construct(){
        $this->ModelAdminSearchFilter = $this->model('ModelAdminSearchFilter');
    }

    public function studentComplainSearch(Request $request){
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
            $reasonID = $x->reason_id;
            $reportReason = $this->ModelAdminSearchFilter->reportReasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->ModelAdminSearchFilter->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
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

        $searchResult = [];
        $studentName = '';

        if($request->isGet()){
            $bodyData = $request->getBody();
            $studentName = $bodyData['search_student_name_value'];
        }


        foreach ($allStudentComplaints as $x) {
            if(str_contains(strtolower($x->student->first_name), strtolower($studentName))){
                array_push($searchResult, $x);
            }
        }
        
        $data = [
            'allTutorComplaints' => $allTutorComplaints,
            'allTutorRequest' => $allTutorRequest,
            'searchResult' => $searchResult,
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/studentComplainSearchResult', $request, $data);

    }

    
    
    public function studentComplainFilter(Request $request){

        $allStudentComplaints = $this->ModelAdminSearchFilter->getStudentComplaints();
        $allTutorComplaints = $this->ModelAdminSearchFilter->getTutorComplaints();
        $allTutorRequest = $this->ModelAdminSearchFilter->getTutorRequest();

        // echo '<pre>';
        // print_r($this->studentComplaintsSearchResult);
        // echo '</pre>';

        foreach ($allTutorRequest as $x) {
            $tutorID = $x->user_id;
            $tutor = $this->ModelAdminSearchFilter->userById($tutorID);
            $x->tutor = $tutor;
        }

        
        foreach ($allTutorComplaints as $x) {
            $reasonID = $x->reason_id;
            $reportReason = $this->ModelAdminSearchFilter->reportReasonById($reasonID);
            $x->reportReason = $reportReason;

            $tutorID = $x->tutor_id;
            $tutor = $this->ModelAdminSearchFilter->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->student_id;
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
        $filterType = '';


        if($request->isGet()){
            $bodyData = $request->getBody();
            $filterType = $bodyData['student_complaint_filter_value'];
        }


        if($filterType == 'not_resolve'){
            $filterType = 0;
        }

        if($filterType == 'solved'){
            $filterType = 1;
        }


        foreach ($allStudentComplaints as $x) {
            if($x->is_inquired == $filterType){
                array_push($filterResult, $x);
            }
        }

        if($filterType == 'all'){
            $filterResult = $allStudentComplaints;
        }


        $data = [
            'allTutorComplaints' => $allTutorComplaints,
            'allTutorRequest' => $allTutorRequest,
            'filterResult' => $filterResult,
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/studentComplainFilterResult', $request, $data);
    }


}