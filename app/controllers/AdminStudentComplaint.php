<?php

class AdminStudentComplaint extends Controller {
    private mixed $studentComplaintModel;

    public function __construct() {
        $this->studentComplaintModel = $this->model('ModelAdminRequirementComplaints');
    }

    public function studentComplaint(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }
        
        $rowsPerPage = 5;
        $totalNumOfStudentComplaints = $this->studentComplaintModel->totalNumOfStudentComplaints();
        $lastPageNum = ceil($totalNumOfStudentComplaints / $rowsPerPage);

        if (isset($_GET['currentPageNum'])) {
            $currentPageNum = $_GET['currentPageNum'];
        } else {
            $currentPageNum = 1;
        }

        $start = ($currentPageNum - 1) * $rowsPerPage;

        $allStudentComplaints = $this->studentComplaintModel->getStudentComplaints($start, $rowsPerPage);

        // next page
        if ($currentPageNum < $lastPageNum) {
            $nextPageNum = $currentPageNum + 1;
        } else {
            $nextPageNum = $lastPageNum;
        }

        // previous page
        if ($currentPageNum > 1) {
            $previousPageNum = $currentPageNum - 1;
        } else {
            $previousPageNum = 1;
        }

        // echo '<pre>';
        // print_r($allStudentComplaints);
        // echo '</pre>';

        foreach ($allStudentComplaints as $x) {
            $tutorID = $x->tutorID;
            $tutor = $this->studentComplaintModel->userById($tutorID);
            $x->tutor = $tutor;

            $studentID = $x->studentID;
            $student = $this->studentComplaintModel->userById($studentID);
            $x->student = $student;
        }

        $totalNumOfStudentComplaints = $this->studentComplaintModel->totalNumOfStudentComplaints();

        $data = [
            'allStudentComplaints' => $allStudentComplaints,
            'totalNumOfStudentComplaints' => $totalNumOfStudentComplaints,
            'lastPageNum' => $lastPageNum,
            'nextPageNum' => $nextPageNum,
            'previousPageNum' => $previousPageNum,
            'currentPageNum' => $currentPageNum,
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        $this->view('admin/studentComplaint', $request, $data);
    }
}