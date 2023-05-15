<?php
class TutorNotification extends Controller
{

    private ModelTutorNotification $notificationModel;

    public function __construct()
    {
        $this->notificationModel = $this->model('ModelTutorNotification');
    }


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

        if ($request->isBankDetialsNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isTimeSlotNotCompletedTutor()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isAdmin()) {
            redirectBasedOnUserRole($request);
        }

        if ($request->isStudent()) {
            redirectBasedOnUserRole($request);
        }


        $data = [];

        //Fetch all the classes of this student
        $data['notifications'] = json_encode($this->notificationModel->getNotifications($request->getUserId()));

        $this->view('tutor/notifications', $request, $data);
    }

    
    public function mark_as_seen(Request $request)
    {
        $data['message'] = $this->notificationModel->mark_as_seen($request->getUserId());
    }


    public function mark_as_delete(Request $request)
    {

        $id = $_POST['id'];
        $data['message'] = $this->notificationModel->mark_as_delete($id);
        header('Content-type: application/json');
        echo json_encode($data['message']);

    }


    public function get_count(Request $request)
    {
        $data = $this->notificationModel->get_count($request->getUserId());
        header('Content-type: application/json');
        echo json_encode($data);
    }
}
