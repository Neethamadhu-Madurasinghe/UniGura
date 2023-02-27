<?php

class AdminProfileView extends Controller{

    private mixed $adminProfileModel;

    public function __construct(){
        $this->adminProfileModel = $this->model('ModelAdminProfile');
    }

    public function profileView(Request $request){
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $this->view('admin/profileView', $request);
    }


    public function updatePassword(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $bodyData = $request->getBody();

            $newPassword = $bodyData['newPassword'];

            $this->adminProfileModel->updatePassword($request->getUserId(),$newPassword);


            $this->view('admin/profileView', $request);
        }


    }
}
