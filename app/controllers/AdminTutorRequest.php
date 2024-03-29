<?php

class AdminTutorRequest extends Controller {
    private mixed $tutorRequestModel;

    public function __construct() {
        $this->tutorRequestModel = $this->model('ModelAdminRequirementComplaints');
    }

    public function tutorRequest(Request $request) {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $allTutorRequest = $this->tutorRequestModel->getTutorRequest();

        foreach ($allTutorRequest as $x) {
            $tutorID = $x->user_id;
            $tutor = $this->tutorRequestModel->userById($tutorID);
            $x->tutor = $tutor;
        }

        $totalNumOfTutorRequest = $this->tutorRequestModel->totalNumOfTutorRequest();

        $data = [
            'allTutorRequest' => $allTutorRequest,
            'totalNumOfTutorRequest' => $totalNumOfTutorRequest
        ];

        $this->view('admin/tutorRequest', $request, $data);
    }
}
