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

        $studentComplaintReason = $this->complaintSettingsModel->getStudentComplaintReason();
        $tutorComplaintReason = $this->complaintSettingsModel->getTutorComplaintReason();

        $data = [
            'studentComplaintReason' => $studentComplaintReason,
            'tutorComplaintReason' => $tutorComplaintReason
        ];

        $this->view('admin/complaint_settings', $request, $data);

    }


}