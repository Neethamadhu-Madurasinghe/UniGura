<?php
class TutorPayments extends Controller
{

    public function mainpage(Request $request)
    {

       $data = [];


        $this->view('tutor/payments', $request, $data);
    }
   
}
