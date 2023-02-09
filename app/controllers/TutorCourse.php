<?php
class TutorCourse extends Controller
{

    private ModelTutorCourse $courseModel;


    public function __construct()
    {
        $this->courseModel = $this->model('ModelTutorCourse');
    }



    public function viewcourse(Request $request)
    {

        $body = $request->getBody();
        $data = [];

        $body = $request->getBody();
        $days = json_encode($this->courseModel->getTutoringClassTemplateDays($body['id']));
        $details = $this->courseModel->getTutoringClassTemplateDetails($body['id']);
        $subject = $this->courseModel->getSubjectName($details[0]['subject_id']);
        $module = $this->courseModel->getModuleName($details[0]['module_id']);




        if ($request->isGet()) {
            $data = [
                'id' => $body['id'],
                'subject' => $subject[0]['subject'],
                'module' =>  $module[0]['module'],
                'days' => $days
            ];
        };


        $days = json_encode($this->courseModel->getTutoringClassTemplateDays($data['id']));

        $data['days'] = $days;


        $this->view('tutor/course', $request, $data);
    }

    public function createDay(Request $request)
    {

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

        //Fetch all the visible subjects, modules and maximum class price

        if ($request->isGet()) {
            $body = $request->getBody();
            $data = [
                'id' => $body['class_template_id'],
                'title' => "",
                'meeting_link' => "",
                'position' => "",
                'errors' => [
                    'title_error'=>"",
                    "position_error"=>""
                ]
            ];
        };


        if ($request->isPost()) {
            $body = $request->getBody();
            $data = [];

            $data = [
                'id' => $body['id'],
                'title' => $body['title'],
                'meeting_link' => $body['meeting_link'],
                'position' => $body['position'],
                'errors'=>[
                    'title_error'=>"",
                    'position_error'=>""
                ]
            ];

            $data['errors']['title_error'] = $this->validateTitle($body['title']);
            $data['errors']['position_error'] = $this->validatePosition($body['position'],$body['id']);

            echo $body['position'];


           $hasErrors = FALSE;

           foreach ($data['errors'] as $errorString) {
               if ($errorString !== '') {
                   $hasErrors = TRUE;
               }
           }

            if(!$hasErrors){
            
                if ($this->courseModel->setClassTemplateDay($data)) {
                      redirect('tutor/viewcourse?id='. $data['id']);
                 } else {
                        header("HTTP/1.0 500 Internal Server Error");
                        die('Something went wrong');
                    }
                
                $this->view('tutor/createday', $request, $data);
    
                //If the request is a GET request, then serve the page

            }
            else{
                $this->view('tutor/createday', $request, $data);
            } 
        } 

        $this->view('tutor/createday', $request, $data);
    }


    public function validateTitle(string $name): String {
        if (empty($name) ) {
            return 'Please enter a valid name';
    
        }elseif ($this->courseModel->findDayByName($name)) {
            return 'Title Already Exist';
        }else {
            return '';
        }
    }

    public function validatePosition(string $name,string $id): String {
        if (empty($name) || !preg_match("/^[0-9]*$/", $name)) {
            return 'Position must be a valid numeber';
    
        }elseif ($this->courseModel->findDayPosition($name,$id)) {
            return 'Position Already Exist' ;
    
        }else {
            return '';
        }
    }

   
}
