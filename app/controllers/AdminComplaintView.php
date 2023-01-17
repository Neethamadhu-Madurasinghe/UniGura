<?php

class AdminComplaintView extends Controller{
    private mixed $viewComplaintModel;

    public function __construct() {

        $this->viewComplaintModel = $this->model('ModelAdminComplaintView');
    }

    public function viewComplaint(Request $request){

        $this->view('admin/complaint_view',$request);
    }
}