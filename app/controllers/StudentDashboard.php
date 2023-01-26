<?php
class StudentDashboard extends Controller {
    private ModelStudentDashboard $dashboardModel;
    private ModelStudentSubject $subjectModel;

    public function __construct() {
        $this->dashboardModel = $this->model('ModelStudentDashboard');
        $this->subjectModel = $this->model('ModelStudentSubject');
    }

    public function takenClasses(Request $request) {
        cors();
        $body = $request->getBody();

        $data = [];

//        Fetch all the classes of this student
        $data['tutoring_classes'] = $this->dashboardModel->getTutoringClassByStudentId($request->getUserId());

//        Filter tutoring class list according to the request
        if (!($body['sort-subject'] === '' || $body['sort-subject'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassBySubject(
                $data['tutoring_classes'],
                $body['sort-subject']
            );
        }

        if (!($body['sort-completion'] === '' || $body['sort-completion'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassByCompletion(
                $data['tutoring_classes'],
                $body['sort-completion']
            );
        }

        if (!($body['sort-completion'] === '' || $body['sort-completion'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassByCompletion(
                $data['tutoring_classes'],
                $body['sort-completion']
            );
        }

        if (!($body['sort-payment'] === '' || $body['sort-payment'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassByPayment(
                $data['tutoring_classes'],
                $body['sort-payment']
            );
        }

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

    private function filterTutoringClassBySubject(array $tutoringClasses, String $subjectId): array {
        $filteredArray = [];
        foreach ($tutoringClasses as $tutoringClass) {
            if ($tutoringClass['subject']['id'] == $subjectId) {
                $filteredArray[] = $tutoringClass;
            }
        }

        return $filteredArray;
    }

    private function filterTutoringClassByCompletion(array $tutoringClasses, string $completionStatus): array {
        $filteredArray = [];
        foreach ($tutoringClasses as $tutoringClass) {
            if ($completionStatus == 'completed') {
                if ($tutoringClass['incomplete_day_count'] == 0) {
                    $filteredArray[] = $tutoringClass;
                }

            }else {
                if ($tutoringClass['incomplete_day_count'] > 0) {
                    $filteredArray[] = $tutoringClass;
                }
            }
        }

        return $filteredArray;
    }

    private function filterTutoringClassByPayment(array $tutoringClasses, string $completionStatus): array {
        $filteredArray = [];
        foreach ($tutoringClasses as $tutoringClass) {
            if ($completionStatus == 'payment-not-due') {
                if ($tutoringClass['payment_due_day_count'] == 0) {
                    $filteredArray[] = $tutoringClass;
                }

            }else {
                if ($tutoringClass['payment_due_day_count'] > 0) {
                    $filteredArray[] = $tutoringClass;
                }
            }
        }

        return $filteredArray;
    }
}
