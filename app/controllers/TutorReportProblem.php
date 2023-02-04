<?php 

class TutorReportProblem extends Controller{
    private ModelTutorReportProblem $reportProblem;

    public function __construct(){
        $this->reportProblem = $this->model('ModelTutorReportProblem');
    }
    
    public function tutorreportProblem(Request $request){

    }


}




?>
