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

        $allSubjects = $this->subjectModel->getSubjects();
        $moduleSubject = array();
        foreach ($allSubjects as $x) {
            $subjectID = $x->id;
            $allModules = $this->subjectModel->getModule($subjectID);
            $moduleSubject[$subjectID] = $allModules;
        }

        $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule);

        // echo '<pre>';
        // print_r($data[0]);
        // echo '</pre>';

        $this->view('admin/newSubject', $request, $data);
    }


    public function addSubject(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isPost()) {
            $subjectName = $request->getBody('subjectName')['subjectName'];

            $duplicateSubject = [];
            $duplicateModule = [];


            $subjectName =  $this->subjectModel->addSubject($subjectName);
            if ($subjectName == 'Duplicate entry') {
                $duplicateSubject = 'Duplicate entry';
            }

            $allSubjects = $this->subjectModel->getSubjects();
            $moduleSubject = array();
            foreach ($allSubjects as $x) {
                $subjectID = $x->id;
                $allModules = $this->subjectModel->getModule($subjectID);
                $moduleSubject[$subjectID] = $allModules;
            }

            $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule);

            // echo '<pre>';
            // print_r($data[0]);
            // echo '</pre>';

            $this->view('admin/newSubject', $request, $data);
        }
    }


    public function updateSubject(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isPost()){
            $bodyData = $request->getBody();

            $subjectId = $bodyData['subject_id'];
            $subjectName = $bodyData['subject_name'];

            $this->subjectModel->updateSubject($subjectId,$subjectName);

            $this->subjectsAndModules($request);
        }
    }


    public function updateSubjectHideShow(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if($request->isGET()){
            $bodyData = $request->getBody();

            $subjectId = $bodyData['subject_id'];
            $subjectIsHidden = $bodyData['is_hidden'];

            $this->subjectModel->updateSubjectHideShow($subjectId,$subjectIsHidden);

            $this->subjectsAndModules($request);
        }
    }



    public function addModule(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $moduleName = $request->getBody('moduleName')['moduleName'];
            $subjectId = $request->getBody('subjectId')['subjectId'];

            $duplicateSubject = [];
            $duplicateModule = [];

            $moduleName = $this->subjectModel->addModule($moduleName, $subjectId);
            if ($moduleName == 'Duplicate entry') {
                $duplicateModule = 'Duplicate entry';
            }

            $allSubjects = $this->subjectModel->getSubjects();
            $moduleSubject = array();
            foreach ($allSubjects as $x) {
                $subjectID = $x->id;
                $allModules = $this->subjectModel->getModule($subjectID);
                $moduleSubject[$subjectID] = $allModules;
            }

            $data = array($allSubjects, $moduleSubject, $duplicateSubject, $duplicateModule);

            // echo '<pre>';
            // print_r($data[0]);
            // echo '</pre>';

            $this->view('admin/newSubject', $request, $data);
        }
    }

    public function updateModule(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isGet()) {
            $moduleName = $request->getBody('moduleName')['moduleName'];
            $moduleId = $request->getBody('moduleId')['moduleId'];

            $this->subjectModel->updateModule($moduleName, $moduleId);
            $this->subjectsAndModules($request);
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
