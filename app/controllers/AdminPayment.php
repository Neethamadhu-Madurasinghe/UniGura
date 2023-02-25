<?php

class AdminPayment extends Controller
{
    private mixed $paymentModel;

    public function __construct()
    {
        $this->paymentModel = $this->model('ModelAdminPayment');
    }

    public function payment(Request $request){

        $allPayment = $this->paymentModel->allPaymentDetails();

        foreach ($allPayment as $tutor){
            $tutor->tutor = $this->paymentModel->getTutorById($tutor->tutor_id);
        }

        $data = $allPayment;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        
        $this->view('admin/payment', $request, $data);
    }


    public function selectedTutorDetails(Request $request){
        
        if ($request->isGet()){
            $bodyData = $request->getBody();
            $tutorId = $bodyData['selectedTutorId'];

            $tutorBankDetails = $this->paymentModel->selectedTutorBankDetails($tutorId);
            $tutorPaymentDetails = $this->paymentModel->paymentDetailsByTutorId($tutorId);

            foreach ($tutorPaymentDetails as $aTutorPaymentDetails){
                $aTutorPaymentDetails->classDay = $this->paymentModel->classDayByDayId($aTutorPaymentDetails->day_id);
                $aTutorPaymentDetails->tutorialClass = $this->paymentModel->getTutorialClassByClassId($aTutorPaymentDetails->classDay->class_id);
                $aTutorPaymentDetails->classTemplate = $this->paymentModel->getClassTemplateByClassTemplateId($aTutorPaymentDetails->tutorialClass->class_template_id);
                $aTutorPaymentDetails->subject = $this->paymentModel->getSubjectBySubjectId($aTutorPaymentDetails->classTemplate->subject_id);
                $aTutorPaymentDetails->module = $this->paymentModel->getModuleByModuleId($aTutorPaymentDetails->classTemplate->module_id);
                $aTutorPaymentDetails->student = $this->paymentModel->getStudentById($aTutorPaymentDetails->tutorialClass->student_id);
            }



            $data = [
                'tutorBankDetails' => $tutorBankDetails,
                'tutorPaymentDetails' => $tutorPaymentDetails
            ];

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';

            $this->view('admin/selectedTutorPaymentView', $request, $data);
        }
    }
}