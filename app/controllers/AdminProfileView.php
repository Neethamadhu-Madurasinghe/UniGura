<?php

class AdminProfileView extends Controller{

    private mixed $adminProfileModel;

    public function __construct()
    {
        $this->adminProfileModel = $this->model('AdminProfileModel');
    }

    public function profileView(Request $request){


        $this->view('admin/profileView', $request);
    }
}