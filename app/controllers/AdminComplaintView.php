<?php

class AdminComplaintView extends Controller
{
    private mixed $viewComplaintModel;

    public function __construct(){
        $this->viewComplaintModel = $this->model('ModelAdminComplaintView');
    }

    public function viewComplaint(Request $request)
    {

        if($request->isGet()){
            $data = $request->getBody();

            $studentComplainID = $data['studentComplaintId'];

            $oneStudentComplaint = $this->viewComplaintModel->studentReportById($studentComplainID);

            $oneStudentComplaint->tutor = $this->viewComplaintModel->userById($oneStudentComplaint->tutor_id);
            $oneStudentComplaint->student = $this->viewComplaintModel->userById($oneStudentComplaint->student_id);
            $oneStudentComplaint->reportReason = $this->viewComplaintModel->reportSeasonById($oneStudentComplaint->reason_id);


            $allStudentComplaints = $this->viewComplaintModel->getStudentComplaints();
            $allStudentComplaints = array_map(function($complain){
                $complain->tutor = $this->viewComplaintModel->userById($complain->tutor_id);
                $complain->student = $this->viewComplaintModel->userById($complain->student_id);
                $complain->reportReason = $this->viewComplaintModel->reportSeasonById($complain->reason_id);
                return $complain;
            }, $allStudentComplaints);
            

            $otherStudentComplaints = [];

            foreach ($allStudentComplaints as $complain) {
                if($complain->id != $studentComplainID && $complain->tutor_id == $oneStudentComplaint->tutor_id){
                    $otherStudentComplaints[] = $complain;
                }
            }

            $data = [
                'oneStudentComplaint' => $oneStudentComplaint,
                'otherStudentComplaints' => $otherStudentComplaints
            ];
        }
        

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/complaint_view', $request, $data);
    }
}
