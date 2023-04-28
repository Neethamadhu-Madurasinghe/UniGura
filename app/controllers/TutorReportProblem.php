<?php 

class TutorReportProblem extends Controller{
    private ModelTutorReportProblem $reportProblem;

    public function __construct(){
        $this->reportProblem = $this->model('ModelTutorReportProblem');
    }
    
    public function tutorreportProblem(Request $request){
       
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }    

        if ($request->isPost()){
            $body = $request->getBody();

            echo '<pre>';
            echo print_r($body);
            echo '</pre>';
        }
        $data = [];

        // $data = [
        //     'id' =>$request->getUserId(),
        //     'description'=>$body['description']
        // ];

        // if($this->reportProblem->tutorReportProblem($data)){
        //     redirect('/tutor/classes');

        // }

       

        $this->view('tutor/reportProblem', $request,$data);
    }


}
