<?php


class AdminSearchFilter extends Controller {
    private mixed $ModelAdminSearchFilter;

    public function __construct() {
        $this->ModelAdminSearchFilter = $this->model('ModelAdminSearchFilter');
    }


    public function studentComplainSearchFilter(Request $request) {

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
        $studentName = '';
        $filterType = '';
        $searchResult = '';


        $studentName = $_GET['search_student_name_value'];
        $filterType = $_GET['student_complaint_filter_value'];


        if ($studentName != null && $filterType != 'not_choose') {
            $filterType = $_GET['student_complaint_filter_value'];
            $studentName = $_GET['search_student_name_value'];


            if ($filterType == 'not_resolve') {
                $filterType = 0;
            }

            if ($filterType == 'solved') {
                $filterType = 1;
            }

            foreach ($allStudentComplaints as $x) {
                if ($x->is_inquired == $filterType && str_contains(strtolower($x->student->first_name), strtolower($studentName))) {
                    array_push($filterResult, $x);
                }
            }

            if ($filterType == 'all') {

                foreach ($allStudentComplaints as $x) {
                    if (str_contains(strtolower($x->student->first_name), strtolower($studentName))) {
                        array_push($filterResult, $x);
                    }
                }
            }
        } elseif ($studentName != '') {
            $studentName = $_GET['search_student_name_value'];

            foreach ($allStudentComplaints as $x) {
                if (str_contains(strtolower($x->student->first_name), strtolower($studentName))) {
                    array_push($filterResult, $x);
                }
            }
        } elseif ($filterType != '') {
            $filterType = $_GET['student_complaint_filter_value'];

            if ($filterType == 'not_resolve') {
                $filterType = 0;
            }

            if ($filterType == 'solved') {
                $filterType = 1;
            }


            foreach ($allStudentComplaints as $x) {
                if ($x->is_inquired == $filterType) {
                    array_push($filterResult, $x);
                }
            }

            if ($filterType == 'all') {
                foreach ($allStudentComplaints as $x) {
                    if (str_contains(strtolower($x->student->first_name), strtolower($studentName))) {
                        array_push($filterResult, $x);
                    }
                }
            }
        }


        $filterResult = array_unique($filterResult, SORT_REGULAR);
        $filterResult = array_values($filterResult);


        $data = [
            'allTutorComplaints' => $allTutorComplaints,
            'allTutorRequest' => $allTutorRequest,
            'filterResult' => $filterResult,
        ];

        // echo '<pre>';
        // print_r($filterResult);
        // echo '</pre>';

        $this->view('admin/studentComplainFilterResult', $request, $data);
    }
}
