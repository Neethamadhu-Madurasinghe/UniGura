<?php
class StudentDashboard extends Controller {
    private ModelStudentTutoringClass $tutoringClassModel;
    private ModelStudentSubject $subjectModel;

    public function __construct() {
        $this->tutoringClassModel = $this->model('ModelStudentTutoringClass');
        $this->subjectModel = $this->model('ModelStudentSubject');
    }

    public function takenClasses(Request $request) {
        cors();
        $body = $request->getBody();

        $data = [];

//        Fetch all the classes of this student
        $data['tutoring_classes'] = $this->tutoringClassModel->getTutoringClassByStudentId($request->getUserId(), $body);

        header('Content-type: application/json');
        echo json_encode($data);
    }

    public function dashboard(Request $request) {
//       Redirect user to login page if not logged in
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

//       Redirect user to
        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
        }

        $data = [];

//      Fetch all the visible subjects
        $subjects = $this->subjectModel->getVisibleSubjects();
        $data['subjects'] = $subjects;

        $this->view('student/dashboard', $request, $data);
    }
}
