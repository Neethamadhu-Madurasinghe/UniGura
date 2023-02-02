<?php
class TutorNotification extends Controller
{

    public function notification(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isProfileNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isNotApprovedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if($request->isBankDetialsNotCompletedTutor()){
            redirectBasedOnUserRole($request);
        }

        $data = [];
        echo 'hellllll';
        $this->view('tutor/notifications', $request, $data);
    }

   
}
