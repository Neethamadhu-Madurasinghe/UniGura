<?php

class StudentProfile extends Controller {
    private ModelStudent $studentModel;
    private ModelStudentRequest $requestModel;
//    This controller is just for telephone number validation
    private ModelTutorStudentCompleteProfile $tutorStudentModel;

    public function __construct() {
        $this->studentModel = $this->model('ModelStudent');
        $this->tutorStudentModel = $this->model('ModelTutorStudentCompleteProfile');
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

            $body = $request->getBody();

            $data = [
                'id' => $request->getUserId(),
                'first_name' => $body['first-name'],
                'last_name' => $body['last-name'],
                'address_line1' => $body['address-line-1'],
                'address_line2' => $body['address-line-2'],
                'city' => $body['city'],
                'district' => $body['district'],
                'year_of_exam' => $body['year-of-exam'],
                'phone_number' => $body['telephone-number'],
                'gender' => $body['gender'],
                'medium' => $body['medium'],
                'preferred_class_mode' => $body['preferred-class-mode'],
                'longitude' => $body['longitude'],
                'latitude' => $body['latitude'],

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'address_line_1_error' => '',
                    'address_line_2_error' => '',
                    'city_error' => '',
                    'district_error' => '',
                    'year_of_exam_error' => '',
                    'telephone_number_error' => ''
                ]

            ];


            $errors = [];

//           Validate all the fields
            $errors['first_name_error'] = validateName($data['first_name']);
            $errors['last_name_error'] = validateName($data['last_name']);
            $errors['address_line_1_error'] = validateAddressLines($data['address_line1'], true);
            $errors['address_line_2_error'] = validateAddressLines($data['address_line2']);
            $errors['city_error'] = validateCity($data['city']);
            $errors['district_error'] = validateDistrict($data['district']);
            $errors['year_of_exam_error'] = validateYearOfExam($data['year_of_exam']);
            $errors['telephone_number_error'] =
                validateTelephoneNumber($data['phone_number'], $this->tutorStudentModel, false);

            if (
                $errors['first_name_error'] === '' &&
                $errors['last_name_error'] === '' &&
                $errors['address_line_1_error'] === '' &&
                $errors['address_line_2_error'] === '' &&
                $errors['city_error'] === '' &&
                $errors['district_error'] === '' &&
                $errors['year_of_exam_error'] === '' &&
                $errors['telephone_number_error'] === ''
            ) {
                if ($this->studentModel->setStudentProfileDetails($data)) {
                    echo 'Success';
                }else {
                    echo 'fail';
                }

            }else {
                $data = $this->studentModel->getAllDetailsById($request->getUserId());
                $data['errors'] = $errors;
            }



//      Otherwise handle GET request
        } else {

//           Fetch student data
            $data = $this->studentModel->getAllDetailsById($request->getUserId());

            $errors = [
                'first_name_error' => '',
                'last_name_error' => '',
                'address_line_1_error' => '',
                'address_line_2_error' => '',
                'city_error' => '',
                'district_error' => '',
                'year_of_exam_error' => '',
                'telephone_number_error' => ''
            ];

            $data['errors'] = $errors;

//          Fetch request data
            $data['requests'] = $this->requestModel->getRequestsByStudentId($request->getUserId());

        }
        $this->view('/student/profile', $request, $data);
    }
}