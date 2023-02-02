<?php 

    class TutorUpdateProfile extends Controller{
        private ModelTutorUpdateProfile $updateProfile;

        public function __construct(){
            $this -> updateProfile = $this ->model('ModelTutorUpdaeProfile');
            
        }

        public function update(){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $letter_box_number = $_POST['letter_box_number'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $gender = $_POST['gender'];
            $profile_picture = $_POST['profile_picture'];
            $mode = $_POST['mode'];


            $errors =[];
            if (empty($first_name)) {
                $errors[] = 'First name is required';
            }
            if (empty($last_name)) {
                $errors[] = 'Last name is required';
            }
            if (empty($phone_number)) {
                $errors[] = 'Phone number is required';
            }
            if (empty($letter_box_number)) {
                $errors[] = 'Letter box number is required';
            }
            if (empty($street)){
                $errors[] = 'Street is required';
            }
            if (empty($city)){
                $errors[] = 'City is required';
            }
            if (empty($gender)){
                $errors[] = 'Gender is required';
            }
            if (empty($profile_picture)){
                $errors[] = 'Profile picture is required';
            }
            if (empty($mode)){
                $errors[] = 'Mode is required';
            }

            if (!empty($errors)){
                require_once 'views/TutorUpdateProfile.php';
                exit;
            }


            $result = $updateProfile->update($first_name,$last_name,$phone_number,$letter_box_number,$street,$city,$gender,$profile_picture,$mode);

            if ($result){
                header('Location: /tutor/dashboard');
            }else{
                echo 'Error updating profile information';
            }

        }

    }


?>