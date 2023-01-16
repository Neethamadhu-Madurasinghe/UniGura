<?php

class AdminNotification extends Controller{
    private mixed $classModel;

    public function __construct(){
        $this->classModel = $this->model('ModelClass');
    }

    public function notification(Request $request){
        $this->view('admin/notification', $request);

    }
    
}