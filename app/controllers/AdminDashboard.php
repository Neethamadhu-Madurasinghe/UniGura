<?php

class AdminDashboard extends Controller{
    private mixed $dashboardModel;

    public function __construct(){
        $this->dashboardModel = $this->model('ModelAdminDashboard');
    }

    public function dashboard(Request $request){

        $allTutors = $this->dashboardModel->getAllTutors();
        foreach ($allTutors as $tutor) {
            $tutor->tutorDetails = $this->dashboardModel->tutorGetById($tutor->user_id);
        }


        $allStudents = $this->dashboardModel->getAllStudents();
        foreach ($allStudents as $student) {
            $student->studentDetails = $this->dashboardModel->studentGetById($student->user_id);
        }

        $allSubjects = $this->dashboardModel->getAllSubjects();
        
        $allModules = $this->dashboardModel->getAllModules();

        $allTutorialClasses = $this->dashboardModel->getAllTutorialClasses();


        $allTutorReports = $this->dashboardModel->getAllTutorReports();
        foreach ($allTutorReports as $tutorReport) {
            $tutorReport->tutorDetails = $this->dashboardModel->tutorGetById($tutorReport->tutor_id);
        }



        $allStudentReports = $this->dashboardModel->getAllStudentReports();
        foreach ($allStudentReports as $studentReport) {
            $studentReport->studentDetails = $this->dashboardModel->studentGetById($studentReport->student_id);
        }

        $allPaymentDetails = $this->dashboardModel->getAllPaymentDetails();

        $numOfStudentReport = $this->dashboardModel->numOfStudentReport();
        $numOfTutorReport = $this->dashboardModel->numOfTutorReport();
        $numOfTutorRequest = $this->dashboardModel->numOfTutorRequest();


        $data = [
            'allTutors' => $allTutors,
            'allStudents' => $allStudents,
            'allSubjects' => $allSubjects,
            'allModules' => $allModules,
            'allTutorialClasses' => $allTutorialClasses,
            'allTutorReports' => $allTutorReports,
            'allStudentReports' => $allStudentReports,
            'allPaymentDetails' => $allPaymentDetails,
            'numOfStudentReport' => $numOfStudentReport,
            'numOfTutorReport' => $numOfTutorReport,
            'numOfTutorRequest' => $numOfTutorRequest
        ];

        


        $this->view('admin/admin_dashboard', $request,$data);

    }
}