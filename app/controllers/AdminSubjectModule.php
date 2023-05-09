<?php

class AdminSubjectModule extends Controller
{
    private mixed $subjectModel;

    public function __construct()
    {
        $this->subjectModel = $this->model('ModelAdminSubject');
    }


    public function subjectsAndModules(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $duplicateSubject = [];
        $duplicateModule = [];

        $invalidSubjectName = [];
        $invalidModuleName = [];

        $allSubjects = $this->subjectModel->getSubjects();
        $moduleSubject = array();
        foreach ($allSubjects as $x) {
            $subjectID = $x->id;
            $allModules = $this->subjectModel->getModule($subjectID);
            $moduleSubject[$subjectID] = $allModules;
        }

        $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);

        // echo '<pre>';
        // print_r($data[0]);
        // echo '</pre>';

        $this->view('admin/subjectModule', $request, $data);
    }


    public function addSubject(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $subjectName = $request->getBody()['subjectName'];

            $duplicateSubject = [];
            $duplicateModule = [];

            $invalidSubjectName = [];
            $invalidModuleName = [];

            if (strlen($subjectName) < 3) {
                $invalidSubjectName = 'minimum3Character';

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            } else {
                $subjectName =  $this->subjectModel->addSubject($subjectName);

                if ($subjectName == 'Duplicate entry') {
                    $duplicateSubject = 'Duplicate entry';
                }

                if (strlen($subjectName) >= 3 && $subjectName != 'Duplicate entry') {
                    $subjectName =  $this->subjectModel->addSubject($subjectName);
                }

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            }
        }
    }



    public function updateSubject(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $bodyData = $request->getBody();

            $subjectId = $bodyData['subject_id'];
            $subjectName = $bodyData['subject_name'];

            $duplicateSubject = [];
            $duplicateModule = [];

            $invalidSubjectName = [];
            $invalidModuleName = [];


            if (strlen($subjectName) < 3) {
                $invalidSubjectName = 'minimum3Character';

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            } else {
                $subjectName = $this->subjectModel->updateSubject($subjectId, $subjectName);


                if ($subjectName === 'Duplicate entry') {
                    $duplicateSubject = 'Duplicate entry';
                }

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            }
        }
    }


    public function updateSubjectHideShow(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGET()) {
            $bodyData = $request->getBody();

            $subjectId = $bodyData['subject_id'];
            $subjectIsHidden = $bodyData['is_hidden'];

            $this->subjectModel->updateSubjectHideShow($subjectId, $subjectIsHidden);

            $this->subjectsAndModules($request);
        }
    }



    public function addModule(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $moduleName = $request->getBody()['moduleName'];
            $subjectId = $request->getBody()['subject_id'];

            $duplicateSubject = [];
            $duplicateModule = [];

            $invalidSubjectName = [];
            $invalidModuleName = [];


            if (strlen($moduleName) < 3) {
                $invalidModuleName = 'minimum3Character';

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            } else {
                $moduleName = $this->subjectModel->addModule($moduleName, $subjectId);

                if ($moduleName === 'Duplicate entry') {
                    $duplicateModule = 'Duplicate entry';
                }

                if (strlen($moduleName) >= 3 && $moduleName != 'Duplicate entry') {
                    $moduleName =  $this->subjectModel->addModule($moduleName, $subjectId);
                }

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            }
        }
    }


    public function updateModule(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $moduleName = $request->getBody()['module_name'];
            $moduleId = $request->getBody()['module_id'];

            $duplicateSubject = [];
            $duplicateModule = [];

            $invalidSubjectName = [];
            $invalidModuleName = [];


            if (strlen($moduleName) < 3) {
                $invalidModuleName = 'minimum3Character';

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            } else {
                $moduleName = $this->subjectModel->updateModule($moduleName, $moduleId);

                if ($moduleName === 'Duplicate entry') {
                    $duplicateModule = 'Duplicate entry';
                }

                $allSubjects = $this->subjectModel->getSubjects();
                $moduleSubject = array();
                foreach ($allSubjects as $x) {
                    $subjectID = $x->id;
                    $allModules = $this->subjectModel->getModule($subjectID);
                    $moduleSubject[$subjectID] = $allModules;
                }

                $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule, $invalidSubjectName, $invalidModuleName);
                $this->view('admin/subjectModule', $request, $data);
            }
        }
    }


    public function updateModuleHideShow(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $moduleId = $request->getBody()['module_id'];
            $isHidden = $request->getBody()['is_hidden'];

            $this->subjectModel->updateModuleHideShow($moduleId, $isHidden);
            $this->subjectsAndModules($request);
        }
    }
}
