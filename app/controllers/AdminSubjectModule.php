<?php

class AdminSubjectModule extends Controller
{
    private mixed $subjectModel;

    public function __construct(){
        $this->subjectModel = $this->model('ModelSubject');
    }


    public function subjectsAndModules(Request $request){
        $allSubjects = $this->subjectModel->getSubjects();
        $moduleSubject = array();
        foreach ($allSubjects as $x) {
            $subjectID = $x->id;
            $allModules = $this->subjectModel->getModule($subjectID);
            $moduleSubject[$subjectID] = $allModules;
        }

        $data = array($allSubjects, $moduleSubject);

        // echo '<pre>';
        // print_r($data[0]);
        // echo '</pre>';

        $this->view('admin/newSubject', $request, $data);
    }


    public function addSubject(Request $request){

        if ($request->isGet()) {
            $subjectName = $request->getBody('subjectName')['subjectName'];

            $this->subjectModel->addSubject($subjectName);
            $this->subjectsAndModules($request);

            // $this->view('admin/newSubject', $request);
        }
    }

    public function addModule(Request $request){
        if ($request->isGet()) {
            $moduleName = $request->getBody('moduleName')['moduleName'];
            $subjectId = $request->getBody('subjectId')['subjectId'];

            $this->subjectModel->addModule($moduleName, $subjectId);
            $this->subjectsAndModules($request);
        }
    }

    public function updateModule(Request $request){
        if ($request->isGet()) {
            $moduleName = $request->getBody('moduleName')['moduleName'];
            $moduleId = $request->getBody('moduleId')['moduleId'];

            $this->subjectModel->updateModule($moduleName, $moduleId);
            $this->subjectsAndModules($request);
        }
    }

    public function updateModuleHideShow(Request $request){
        if ($request->isGet()) {
            $moduleId = $request->getBody('moduleId')['moduleId'];
            $isHidden = $request->getBody('is_hidden')['is_hidden'];

            $this->subjectModel->updateModuleHideShow($moduleId, $isHidden);
            $this->subjectsAndModules($request);
        }
    }
}