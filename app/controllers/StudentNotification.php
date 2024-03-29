<?php

class StudentNotification extends Controller {
    private ModelStudentNotification $notificationModel;

    public function __construct() {
        $this->notificationModel = $this->model('ModelStudentNotification');
    }

    public function getNotification(Request $request) {
        cors();

        $data = [];

        if (!$request->isLoggedIn()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }


        try {
            $data['notifications'] = $this->notificationModel->getAllNotificationsByUserId($request->getUserId());
            header("HTTP/1.0 200 Success");
            header('Content-type: application/json');
            echo json_encode($data);

        } catch (Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    public function markNotificationAsSeen(Request $request) {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);

        if (!$request->isLoggedIn() || !$request->isStudent()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        $result = true;
        foreach ($body['notification_ids'] as $id) {
            if (!($result && $this->notificationModel->markNotificationAsSeen($id))) $result = false;
        }

        print_r($body['notification_ids']);
        if ($result) {
            header("HTTP/1.0 200 Success");
        }else {
            header("HTTP/1.0 500 Internal Server Error");
        }
    }

    public function deleteNotification(Request $request) {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);

        if (!$request->isLoggedIn() || !$request->isStudent()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
            $isValid = true;

            if (!isset($body['id'])) {
                $isValid = false;
            }

            if ($isValid) {
                if ($this->notificationModel->deleteNotification($body['id'])) {
                    header("HTTP/1.0 200 Success");
                }else {
                    header("HTTP/1.0 500 Internal Server Error");
                }
            }else {
                header("HTTP/1.0 400 Bad Request");
            }
        }else {
            header("HTTP/1.0 404 Not Found");
        }



    }
}
