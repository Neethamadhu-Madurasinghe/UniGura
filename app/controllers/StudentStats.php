<?php

class StudentStats extends Controller {
    private ModelStudentRequest $requestModel;
    private ModelStudentPayment $paymentModel;
    private ModelStudentClass $classModel;


    public function __construct() {
        $this->requestModel = $this->model('ModelStudentRequest');
        $this->paymentModel = $this->model('ModelStudentPayment');
        $this->classModel = $this->model('ModelStudentClass');
    }

    public function studentStats(Request $request) {
//      Student should be logged in
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if (!$request->isStudent()) {
            redirectBasedOnUserRole($request);
        }

//        Fetch class details
        $classes = $this->classModel->getAllClassDetailsByStudentId($request->getUserId());
        $data['class_status'] = [
            'completed' => 0,
            'total' => 0,
            'active' => 0
        ];

        foreach ($classes as $class) {
            if ($class['completion_status'] == 1) {
                $data['class_status']['completed'] += 1;
            }else {
                $data['class_status']['active'] += 1;
            }
            $data['class_status']['total'] += 1;
        }


//        Fetch payment history
        $data['payments'] = $this->paymentModel->getAllPaymentsByStudentId($request->getUserId());

//          Fetch tutor request data
        $data['requests'] = $this->requestModel->getRequestsByStudentId($request->getUserId());
//        Load the view for both post and get requests
        $this->view('/student/stats', $request, $data);
    }
}