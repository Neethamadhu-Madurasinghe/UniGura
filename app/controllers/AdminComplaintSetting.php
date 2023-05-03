<?php

class AdminComplaintSetting extends Controller
{
    private mixed $complaintSettingsModel;

    public function __construct()
    {
        $this->complaintSettingsModel = $this->model('ModelAdminRequirementComplaints');
    }

    public function complaintSetting(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        
        $studentComplaintReason = $this->complaintSettingsModel->getStudentComplaintReason();
        $tutorComplaintReason = $this->complaintSettingsModel->getTutorComplaintReason();

        $data = [
            'studentComplaintReason' => $studentComplaintReason,
            'tutorComplaintReason' => $tutorComplaintReason,

            'errors' => [
                'student_reason' => '',
            ]
        ];

        $this->view('admin/complaint_settings', $request, $data);

    }


}