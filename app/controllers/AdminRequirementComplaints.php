<?php

class AdminRequirementComplaints extends Controller
{

    private mixed $requirementComplaintsModel;
    private ModelTutorStudentCompleteProfile $tutorStudentModel;

    public function __construct()
    {
        $this->requirementComplaintsModel = $this->model('ModelAdminRequirementComplaints');
        $this->tutorStudentModel = $this->model('ModelTutorStudentCompleteProfile');
    }



    public function addStudentComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            $data = [
                'student_reason' => $body['inputStudentReason'],
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason,

                'errors' => [
                    'student_reason' => validateStudentReportReason($body['inputStudentReason'], $this->tutorStudentModel),
                    'tutor_reason' => '',
                ]
            ];

            $hasErrors = FALSE; // has not errors 

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if ($hasErrors) {
                $this->view('admin/complaintSettings', $request, $data);
            }


            if (!$hasErrors) {
                $this->requirementComplaintsModel->addStudentComplainReason($data['student_reason']);
                redirect('admin/complaintSetting');
            }
        }
    }



    public function updateStudentComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            $data = [
                'student_reason' => $body['inputStudentReason'],
                'student_reason_id' => $body['studentReasonId'],
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason,

                'errors' => [
                    'student_reason' => validateStudentReportReason($body['inputStudentReason'], $this->tutorStudentModel, false),
                    'tutor_reason' => '',

                ]
            ];


            $hasErrors = FALSE; // has not errors 

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if ($hasErrors) {
                $this->view('admin/complaintSettings', $request, $data);
            }


            if (($this->requirementComplaintsModel->updateStudentComplainReason($data['student_reason_id'], $data['student_reason'])) === "false") {
                $data['errors']['student_reason'] = 'Reason is already in use';
                $this->view('admin/complaintSettings', $request, $data);
            } else {
                redirect('admin/complaintSetting');
            }
        }
    }



    public function deleteStudentComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isGet()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            if ($this->requirementComplaintsModel->deleteComplaint($body['complaintID']) === '') {
                $this->requirementComplaintsModel->deleteComplaint($body['complaintID']);
                redirect('admin/complaintSetting');
            } else {

                $data = [
                    'student_reason_id' => $body['complaintID'],
                    'studentComplaintReason' => $studentComplaintReason,
                    'tutorComplaintReason' => $tutorComplaintReason,

                    'errors' => [
                        'student_reason' => $this->requirementComplaintsModel->deleteComplaint($body['complaintID']),
                        'tutor_reason' => '',

                    ]
                ];

                $this->view('admin/complaintSettings', $request, $data);
            }
        }
    }




    public function addTutorComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            $data = [
                'tutor_reason' => $body['inputTutorReason'],
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason,

                'errors' => [
                    'student_reason' => '',
                    'tutor_reason' => validateTutorReportReason($body['inputTutorReason'], $this->tutorStudentModel),
                ]
            ];

            $hasErrors = FALSE; // has not errors 

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if ($hasErrors) {
                $this->view('admin/complaintSettings', $request, $data);
            }


            if (!$hasErrors) {
                $this->requirementComplaintsModel->addTutorComplainReason($data['tutor_reason']);
                redirect('admin/complaintSetting');
            }
        }
    }



    public function updateTutorComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isPost()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            $data = [
                'tutor_reason' => $body['inputTutorReason'],
                'tutor_reason_id' => $body['tutorReasonId'],
                'studentComplaintReason' => $studentComplaintReason,
                'tutorComplaintReason' => $tutorComplaintReason,

                'errors' => [
                    'student_reason' => '',
                    'tutor_reason' => validateTutorReportReason($body['inputTutorReason'], $this->tutorStudentModel,false),

                ]
            ];

            $hasErrors = FALSE; // has not errors 

            foreach ($data['errors'] as $errorString) {
                if ($errorString !== '') {
                    $hasErrors = TRUE;
                }
            }

            if ($hasErrors) {
                $this->view('admin/complaintSettings', $request, $data);
            }

            if (($this->requirementComplaintsModel->updateTutorComplainReason($data['tutor_reason_id'], $data['tutor_reason'])) === "false") {
                $data['errors']['tutor_reason'] = 'Reason is already in use';
                $this->view('admin/complaintSettings', $request, $data);
            } else {
                redirect('admin/complaintSetting');
            }

        }
    }




    public function deleteTutorComplainReason(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        if ($request->isGet()) {
            $body = $request->getBody();

            $studentComplaintReason = $this->requirementComplaintsModel->getStudentComplaintReason();
            $tutorComplaintReason = $this->requirementComplaintsModel->getTutorComplaintReason();


            if ($this->requirementComplaintsModel->deleteComplaint($body['complaintID']) === '') {
                $this->requirementComplaintsModel->deleteComplaint($body['complaintID']);
                redirect('admin/complaintSetting');
            } else {

                $data = [
                    'tutor_reason_id' => $body['complaintID'],
                    'studentComplaintReason' => $studentComplaintReason,
                    'tutorComplaintReason' => $tutorComplaintReason,

                    'errors' => [
                        'student_reason' => '',
                        'tutor_reason' => $this->requirementComplaintsModel->deleteComplaint($body['complaintID']),

                    ]
                ];

                $this->view('admin/complaintSettings', $request, $data);
            }
        }
    }




    public function acceptTutorRequest(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $data = $request->getBody();

            $tutorID = $data['tutorID'];

            $this->requirementComplaintsModel->acceptTutorRequest($tutorID);

            $this->requirementComplaintsModel->addNotification($tutorID, 'Your tutor request has been accepted.', 'Now you can login to your account and start tutoring.');

            redirect('admin/tutorRequest');
        }
    }



    public function rejectTutorRequest(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $data = $request->getBody();

            $tutorID = $data['tutorID'];

            $this->requirementComplaintsModel->rejectTutorRequest($tutorID);

            $this->requirementComplaintsModel->addNotification($tutorID, 'Your tutor request has been rejected.', 'Please contact us for more information.');

            redirect('admin/tutorRequest');
        }
    }
}
