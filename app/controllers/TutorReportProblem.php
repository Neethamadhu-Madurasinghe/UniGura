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
                'report_reason' => $body['report_reason'],
                'student_id' => $body['student_id'],
                'description' => $body['description']
            
            ];

        if ($this->reportProblem->setStudentreport($data) == 0) {
                    redirect('tutor/class');
            }  

        }

        $data['student_id'] = $body['student_id'];

        $reportReason = $this->reportProblem->getTutorReportReason();

        $data['report_resons'] = json_encode($reportReason);


        $this->view('tutor/reportProblem',$request,$data);
    }


}
