<?php

class AdminStatistics extends Controller
{
    private mixed $statisticsModel;

    public function __construct()
    {
        $this->statisticsModel = $this->model('ModelAdminStatistics');
    }

    public function statistics(Request $request)
    {

        $this->view('admin/statistics', $request);
    }
}
