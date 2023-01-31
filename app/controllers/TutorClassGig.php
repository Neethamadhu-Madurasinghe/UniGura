<?php

class TutorClassGig extends Controller {
    private ModelStudentReport $reportModel;

    public function __construct() {
        $this->reportModel = $this->model('ModelStudentReport');
    }

    public function reportTutor(Request $request) {
//      Cors support
        cors();

//      Making a report is a POST
        if ($request->isPost()) {
//          Unauthorized error code
            if (!$request->isLoggedIn() || !$request->isStudent()) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

            $body = json_decode(file_get_contents('php://input'), true);
            $body['student_id'] = $request->getUserId();

//          Validate incoming payload
            $isError = false;

            if (
                !(isset($body['description']) &&
                    isset($body['tutor_id']) &&
                    isset($body['reason_id']))
            ) {
                $isError = true;
            }

            if ($isError) {
                header("HTTP/1.0 400 Bad Request");
                return;
            }

//          Check if the same student has submitted a report for same tutor that is not inquired
            if ($this->reportModel->doesReportExist($body)) {
                header("HTTP/1.0 403 Forbidden");
                return;
            }

//          If all the checks are passed, then make the report
            if ($this->reportModel->saveStudnetReport($body)) {
                header("HTTP/1.0 200 Success");
                return;
            }

            header("HTTP/1.0 500 Internal Server Error");

        }else {
//          This route has no get requests
            header("HTTP/1.0 404 Not found");
        }

    }
}