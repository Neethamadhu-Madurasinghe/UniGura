<?php
class StudentDashboard extends Controller {
    private ModelStudentDashboard $dashboardModel;
    private ModelStudentSubject $subjectModel;

    public function __construct() {
        $this->dashboardModel = $this->model('ModelStudentDashboard');
        $this->subjectModel = $this->model('ModelStudentSubject');
    }

    public function dashboard(Request $request) {
        $body = $request->getBody();

        $data = [
            'class-sort-by-subject' => $body['class-sort-by-subject'] ?? '',
            'class-sort-by-completion' =>  $body['class-sort-by-completion'] ?? '',
            'class-sort-by-payment' =>  $body['class-sort-by-payment'] ?? ''
        ];


//        Fetch all the classes of this student
        $data['tutoring_classes'] = $this->dashboardModel->getTutoringClassByStudentId($request->getUserId());

//        Filter tutoring class list according to the request
        if (!($data['class-sort-by-subject'] === '' || $data['class-sort-by-subject'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassBySubject(
                $data['tutoring_classes'],
                $data['class-sort-by-subject']
            );
        }

        if (!($data['class-sort-by-completion'] === '' || $data['class-sort-by-completion'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassByCompletion(
                $data['tutoring_classes'],
                $data['class-sort-by-completion']
            );
        }

        if (!($data['class-sort-by-completion'] === '' || $data['class-sort-by-completion'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassByCompletion(
                $data['tutoring_classes'],
                $data['class-sort-by-completion']
            );
        }

        if (!($data['class-sort-by-payment'] === '' || $data['class-sort-by-payment'] === 'all')) {
            $data['tutoring_classes'] = $this->filterTutoringClassByPayment(
                $data['tutoring_classes'],
                $data['class-sort-by-payment']
            );
        }

//      Fetch all the visible subjects
        $subjects = json_decode(json_encode($this->subjectModel->getVisibleSubjects()), true);
        $data['subjects'] = $subjects;

//        Uncomment this to see the data array
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

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
