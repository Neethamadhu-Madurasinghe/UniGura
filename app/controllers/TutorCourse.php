<?php
class TutorCourse extends Controller
{


    public function viewcourse(Request $request)
    {

        $body = $request->getBody();
        $data = [];

        $data = [
            'id' => $request->getUserId(),
            'subject' => $body['subject'],
            'module' => $body['module']
        ];


        $this->view('tutor/course', $request, $data);
    }

    

    }
        
