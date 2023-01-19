<?php

class AdminComplaintView extends Controller
{
    private mixed $viewComplaintModel;

    public function __construct(){
        $this->viewComplaintModel = $this->model('ModelAdminComplaintView');
    }

    public function viewComplaint(Request $request)
    {

        // $allStudentComplaints = $this->viewComplaintModel->getStudentComplaints();

        // $data = $allStudentComplaints;

        if($request->isGet()){
            $data = $request->getBody();
        }
        

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        $this->view('admin/complaint_view', $request);
    }
}
