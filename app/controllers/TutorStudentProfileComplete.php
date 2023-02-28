<?php

class TutorStudentProfileComplete extends Controller {
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
                'address_line_1' => $body['address-line-1'],
                'address_line_2' => $body['address-line-2'],
                'city' => $body['city'],
                'district' => $body['district'],
                'year_of_exam' => $body['year-of-exam'],
                'telephone_number' => $body['telephone-number'],
                'gender' => $body['gender'],
                'medium' => $body['medium'],
                'preferred_class_mode' => $body['preferred-class-mode'],
                'longitude' => $body['longitude'],
                'latitude' => $body['latitude'],
                'user_role' => 2,

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

//           Validate all the fields
            $data['errors']['first_name_error'] = validateName($data['first_name']);
            $data['errors']['last_name_error'] = validateName($data['last_name']);
            $data['errors']['address_line_1_error'] = validateAddressLines($data['address_line_1'], true);
            $data['errors']['address_line_2_error'] = validateAddressLines($data['address_line_2']);
            $data['errors']['city_error'] = validateCity($data['city']);
            $data['errors']['district_error'] = validateDistrict($data['district']);
            $data['errors']['year_of_exam_error'] = validateYearOfExam($data['year_of_exam']);
            $data['errors']['telephone_number_error'] =
                validateTelephoneNumber($data['telephone_number'], $this->tutorStudentModel);

            if (
                $data['errors']['first_name_error'] === '' &&
                $data['errors']['last_name_error'] === '' &&
                $data['errors']['address_line_1_error'] === '' &&
                $data['errors']['address_line_2_error'] === '' &&
                $data['errors']['city_error'] === '' &&
                $data['errors']['district_error'] === '' &&
                $data['errors']['year_of_exam_error'] === '' &&
                $data['errors']['telephone_number_error'] === ''
            ) {
//              Not storing user's location if he selected online mode
                if ($data['preferred_class_mode'] === 'online') {
                    $data['longitude'] = NULL;
                    $data['latitude'] = NULL;
                }

                if ($this->tutorStudentModel->setStudentDetails($data)) {
                    $_SESSION['user_role'] = 2;

                    if ($imagePath) {
                        $_SESSION['user_picture'] = $imagePath;
                    } else {
                        $_SESSION['user_picture'] = '/public/img/student/profile.png';
                    }
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
                'address_line_1' => '',
                'address_line_2' => '',
                'city' => '',
                'district' => '',
                'year_of_exam' => 2024,
                'telephone_number' => '',
                'gender' => 'not-selected',
                'medium' => 'sinhala',
                'preferred_class_mode' => 'online',
                'longitude' => 79.998407,
                'latitude' => 6.853399,

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
        }
        
        $this->view('student/auth/completeProfile', $request, $data);
    }

    public function tutorCompleteProfile(Request $request) {
        //      If the user is not a student who has not completed the profile details, redirect him
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }
        if (!$request->isProfileNotCompletedTutor()) {
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

//            Get the required documents for tutor registration
            $advancedLevelResultPath = handleUpload(
                array('.png', 'jpeg', 'jpg', 'JPG', 'pdf', 'docx'),
                '\\tutor_detail_files\\advanced_level_results\\',
                'advanced-level-result'
            );

            $idCopyPath = handleUpload(
                array('.png', 'jpeg', 'jpg', 'JPG', 'pdf', 'docx'),
                '\\tutor_detail_files\\id_copy\\',
                'id-copy'
            );

            $uniEntranceLetterPath = handleUpload(
                array('.png', 'jpeg', 'jpg', 'JPG', 'pdf', 'docx'),
                '\\tutor_detail_files\\uni_entrance\\',
                'university-entrance-letter'
            );

            $data = [
                'id' => $request->getUserId(),
                'profile_picture' => $imagePath,
                'first_name' => $body['first-name'],
                'last_name' => $body['last-name'],
                'address_line_1' => $body['address-line-1'],
                'address_line_2' => $body['address-line-2'],
                'city' => $body['city'],
                'district' => $body['district'],
                'telephone_number' => $body['telephone-number'],
                'gender' => $body['gender'],
                'preferred_class_mode' => $body['preferred-class-mode'],
                'longitude' => $body['longitude'],
                'latitude' => $body['latitude'],
                'university' => $body['university'],
                'education_qualification' => $body['education-qualification'],
                'description' => $body['description'],
                'advanced_level_result' => $advancedLevelResultPath,
                'id_copy'  => $idCopyPath,
                'university_entrance_letter' => $uniEntranceLetterPath,
                'user_role' => 7,

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'address_line_1_error' => '',
                    'address_line_2_error' => '',
                    'city_error' => '',
                    'district_error' => '',
                    'telephone_number_error' => '',
                    'university_error' => '',
                    'description_error' => '',
                    'advanced_level_result_error' => '',
                    'id_copy_error'  => '',
                    'university_entrance_letter_error' => ''
                ]

            ];

//           Validate all the fields
            $data['errors']['first_name_error'] = validateName($data['first_name']);
            $data['errors']['last_name_error'] = validateName($data['last_name']);
            $data['errors']['address_line_1_error'] = validateAddressLines($data['address_line_1'], true);
            $data['errors']['address_line_2_error'] = validateAddressLines($data['address_line_2']);
            $data['errors']['city_error'] = validateCity($data['city']);
            $data['errors']['district_error'] = validateDistrict($data['district']);
            $data['errors']['telephone_number_error'] =
                validateTelephoneNumber($data['telephone_number'], $this->tutorStudentModel);
            $data['errors']['description_error'] = validateDescription($data['description']);
            $data['errors']['university_error'] = validateUniversity($data['university']);
            $data['errors']['advanced_level_result_error'] = validateFilePath(
                $data['advanced_level_result'],
                'Please upload Advanced Level results sheet'
            );
            $data['errors']['id_copy_error'] = validateFilePath(
                $data['id_copy'],
                'Please upload NIC copy'
            );
            $data['errors']['university_entrance_letter_error'] = validateFilePath(
                $data['university_entrance_letter'],
                'Please upload University Entrance Letter'
            );

            $hasErrors = FALSE;

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }


            if (!$hasErrors) {
//              Not storing user's location if he selected online mode
                if ($data['preferred_class_mode'] === 'online') {
                    $data['longitude'] = NULL;
                    $data['latitude'] = NULL;
                }

                if ($this->tutorStudentModel->setTutorDetails($data)) {
                    $_SESSION['user_role'] = 7;
                    if ($imagePath) {
                        $_SESSION['user_picture'] = $imagePath;
                    } else {
                        $_SESSION['user_picture'] = '/public/img/student/profile.png';
                    }
                    redirect('tutor/pending');
                }else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }

            }else {
                if ($uniEntranceLetterPath) { unlink(ROOT . $uniEntranceLetterPath); }
                if ($idCopyPath) { unlink(ROOT . $idCopyPath); }
                if ($advancedLevelResultPath) { unlink(ROOT . $advancedLevelResultPath); }
                if ($imagePath) {unlink(ROOT . $imagePath); }

            }

            $this->view('tutor/auth/completeProfile', $request, $data);

//        If the request is a GET request, then serve the page
        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'address_line_1' => '',
                'address_line_2' => '',
                'city' => '',
                'district' => '',
                'telephone_number' => '',
                'gender' => 'not-selected',
                'medium' => 'sinhala',
                'description' => '',
                'preferred_class_mode' => 'online',
                'longitude' => 79.998407,
                'latitude' => 6.853399,
                'university' => '',
                'education_qualification' => '',

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'address_line_1_error' => '',
                    'address_line_2_error' => '',
                    'city_error' => '',
                    'district_error' => '',
                    'telephone_number_error' => '',
                    'university_error' => '',
                    'description_error' => '',
                    'advanced_level_result_error' => '',
                    'id_copy_error'  => '',
                    'university_entrance_letter_error' => ''
                ]



            ];
        }

        $this->view('tutor/auth/completeProfile', $request, $data);
    }

   

}