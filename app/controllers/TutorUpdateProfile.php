<?php

class TutorUpdateProfile extends Controller
{
    private ModelTutorUpdateProfile $updateProfile;
    private ModelTutorStudentCompleteProfile $tutorStudentModel;

    public function __construct()
    {
        $this->updateProfile = $this->model('ModelTutorUpdateProfile');
        $this->tutorStudentModel = $this->model('ModelTutorStudentCompleteProfile');
    }


    public function tutorupdateProfile(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        $imagePath = handleUpload(
            array('.png', 'jpeg', 'jpg', 'JPG'),
            '\\public\\profile_pictures\\',
            'profile-picture'
        );


        if ($request->isPost()) {
            $body = $request->getBody();

            $tutor_id = $request->getUserId();

            $data = [
                'id' => $request->getUserId(),
                'first_name' => $body['first_name'],
                'last_name' => $body['last_name'],
                'phone_number' => $body['phone_number'],
                'address_line1' => $body['address_line1'],
                'address_line2' => $body['address_line2'],
                'city' => $body['city'],
                'district' => $body['district'],
                'bank_account_owner' => $body['bank_account_owner'],
                'bank_account_number' => $body['bank_account_number'],
                'bank_name' => $body['bank_name'],
                'bank_branch' => $body['bank_branch'],
                'education_qualification' => $body['education_qualification'],
                'university' => $body['university'],

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'phone_number_error' => '',
                    'address_line1_error' => '',
                    'address_line2_error' => '',
                    'city_error' => '',
                    'account_name_error' => '',
                    'account_number_error' => '',
                    'bank_name_error' => '',
                    'branch_error' => '',
                    'qualification_error' => '',
                    'university_error' => ''
                ]

            ];


            $data['errors']['first_name_error'] = validateName($data['first_name']);
            $data['errors']['last_name_error'] = validateName($data['last_name']);
            $data['errors']['phone_number_error'] = validateTelephoneNumberForTutor($data['phone_number'], $this->tutorStudentModel, $tutor_id);
            $data['errors']['address_line1_error'] = validateAddressLines($data['address_line1'], true);
            $data['errors']['address_line2_error'] = validateAddressLines($data['address_line2']);
            $data['errors']['city_error'] = validateCity($data['city']);
            $data['errors']['account_name_error'] = validateAccountNameForTutor($data['bank_account_owner'], $this->tutorStudentModel, $tutor_id);
            $data['errors']['account_number_error'] = validateAccountNumberForTutor($data['bank_account_number'], $this->tutorStudentModel, $tutor_id);
            $data['errors']['bank_name_error'] = validateBankName($data['bank_name']);
            $data['errors']['branch_error'] = validateBranch($data['bank_branch']);
            $data['errors']['university_error'] = validateUniversity($data['university']);

            $hasErrors = FALSE; // has not errors 

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE; 
                }
            }

            if ($hasErrors) {
                echo json_encode([
                    "first_name_error" => $data['errors']['first_name_error'],
                    "last_name_error" => $data['errors']['last_name_error'],
                    "phone_number_error" => $data['errors']['phone_number_error'],
                    "address_line1_error" => $data['errors']['address_line1_error'],
                    "address_line2_error" => $data['errors']['address_line2_error'],
                    "city_error" => $data['errors']['city_error'],
                    "account_name_error" => $data['errors']['account_name_error'],
                    "account_number_error" => $data['errors']['account_number_error'],
                    "bank_name_error" => $data['errors']['bank_name_error'],
                    "branch_error" => $data['errors']['branch_error'],
                    "qualification_error" => $data['errors']['qualification_error'],
                    "university_error" => $data['errors']['university_error']
                ]);

                exit;
            }


            if (!$hasErrors) {
                if ($this->updateProfile->update($data)) {
                    echo json_encode([
                        "message" => "Data saved successfully"
                    ]);
                    exit;
                    // redirect('tutor/update-profile');
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }
            }

            // $this->view('tutor/updateProfile', $request, $data);
        }

        $tutorProfileDetails = $this->updateProfile->getTutorUserInfo($request->getUserId());
        $tutorBankDetails = $this->updateProfile->getTutorBankDetails($request->getUserId());
        $tutorTimeSlots = $this->updateProfile->getTimeSlots($request->getUserId());


        $data = [
            'id' => $request->getUserId(),
            'first_name' => $tutorProfileDetails[0]['first_name'],
            'last_name' => $tutorProfileDetails[0]['last_name'],
            'phone_number' => $tutorProfileDetails[0]['phone_number'],
            'address_line_1' => $tutorProfileDetails[0]['address_line1'],
            'address_line_2' => $tutorProfileDetails[0]['address_line2'],
            'city' => $tutorProfileDetails[0]['city'],
            'district' => $tutorProfileDetails[0]['district'],
            'description' => $tutorBankDetails[0]['description'],
            'bank_account_owner' => $tutorBankDetails[0]['bank_account_owner'],
            'bank_account_number' => $tutorBankDetails[0]['bank_account_number'],
            'bank_name' => $tutorBankDetails[0]['bank_name'],
            'bank_branch' => $tutorBankDetails[0]['bank_branch'],
            'education_qualification' => $tutorBankDetails[0]['education_qualification'],
            'university' => $tutorBankDetails[0]['university'],
            'tutorTimeSlots' => $tutorTimeSlots,

            // 'errors' => [
            //     'first_name_error' => '',
            //     'last_name_error' => '',
            //     'phone_number_error' => '',
            //     'address_line1_error' => '',
            //     'address_line2_error' => '',
            //     'city_error' => '',
            //     'account_name_error' => '',
            //     'account_number_error' => '',
            //     'bank_name_error' => '',
            //     'branch_error' => '',
            //     'qualification_error' => '',
            //     'university_error' => ''
            // ]
        ];

        $this->view('tutor/updateProfile', $request, $data);
    }



    public function changeProfilePicture(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if (!$request->isTutor()) {
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

                if ($this->updateProfile->setTutorProfilePicture($imagePath, $request->getUserId())) {
                    //                    Delete the previous image if is not the default image
                    if ($previousImage && $previousImage !== '/public/img/student/profile.png') {
                        unlink(ROOT . $previousImage);
                    }
                    $_SESSION['user_picture'] = $imagePath;
                }
            }

            redirect('/tutor/update-profile');
        }
    }


    public function updateTimeSlots(Request $request)
    {
        // Get the raw JSON input data
        $body = file_get_contents('php://input');

        // Decode the JSON data into a PHP array
        $data = json_decode($body, true);


        // Now you can access the elements of the JavaScript array in the PHP script
        $time_slots = $data['time_slots'];

        $tutor_id = $request->getUserId();


        foreach ($time_slots as $time_slot) {
            $this->updateProfile->updateTutorTimeSlots($time_slot['state'],  $tutor_id, $time_slot['id']);
        }


        // Return a JSON response to the client
        echo json_encode([
            "message" => "Time slots data saved successfully"
        ]);
    }
}
