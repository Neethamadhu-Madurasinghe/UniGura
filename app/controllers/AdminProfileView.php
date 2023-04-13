<?php

class AdminProfileView extends Controller
{

    private mixed $adminProfileModel;

    public function __construct()
    {
        $this->adminProfileModel = $this->model('ModelAdminProfile');
    }

    public function profileView(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $FormValidationError = array();
        $FormValidationError['incorrectPassword'] = '';
        $FormValidationError['passwordNotMatch'] = '';
        $FormValidationError['passwordChangeSuccessful'] = '';

        $data = $FormValidationError;

        $this->view('admin/profileView', $request,$data);
    }




    public function updatePassword(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $bodyData = $request->getBody();

            $FormValidationError = array();

            $dbHashedPassword = $this->adminProfileModel->getAdminCurrentPassword($request->getUserId());
            $CurrentPassword = $bodyData['currentPassword'];
            $newPassword = $bodyData['newPassword'];
            $confirmPassword = $bodyData['confirmPassword'];

            if (!password_verify($CurrentPassword, $dbHashedPassword->password)) {
                $FormValidationError['incorrectPassword'] = 'incorrectPassword';
            }


            if ($newPassword != $confirmPassword) {
                $FormValidationError['passwordNotMatch'] = 'passwordNotMatch';
            }

            if (password_verify($CurrentPassword, $dbHashedPassword->password) && $newPassword == $confirmPassword) {
                $FormValidationError['passwordChangeSuccessful'] = 'passwordChangeSuccessful';
                $hashedNewPassword = password_hash($bodyData['newPassword'], PASSWORD_DEFAULT);

                $this->adminProfileModel->updatePassword($request->getUserId(), $hashedNewPassword);
            }

            $data = $FormValidationError;


            $this->view('admin/profileView', $request, $data);
        }
    }
}
