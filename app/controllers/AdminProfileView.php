<?php

class AdminProfileView extends Controller{

    private mixed $adminProfileModel;

    public function __construct(){
        $this->adminProfileModel = $this->model('AdminProfileModel');
    }

    public function profileView(Request $request){

        $this->view('admin/profileView', $request);
    }


    public function updatePassword(Request $request){

        if ($request->isPost()) {
            $bodyData = $request->getBody();

            echo '<pre>';
            print_r($bodyData);
            echo '</pre>';
        }


        // $this->view('admin/profileView', $request);
    }
}
