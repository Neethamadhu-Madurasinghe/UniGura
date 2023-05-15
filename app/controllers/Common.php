<?php

class Common extends Controller
{
    private ModelFeedback $feedbackModel;

    public function __construct()
    {
        $this->feedbackModel = $this->model('ModelFeedback');
    }

    public function notFound(Request $request)
    {
        $data = [];
        header("HTTP/1.0 404 Not Found");
        $this->view('common/notFound', $request, $data);
    }

    public function saveFeedback(Request $request)
    {
        cors();

        $body = json_decode(file_get_contents('php://input'), true);

        if (!$request->isLoggedIn()) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if ($request->isPost()) {
            //        validate
            $isValid = true;
            if (
                !isset($body['rating']) ||
                !isset($body['description'])
            ) {
                $isValid = false;
            }

            if ($body['rating'] > 5) {
                $isValid = false;
            }



            if ($isValid) {
                if ($this->feedbackModel->createFeedback(
                    $request->getUserId(),
                    $body['rating'],
                    $body['description']
                )) {
                    header("HTTP/1.0 200 Success");
                } else {
                    header("HTTP/1.0 500 Internal Server Error");
                }
            } else {
                header("HTTP/1.0 400 Bad Request");
            }
        } else {
            header("HTTP/1.0 404 Not Found");
        }
    }

    //    TODO: Put landing page here

    public function landing(Request $request)
    {
        if($request->isLoggedIn()) {
            redirectBasedOnUserRole($request);
        }
        $data = [];

        $this->view('common/landingpage', $request, $data);
    }
}
