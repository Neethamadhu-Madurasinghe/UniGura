<?php

class StudentDashboard extends Controller {
    private mixed $dashboardModel;

    public function __construct() {
        $this->dashboardModel = $this->model('ModelStudentDashboard');
    }

    public function dashboard(Request $request) {
        $data = [];
        $this->view('student/dashboard', $request, $data);
    }
}