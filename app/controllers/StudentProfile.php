<?php

class StudentProfile extends Controller {
    private ModelStudent $studentModel;
    private ModelStudentRequest $requestModel;

    public function __construct() {
        $this->studentModel = $this->model('ModelStudent');
        $this->tutorStudentModel = $this->model('ModelTutorStudentAuth');
        $this->requestModel = $this->model('ModelStudentRequest');
    }

    public function profile(Request $request) {
//      Student should be logged in
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
        }

//      Post request handler
        if ($request->isPost()) {


//      Otherwise handle GET request
        } else {

//           Fetch student data
            $data = $this->studentModel->getAllDetailsById($request->getUserId());


            $errors = [
                'first_name_error' => '',
                'last_name_error' => '',
                'letter_box_number_error' => '',
                'street_error' => '',
                'city_error' => '',
                'year_of_exam_error' => '',
                'telephone_number_error' => ''
            ];

            $data['errors'] = $errors;
//            TODO: Fix this problem - add medium field into student table
            $data['medium'] = 'sinhala';

//          Fetch request data
            $data['requests'] = $this->requestModel->getRequestsByStudentId($request->getUserId());

        }
        $this->view('/student/profile', $request, $data);
    }
}