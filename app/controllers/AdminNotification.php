<?php

class AdminNotification extends Controller
{
    private mixed $classModel;

    public function __construct()
    {
        $this->classModel = $this->model('ModelAdminNotification');
    }

    public function notification(Request $request)
    {

        $allUnseenNotifications = $this->classModel->getAllUnseenNotifications();

        foreach ($allUnseenNotifications as $notification) {
            $user = $this->classModel->getUserById($notification->user_id);
            $notification->user = $user;
        }

        $data = $allUnseenNotifications;

        $this->view('admin/notification', $request, $data);
    }


    public function clearNotification(Request $request)
    {

        if ($request->isGet()) {

            $bodyData = $request->getBody();

            $notificationID = $bodyData['notificationID'];

            $result = $this->classModel->clearNotification($notificationID);
        }

        $this->notification($request);
    }
}
