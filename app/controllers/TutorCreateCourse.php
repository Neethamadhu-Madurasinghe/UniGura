<?php

class TutorCreateCourse extends Controller{
    private ModelTutorCreateCourse $createCourse;
    
    public function __construct(){
        $this->createCourse = $this->model('ModelTutorCreateCourse');

    }


    public function tutorcreatecourse(Request $request){


        $allSubject = $this->createCourse->getAllSubject();

        // echo '<pre>';
        // print_r($allSubject);
        // echo '</pre>';

        $data = [];

        foreach($allSubject as $aSubject){
            $allmodules = $this->createCourse->getModules($aSubject->id);
            foreach($allmodules as $aModule){
                $aSubject->module = $aModule;
                // echo '<pre>';
                // print_r($aModule);
                // echo '</pre>';
            }
        }

        $data = $allSubject;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('tutor/createCourse', $request,$data);

    }

    public function storeData(Request $request){
        if($request->isPost()){

            $bodyData = $request->getBody();

            $subject = $bodyData['subject'];
            $lesson = $bodyData['lesson'];
            $sessionfee = $bodyData['sessionfee'];
            $mode = $bodyData['mode'];
            $type = $bodyData['type'];
            $medium = $bodyData['medium'];
            $duration = $bodyData['duration'];

            echo '<pre>';
            print_r($bodyData);
            echo '</pre>';
        }


    }



    




}
