<?php


class AdminHideShowBlockUnblock extends Controller
{
    private mixed $hideShowBlockUnblockModel;

    public function __construct()
    {
        $this->hideShowBlockUnblockModel = $this->model('ModelAdminHideShowBlockUnblock');
    }

    public function hideTutor(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->hideTutor($tutorId);
            $this->hideShowBlockUnblockModel->addNotification($tutorId, "Your account has been hidden by Uni-ගුරා team.", "We've detected suspicious activity on your account and have temporarily hidden it as a security precaution. Please contact us for more information.");

            redirect('/admin/viewTutorProfile?tutorID=' . $tutorId);
        }
    }

    public function showTutor(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->showTutor($tutorId);
            $this->hideShowBlockUnblockModel->addNotification($tutorId, "Your account has been successfully visible for others.","We apologize for any inconvenience this may have caused.");

            redirect('/admin/viewTutorProfile?tutorID=' . $tutorId);
        }
    }

    public function blockTutor(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->blockTutor($tutorId);
            $this->hideShowBlockUnblockModel->addNotification($tutorId, "Your account has been blocked by Uni-ගුරා team.", "We've detected suspicious activity on your account and have temporarily blocked it as a security precaution. Please contact us for more information.");

            redirect('/admin/viewTutorProfile?tutorID=' . $tutorId);
        }
    }

    public function unblockTutor(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $tutorId = $bodyData['tutorID'];
            $this->hideShowBlockUnblockModel->unblockTutor($tutorId);
            $this->hideShowBlockUnblockModel->addNotification($tutorId, "Your account has been successfully unblocked.","We apologize for any inconvenience this may have caused.");

            redirect('/admin/viewTutorProfile?tutorID=' . $tutorId);
        }
    }

    public function blockStudent(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];
            $this->hideShowBlockUnblockModel->blockStudent($studentId);
            $this->hideShowBlockUnblockModel->addNotification($studentId, "Your account has been blocked by Uni-ගුරා team.", "We've detected suspicious activity on your account and have temporarily blocked it as a security precaution. Please contact us for more information.");

            redirect('/admin/viewStudentProfile?studentID=' . $studentId);
        }
    }

    public function unblockStudent(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $bodyData = $request->getBody();
            $studentId = $bodyData['studentID'];
            $this->hideShowBlockUnblockModel->unblockStudent($studentId);
            $this->hideShowBlockUnblockModel->addNotification($studentId, "Your account has been successfully unblocked.","We apologize for any inconvenience this may have caused.");

            redirect('/admin/viewStudentProfile?studentID=' . $studentId);
        }
    }
}
