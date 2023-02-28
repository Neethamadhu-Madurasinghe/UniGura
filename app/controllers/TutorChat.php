<?php
class TutorChat extends Controller
{

    public function mainpage(Request $request)
    {

       $data = [];


        $this->view('tutor/chat', $request, $data);
    }
   
}
