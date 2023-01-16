<?php

class StudentProfile extends Controller {
    private ModelTutorStudentCompleteProfile $tutorStudentModel;

    public function __construct() {
        $this->tutorStudentModel = $this->model('ModelTutorStudentCompleteProfile');
    }

    public function studentCompleteProfile(Request $request) {
//      If the user is not a student who has not completed the profile details, redirect him
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }
        if (!$request->isProfileNotCompletedStudent()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isPost()) {
            $body = $request->getBody();

//            Get the profile image file
            $imagePath = handleUpload(
                array('.png', 'jpeg', 'jpg', 'JPG'),
                '\\public\\profile_pictures\\',
                'profile-picture'
            );

            $data = [
                'id' => $request->getUserId(),
                'profile_picture' => $imagePath,
                'first_name' => $body['first-name'],
                'last_name' => $body['last-name'],
                'letter_box_number' => $body['letter-box-number'],
                'street' => $body['street'],
                'city' => $body['city'],
                'year_of_exam' => $body['year-of-exam'],
                'telephone_number' => $body['telephone-number'],
                'gender' => $body['gender'],
                'medium' => $body['medium'],
                'preferred_class_mode' => $body['preferred-class-mode'],
                'longitude' => $body['longitude'],
                'latitude' => $body['latitude'],

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'letter_box_number_error' => '',
                    'street_error' => '',
                    'city_error' => '',
                    'year_of_exam_error' => '',
                    'telephone_number_error' => ''
                ]

            ];

//           Validate all the fields
            $data['errors']['first_name_error'] = validateName($data['first_name']);
            $data['errors']['last_name_error'] = validateName($data['last_name']);
            $data['errors']['letter_box_number_error'] = validateLetterBoxNumber($data['letter_box_number']);
            $data['errors']['street_error'] = validateStreet($data['street']);
            $data['errors']['city_error'] = validateCity($data['city']);
            $data['errors']['year_of_exam_error'] = validateYearOfExam($data['year_of_exam']);
            $data['errors']['telephone_number_error'] =
                validateTelephoneNumber($data['telephone_number'], $this->tutorStudentModel);

            if (
                $data['errors']['first_name_error'] === '' &&
                $data['errors']['last_name_error'] === '' &&
                $data['errors']['letter_box_number_error'] === '' &&
                $data['errors']['street_error'] === '' &&
                $data['errors']['city_error'] === '' &&
                $data['errors']['year_of_exam_error'] === '' &&
                $data['errors']['telephone_number_error'] === ''
            ) {
//              Not storing user's location if he selected online mode
                if ($data['preferred_class_mode'] === 'online') {
                    $data['longitude'] = NULL;
                    $data['latitude'] = NULL;
                }

                if ($this->tutorStudentModel->setStudentProfileDetails($data) &&
                    $this->tutorStudentModel->setUserRole($request->getUserId(), 2)) {
                    $_SESSION['user_role'] = 2;
                    redirectBasedOnUserRole($request);
                }else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }
            }


            $this->view('student/auth/completeProfile', $request, $data);


//        If the request is a GET request, then serve the page
        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'letter_box_number' => '',
                'street' => '',
                'city' => '',
                'year_of_exam' => 0,
                'telephone_number' => '',
                'gender' => 'not-selected',
                'medium' => 'sinhala',
                'preferred_class_mode' => 'online',
                'longitude' => 79.998407,
                'latitude' => 6.853399,

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'letter_box_number_error' => '',
                    'street_error' => '',
                    'city_error' => '',
                    'year_of_exam_error' => '',
                    'telephone_number_error' => ''
                ]

            ];
        }
        
        $this->view('student/auth/completeProfile', $request, $data);
    }

}