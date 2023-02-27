<?php

class TutorUpdateProfile extends Controller{
    private ModelTutorUpdateProfile $updateProfile;

    public function __construct(){
        $this->updateProfile = $this->model('ModelTutorUpdateProfile');
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


        if ($request->isPost()) {
            $body = $request->getBody();

            $data = [
                'id' => $request->getUserId(),
                'first_name' => $body['first_name'],
                'last_name' => $body['last_name'],
                'letter_box_number' => $body['letter_box_number'],
                'phone_number' => $body['phone_number'],
                'street' => $body['street'],
                'city' => $body['city'],
                'description' => $body['description'],
                'bank_account_owner'=> $body['bank_account_owner'],
                'bank_account_number'=> $body['bank_account_number'],
                'bank_name'=> $body['bank_name'],
                'bank_branch'=> $body['bank_branch'],
                'education_qualification' => $body['education_qualification'],
                'university' => $body['university'],

                'errors' => [
                    'first_name_error' => '',
                    'last_name_error' => '',
                    'phone_number_error' => '',
                    'letter_box_number_error' => '',
                    'street_error' => '',
                    'city_error' => '',
                    'description_error' => '',
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
            $data['errors']['letter_box_number_error'] = validateLetterBoxNumber($data['letter_box_number']);
            $data['errors']['phone_number_error'] = "";
            $data['errors']['street_error'] = validateStreet($data['street']);
            $data['errors']['city_error'] = validateCity($data['city']);
            $data['errors']['description_error'] = "";
            $data['errors']['account_name_error'] = "";
            $data['errors']['account_number_error'] = "";
            $data['errors']['bank_name_error'] = "";
            $data['errors']['branch_error'] = "";
            $data['errors']['qualification_error'] = "";
            $data['errors']['university_error'] = validateUniversity($data['university']);

            $hasErrors = FALSE;

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }


            if (!$hasErrors) {
//              Not storing user's location if he selected online mode
                

                if ( $this->updateProfile->update($data)) {
                    redirect('tutor/update-profile');
                }else {
                    header("HTTP/1.0 500 Internal Server Error");
                    die('Something went wrong');
                }

            }

            $this->view('tutor/updateProfile', $request, $data);


            

       

        }

        $tutorProfileDetails = $this->updateProfile->getTutorUserInfo($request->getUserId());
        $tutorBankDetails = $this->updateProfile->getTutorBankDetails($request->getUserId());

        $data = [
            'id' => $request->getUserId(),
            'first_name' => $tutorProfileDetails[0]['first_name'],
            'last_name' => $tutorProfileDetails[0]['last_name'],
            'letter_box_number' => $tutorProfileDetails[0]['letter_box_number'],
            'phone_number' => $tutorProfileDetails[0]['phone_number'],
            'street' => $tutorProfileDetails[0]['street'],
            'city' => $tutorProfileDetails[0]['city'],
            'description' =>$tutorBankDetails[0]['description'],
            'bank_account_owner'=> $tutorBankDetails[0]['bank_account_owner'],
            'bank_account_number'=> $tutorBankDetails[0]['bank_account_number'],
            'bank_name'=> $tutorBankDetails[0]['bank_name'],
            'bank_branch'=> $tutorBankDetails[0]['bank_branch'],
            'education_qualification' => $tutorBankDetails[0]['education_qualification'],
            'university' => $tutorBankDetails[0]['university'],
            
            'errors' => [
                'first_name_error' => '',
                'last_name_error' => '',
                'phone_number_error' => '',
                'letter_box_number_error' => '',
                'street_error' => '',
                'city_error' => '',
                'description_error' => '',
                'account_name_error' => '',
                'account_number_error' => '',
                'bank_name_error' => '',
                'branch_error' => '',
                'qualification_error' => '',
                'university_error' => ''
            ]];


        $this->view('tutor/updateProfile', $request, $data);
    }

}
