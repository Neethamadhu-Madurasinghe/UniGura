<?php
class TutorNotification extends Controller
{

    public function notification(Request $request)
    {
        $data = [];
        $this->view('tutor/notifications', $request, $data);
    }

   
}
