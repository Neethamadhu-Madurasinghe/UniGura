<?php

class AdminTutorRequest extends Controller
{
    private mixed $tutorRequestModel;

    public function __construct()
    {
        $this->tutorRequestModel = $this->model('ModelRequirementComplaints');
    }

    public function tutorRequest(Request $request)
    {

        $allTutorRequest = $this->tutorRequestModel->getTutorRequest();

        // echo '<pre>';
        // print_r($allTutorRequest);
        // echo '</pre>';


        foreach ($allTutorRequest as $x) {
            $tutorID = $x->user_id;
            $tutor = $this->tutorRequestModel->userById($tutorID);
            $x->tutor = $tutor;
        }


        $data = [
            'allTutorRequest' => $allTutorRequest
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';


        $this->view('admin/tutor_request', $request, $data);
    }
}
