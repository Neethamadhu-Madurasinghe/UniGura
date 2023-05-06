<?php

class AdminNotification extends Controller
{
    private mixed $notificationModel;

    public function __construct()
    {
        $this->notificationModel = $this->model('ModelAdminNotification');
    }

    public function notification(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $allUnseenNotifications = $this->notificationModel->getAllUnseenNotifications();

        foreach ($allUnseenNotifications as $notification) {
            $user = $this->notificationModel->getUserById($notification->user_id);
            $notification->user = $user;
        }

        $data = $allUnseenNotifications;

        $this->view('admin/notification', $request, $data);
    }



    public function notificationCount(Request $request)
    {
        $notificationCount = $this->notificationModel->getNotificationCount();

        $data = $notificationCount;
        // $this->view('admin/class', $request, $data);

        echo json_encode([
            "notificationCount" => $data
        ]);
    }



    public function clearNotification(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {

            $bodyData = $request->getBody();

            $notificationID = $bodyData['notificationID'];

            $result = $this->notificationModel->clearNotification($notificationID);
        }

        $this->notification($request);
    }
}
