<?php

class AdminDashboard extends Controller{
    private mixed $dashboardModel;

    public function __construct(){
        $this->dashboardModel = $this->model('ModelDashboard');
    }

    public function dashboard(Request $request){


        $this->view('admin/admin_dashboard', $request);

    }
}