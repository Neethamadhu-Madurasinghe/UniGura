<?php 

class TutorReportProblem extends Controller{
    private ModelTutorReportProblem $reportProblem;

    public function __construct(){
        $this->reportProblem = $this->model('ModelTutorReportProblem');
    }
    
   


    public function viewReport(Request $request){

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }
        $body = $request->getBody();

        if ($request->isPost()) {
            $data = [
                'tutor_id' => $request->getUserId(),
                'student_id' => $body['student_id'],
                'description' => $body['description'],
                'report_reasons' => NULL
            ];

            if (isset($body['report_reason']) ){
                $data['report_reasons'] = $body['report_reason'];
            }

        if ($this->reportProblem->setStudentreport($data) == 0) {
                    redirect('tutor/class');
            }  
        }

        $data['student_id'] = $body['student_id'];

        $reportReason = $this->reportProblem->getTutorReportReason();

        $data['report_reasons'] = json_encode($reportReason);


        $this->view('tutor/reportProblem',$request,$data);
    }


}
