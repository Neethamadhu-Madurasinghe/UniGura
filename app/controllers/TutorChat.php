<?php

class TutorChat extends Controller
{
    private ModelTutorChat $chat;

    public function mainpage(Request $request)
    {

       $data = [];


        $this->view('tutor/chat', $request, $data);
    }
   
}
