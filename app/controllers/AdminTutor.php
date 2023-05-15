<?php

class AdminTutor extends Controller{

    private mixed $tutorModel;

    public function __construct() {
        $this->tutorModel = $this->model('ModelAdminTutor');
    }

    public function tutor(Request $request) {
        
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $allTutors = $this->tutorModel->getAllTutor();

        $data = $allTutors;

        $this->view('admin/tutor', $request, $data);
    }

}