<?php

class AdminComplaintSetting extends Controller
{
    private mixed $complaintSettingsModel;

    public function __construct()
    {
        $this->complaintSettingsModel = $this->model('ModelRequirementComplaints');
    }

    public function complaintSetting(Request $request)
    {
        // $allReportReason = $this->complaintSettingsModel->getReportReason();

        // // echo '<pre>';
        // // print_r($allReportReason);
        // // echo '</pre>';

        // $data = [
        //     'allReportReason' => $allReportReason
        // ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/complaint_settings', $request);

    }


}