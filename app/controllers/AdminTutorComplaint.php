<?php


class AdminTutorComplaint extends Controller {
    private mixed $tutorComplaintModel;

    public function __construct() {
        $this->tutorComplaintModel = $this->model('ModelAdminRequirementComplaints');
    }

    public function tutorComplaint(Request $request) {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        $rowsPerPage = 5;
        $totalNumOfStudentComplaints = $this->tutorComplaintModel->totalNumOfStudentComplaints();
        $lastPageNum = ceil($totalNumOfStudentComplaints / $rowsPerPage);

        if (isset($_GET['currentPageNum'])) {
            $currentPageNum = $_GET['currentPageNum'];
        } else {
            $currentPageNum = 1;
        }

        $start = ($currentPageNum - 1) * $rowsPerPage;

        $allTutorComplaints = $this->tutorComplaintModel->getTutorComplaints();

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

        $totalNumOfTutorComplaints = $this->tutorComplaintModel->totalNumOfTutorComplaints();


        $data = [
            'allTutorComplaints' => $allTutorComplaints,
            'totalNumOfTutorComplaints' => $totalNumOfTutorComplaints,
            'lastPageNum' => $lastPageNum,
            'nextPageNum' => $nextPageNum,
            'previousPageNum' => $previousPageNum,
            'currentPageNum' => $currentPageNum,
        ];

        $this->view('admin/tutor_complaints', $request, $data);
    }
}