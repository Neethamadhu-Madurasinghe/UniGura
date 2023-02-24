<?php

class TutorUpdateProfile extends Controller{
    private ModelTutorUpdateProfile $updateProfile;

    public function __construct(){
        $this->updateProfile = $this->model('ModelTutorUpdateProfile');
    }

    public function tutorupdateProfile(Request $request)
    {

        if ($request->isPost()) {
            $body = $request->getBody();

            $data = [
                'first_name' => $body['first_name'],
                'last_name' => $body['last_name'],
                'phone_number' => $body['phone_number'],
                'letter_box_number' => $body['letter_box_number'],
                'street' => $body['street'],
                'city' => $body['city']

                // 'errors' => [
                //     'first_name_error' => '',
                //     'last_name_error' => '',
                //     'phone_number_error' => '',
                //     'letter_box_number_error' => '',
                //     'street_error' => '',
                //     'city_error' => '',
                //     'gender_error' => '',
                //     'profile_picture_error' => '',
                //     'mode_error' => ''
                // ]

            ];

            $this->updateProfile->update($body['first_name'],$body['last_name'],$body['phone_number'],$body['letter_box_number'],$body['street'],$body['city'],'28');

        }

        $tutorProfileDetails = $this->updateProfile->getTutorUserInfo('28');
        $tutorBankDetails = $this->updateProfile->getTutorBankDetails('28');
        //$getTutorEducationDetails = $this->updateProfile->


        $data = [
            
            "tutorProfileDetails" => $tutorProfileDetails, 
            "tutorBankDetails" => $tutorBankDetails
        
        ];


        // $errors =[];
        // if (empty($first_name)) {
        //     $errors[] = 'First name is required';
        // }
        // if (empty($last_name)) {
        //     $errors[] = 'Last name is required';
        // }
        // if (empty($phone_number)) {
        //     $errors[] = 'Phone number is required';
        // }
        // if (empty($letter_box_number)) {
        //     $errors[] = 'Letter box number is required';
        // }
        // if (empty($street)){
        //     $errors[] = 'Street is required';
        // }
        // if (empty($city)){
        //     $errors[] = 'City is required';
        // }
        // if (empty($gender)){
        //     $errors[] = 'Gender is required';
        // }
        // if (empty($profile_picture)){
        //     $errors[] = 'Profile picture is required';
        // }
        // if (empty($mode)){
        //     $errors[] = 'Mode is required';
        // }

        // // if (!empty($errors)){
        //     require_once 'views/TutorUpdateProfile.php';
        //     exit;
        // }


        // $result = $updateProfile->update($first_name,$last_name,$phone_number,$letter_box_number,$street,$city,$gender,$profile_picture,$mode);

        // if ($result){
        //     header('Location: /tutor/update-profile');
        // }else{
        //     echo 'Error updating profile information';
        // }

        $this->view('tutor/updateProfile', $request, $data);
    }
}
