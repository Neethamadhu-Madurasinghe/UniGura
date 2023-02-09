<?php
class TutorClass extends Controller
{
    // public function __construct()
    // {
    //     $this->courseModel = $this->model('ModelTutorCourse');
    // }
    public function mainpage(Request $request)
    {

       $data = [];
   

        $this->view('tutor/classes', $request, $data);
    }
   
}
