<?php
class TutorPayments extends Controller
{
    private ModelTutorPayment $paymentModel;

    public function __construct()
    {
        $this->paymentModel = $this->model('ModelTutorPayment');
    }

    public function mainpage(Request $request)
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

        $data = [];

        $body = $request->getBody();

        $data['payments'] = json_encode($this->paymentModel->getAllPaymentDetails($request->getUserId()));

    

       $this->view('tutor/payments', $request, $data);
    }
   
}
