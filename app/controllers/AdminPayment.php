<?php

class AdminPayment extends Controller
{
    private mixed $paymentModel;

    public function __construct()
    {
        $this->paymentModel = $this->model('ModelAdminPayment');
    }

    public function payment(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $allUniquePayoffTutors = $this->paymentModel->allUniquePayoffTutors();
        $allPaymentDetails = $this->paymentModel->allPaymentDetails();


        foreach ($allUniquePayoffTutors as $tutor) {
            $tutor->tutor = $this->paymentModel->getTutorById($tutor->tutor_id);
        }

        foreach ($allPaymentDetails as $tutor) {
            $tutor->tutor = $this->paymentModel->getTutorById($tutor->tutor_id);
        }

        $data = [
            'allUniquePayoffTutors' => $allUniquePayoffTutors,
            'allPaymentDetails' => $allPaymentDetails,
            'paymentBankSlip' => ''
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        $this->view('admin/payment', $request, $data);
    }


    public function selectedTutorDetails(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $tutorId = $bodyData['selectedTutorId'];

            $tutorBankDetails = $this->paymentModel->selectedTutorBankDetails($tutorId);
            $tutorPaymentDetails = $this->paymentModel->getAllClassDaysByTutorId($tutorId);

            foreach ($tutorPaymentDetails as $aTutorPaymentDetails) {
                $aTutorPaymentDetails->subject = $this->paymentModel->getSubjectBySubjectId($aTutorPaymentDetails->subject_id);
                $aTutorPaymentDetails->module = $this->paymentModel->getModuleByModuleId($aTutorPaymentDetails->module_id);
                $aTutorPaymentDetails->student = $this->paymentModel->getStudentById($aTutorPaymentDetails->student_id);
            }



            $data = [
                'tutorBankDetails' => $tutorBankDetails,
                'tutorPaymentDetails' => $tutorPaymentDetails,
            ];

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            $this->view('admin/selectedTutorPaymentView', $request, $data);
        }
    }


    public function uploadBankSlip(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $filePath = handleUpload(array('.pdf', '.png', '.jpeg', '.jpg', '.JPG'), '\\withdrawal_slips\\', 'paymentBankSlip');
            $this->paymentModel->insertTutorWithdrawalDetails($filePath);
            $withdrawalSlipID = $this->paymentModel->getTutorWithdrawalDetailID($filePath);
            $this->paymentModel->updateTutorWithdrawalDetails($_GET['tutorID'], $withdrawalSlipID->id);
        }

        redirect('/admin/payment');
    }
}
