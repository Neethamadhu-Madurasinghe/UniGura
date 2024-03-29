<?php

class StudentProfile extends Controller {
    private ModelStudent $studentModel;
    private ModelStudentRequest $requestModel;
    private ModelStudentPayment $paymentModel;
    private ModelUser $userModel;

//    This Model is just for telephone number validation
    private ModelTutorStudentCompleteProfile $tutorStudentModel;

    public function __construct() {
        $this->studentModel = $this->model('ModelStudent');
        $this->tutorStudentModel = $this->model('ModelTutorStudentCompleteProfile');
        $this->requestModel = $this->model('ModelStudentRequest');
        $this->paymentModel = $this->model('ModelStudentPayment');
        $this->userModel = $this->model('ModelUser');
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
                'mode' => $body['preferred-class-mode'],
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
//                     Successful profile update
                } else {
//                    Failed because of a duplication entry - there is a try catch block in the model
                    $errors['telephone_number_error'] = 'Telephone no. is already in use';
                    $data['errors'] = $errors;
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

        }

//        Load the view for both post and get requests
        $this->view('/student/profile', $request, $data);
    }


    public function changeProfilePicture(Request $request) {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
        }

//      Post request handler
        if ($request->isPost()) {
            $imagePath = handleUpload(
                array('.png', 'jpeg', 'jpg', 'JPG'),
                '\\public\\profile_pictures\\',
                'profile-picture'
            );

            if ($imagePath) {
//                Get previous image
                $previousImage = $request->getUserPicture();

                if ($this->studentModel->setStudentProfilePicture($imagePath, $request->getUserId())) {
//                    Delete the previous image if is not the default image
                    if ($previousImage && $previousImage !== '/public/img/student/profile.png') {
                        unlink(ROOT . $previousImage);
                    }
                    $_SESSION['user_picture'] = $imagePath;
                }

            }

            redirect('/student/profile');

        }
    }

    public function deleteTutorRequest(Request $request) {
        cors();

//      Sending a tutor request is a POST
        if ($request->isPost()) {
//          Unauthorized error code
            if (!$request->isLoggedIn() || !$request->isStudent()) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

            $body = json_decode(file_get_contents('php://input'), true);
            $body['student_id'] = $request->getUserId();

//            Validate request
            if (!isset($body['id'])) {
                header("HTTP/1.0 400 Bad Request");
                return;
            }

//            check if this user has access to this request id
            $request = $this->requestModel->getRequestById($body['id']);
            if (!isset($request['student_id'])) {
                header("HTTP/1.0 400 Bad Request");
                return;
            }

            if ($request['student_id'] == $body['id']) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

//            Delete the request
            if ($this->requestModel->deleteRequest($body['id'])) {
                header("HTTP/1.0 200 Success");
            }else {
                header("HTTP/1.0 500 Internal Server Error");
            }
        }
    }

    public function disableAccount(Request $request) {
        cors();
        if (!$request->isLoggedIn() || !$request->isStudent()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($this->userModel->disableAccount($request->getUserId())) {
            header("HTTP/1.0 200 Success");
        }else {
            header("HTTP/1.0 500 Internal Server Error");
        }

    }
}
