<?php

class StudentNotification extends Controller {
    private ModelStudent $studentModel;

    public function __construct() {
        $this->studentModel = $this->model('ModelStudent');
    }

    public function getNotification(Request $request) {
        cors();

        $data = [];

        if (!$request->isLoggedIn() || !$request->isStudent()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }


        try {
            $data['notifications'] = $this->studentModel->getAllNotificationsByUserId($request->getUserId());
            header("HTTP/1.0 200 Success");
            header('Content-type: application/json');
            echo json_encode($data);

        } catch (Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
        }
}
}
