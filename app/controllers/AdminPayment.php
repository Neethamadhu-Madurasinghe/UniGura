<?php 

class AdminPayment extends Controller
{
    private mixed $paymentModel;

    public function __construct()
    {
        $this->paymentModel = $this->model('ModelPayment');
    }

    public function payment(Request $request){

        $allPayoffTutor = $this->paymentModel->allPayoffTutor();

        foreach($allPayoffTutor as $tutor){
            $tutor->tutor = $this->paymentModel->getTutorById($tutor->tutor_id);
        }

        $data = $allPayoffTutor;

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        
        $this->view('admin/payment', $request, $data);
    }


    public function selectedTutorDetails(Request $request){

        if($request->isGet()){
            $tutorId = $request->getBody()['selectedTutorId'];
            $tutorDetails = $this->paymentModel->selectedTutorDetails($tutorId);

            $allTutorClasses = $this->paymentModel->getAllClassesByTutorId($tutorId);

            print_r($allTutorClasses[0]->class_template_id);

            $classTemplateDetails = $this->paymentModel->getClassTemplateDetailsByClassTemplateId($allTutorClasses[0]->class_template_id);


            $data = $tutorDetails;

            // echo json_encode($data);

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';
        }
    }

}