<?php

class StudentClass extends Controller {
    private ModelStudentTutoringClass $tutoringClassModel;

    public function __construct() {
        $this->tutoringClassModel = $this->model('ModelStudentTutoringClass');
    }

    public function tutoringClass(Request $request) {
        //      Student should be logged in
        if (!$request->isLoggedIn()) {
            redirect('/login');
            die;
        }

        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
            die;
        }

        $body = $request->getBody();

//        If body does not contain a class id, then redirect user to home page
        if (!isset($body['id'])) {
            redirect('/student/dashboard');
            die;
        }

//        Check if the student has access to the requested tutoring class
        function mapTutoringClassToID($tutoringClass) {
            return $tutoringClass['id'];
        }
        $allTutoringClasses = $this->tutoringClassModel->getTutoringClassByStudentId($request->getUserId());
        $allTutoringClassesId = array_map('mapTutoringClassToID', $allTutoringClasses);

        if (!in_array($body['id'], $allTutoringClassesId)) {
            redirect('/student/dashboard');
            die;
        }

//        Once validation has completed, get the required data
        $data = [];

        $data = $this->tutoringClassModel->getFullTutoringClassDetails($body['id']);
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        $this->view('/student/tutoringClass', $request, $data);
    }

}