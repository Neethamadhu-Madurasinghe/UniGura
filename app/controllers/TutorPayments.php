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

        $data['amounts'] = json_encode($this->paymentModel->getMonthlypaymentstatus($request->getUserId()));
        $data['payments'] = json_encode($this->paymentModel->getAllPaymentDetails($request->getUserId()));
        $data['monthlyearns'] = json_encode($this->paymentModel->getPaymentsByMonth($request->getUserId()));
        
        $this->view('tutor/payments', $request, $data);
    }

    public function filter_payments_by_day(Request $request)
    {

        $dateRange = $_POST['dateRange'];
        $startDate = null;
        $endDate = null;

        // determine start and end dates based on selected date range
        switch ($dateRange) {
            case 'last-week':
                $startDate = date('Y-m-d', strtotime('-1 week'));
                $endDate = date('Y-m-d');
                break;
            case 'last-month':
                $startDate = date('Y-m-d', strtotime('-1 month'));
                $endDate = date('Y-m-d');
                break;
            case 'last-year':
                $startDate = date('Y-m-d', strtotime('-1 year'));
                $endDate = date('Y-m-d');
                break;
            default:
                // invalid date range selected
                echo 'Invalid date range selected.';
                exit;
        };

        $data['payments'] = $this->paymentModel->getFilteredPayments($request->getUserId(),$startDate,$endDate);

        header('Content-type: application/json');
        echo json_encode($data['payments']);

    }

    // public function monthly_payment_amounts(Request $request)
    // {

    //     $month = $_POST['month'];

    //     // determine start and end dates based on selected date range
        

    //     $data['amounts'] = $this->paymentModel->getMonthlypaymentstatus($request->getUserId(),$month);

    //     header('Content-type: application/json');
    //     echo json_encode($data['amounts']);

    // }
}
