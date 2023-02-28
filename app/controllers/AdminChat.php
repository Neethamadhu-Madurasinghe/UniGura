<?php

class AdminChat extends Controller{
    private mixed $chatModel;

    public function __construct(){
        $this->chatModel = $this->model('ModelChat');
    }

    public function chat(Request $request){
        $this->view('admin/chat',$request);
    }
}

