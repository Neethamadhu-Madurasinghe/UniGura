<?php

class AdminFilter extends Controller
{
    private mixed $filterModel;

    public function __construct()
    {
        $this->filterModel = $this->model('AdminFilterModel');
    }


    public function filterForStudentPage(Request $request)
    {

        $allStudent = $this->filterModel->getAllStudent();

        foreach ($allStudent as $aStudent) {
            $studentID = $aStudent->user_id;
            $student = $this->filterModel->getStudentById($studentID);
            $aStudent->student = $student;
        }


        if ($request->isGet()) {
            $bodyData = $request->getBody();

            $classConductModeValue = $bodyData['classConductModeFilterValue'];
            $visibilityFilterValue = $bodyData['visibilityFilterValue'];
            $searchStudentName = $bodyData['searchStudentName'];


            $arrayModes =  explode(',', $classConductModeValue);
            $arrayVisibility =  explode(',', $visibilityFilterValue);

            $filterResult = [];
            $pageContent = [];

            $filterResult['classConductMode'] = $arrayModes;
            $filterResult['visibility'] = $arrayVisibility;

            if (empty($classConductModeValue) && empty($visibilityFilterValue)) {
                $pageContent = $allStudent;
            } elseif (empty($classConductModeValue) && !empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (in_array($aStudent->student->is_banned, $arrayVisibility)) {
                        array_push($pageContent, $aStudent);
                    }
                }
            } elseif (!empty($classConductModeValue) && empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (in_array($aStudent->student->mode, $arrayModes)) {
                        array_push($pageContent, $aStudent);
                    }
                }
            } else {
                foreach ($allStudent as $aStudent) {
                    if (in_array($aStudent->student->mode, $arrayModes) && in_array($aStudent->student->is_banned, $arrayVisibility)) {
                        array_push($pageContent, $aStudent);
                    }
                }
            }
        }

        $data = $pageContent;

        $this->view('admin/studentSearch&FilterOutput', $request, $data);
    }
}
