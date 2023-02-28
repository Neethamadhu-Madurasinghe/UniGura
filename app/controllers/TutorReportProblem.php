<?php 

class TutorReportProblem extends Controller{
    private ModelTutorReportProblem $reportProblem;

    public function __construct(){
        $this->reportProblem = $this->model('ModelTutorReportProblem');
    }
    
    public function tutorreportProblem(Request $request){

        if ($request->isPost()){
            $bodyData = $request->getBody();

            echo '<pre>';
            echo print_r($bodyData);
            echo '</pre>';


        }

        $data = [];

        $this->view('tutor/reportProblem', $request,$data);
    }


}




?>
