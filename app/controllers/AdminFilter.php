<?php

class AdminFilter extends Controller
{
    private mixed $filterModel;

    public function __construct()
    {
        $this->filterModel = $this->model('ModelAdminFilter');
    }


    public function filterForStudentPage(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $filterResult = [];

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

            // echo $classConductModeValue; // online,physical


            $arrayModes =  explode(',', $classConductModeValue);  // convert string to array
            $arrayVisibility =  explode(',', $visibilityFilterValue);

            // print_r($arrayModes); // Array ( [0] => online [1] => physical )

            // Array ( [0] => block [1] => unblock ) 
            // Array ( [0] => 1 [1] => 0 )


            $sql = "SELECT student.*, user.* FROM student INNER JOIN user ON student.user_id = user.id WHERE 1";

            if (!empty($searchStudentName)) {
                $sql .= " AND CONCAT(user.first_name,' ',user.last_name) LIKE '%$searchStudentName%' ";
            }


            if (!empty($arrayModes[0]) && !empty($arrayModes[1]) && !empty($arrayModes[2])) {
                $sql .= " AND user.mode IN ('$arrayModes[0]','$arrayModes[1]','$arrayModes[2]')";
            } else if (!empty($arrayModes[0]) && !empty($arrayModes[1])) {
                $sql .= " AND user.mode IN ('$arrayModes[0]','$arrayModes[1]')";
            } else if (!empty($arrayModes[0])) {
                $sql .= " AND user.mode = '$arrayModes[0]'";
            }

            if (!empty($arrayVisibility[0]) && !empty($arrayVisibility[1])) {
                if ($arrayVisibility[0] == 'block') {
                    $sql .= " AND (user.is_banned = '1'";
                }

                if ($arrayVisibility[1] == 'unblock') {
                    $sql .= " OR user.is_banned = '0')";
                }

                if ($arrayVisibility[0] == 'unblock') {
                    $sql .= " (AND user.is_banned = '0'";
                }

                if ($arrayVisibility[1] == 'block') {
                    $sql .= " OR user.is_banned = '1')";
                }
            } elseif (!empty($arrayVisibility[0])) {
                if ($arrayVisibility[0] == 'block') {
                    $sql .= " AND user.is_banned = '1'";
                } else {
                    $sql .= " AND user.is_banned = '0'";
                }
            }

            $allStudent = $this->filterModel->getStudentByQuery($sql);

            $filterResult = $allStudent;
        }

        // echo $sql;

        $data = $filterResult;

        $this->view('admin/studentSearch&FilterOutput', $request, $data);
    }




    public function filterForTutorPage(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        $filterResult = [];
        $allTutors = $this->filterModel->getAllTutor();


        // echo '<pre>';
        // print_r($allTutors);
        // echo '</pre>';   


        if ($request->isGet()) {
            $bodyData = $request->getBody();

            $classConductModeValue = $bodyData['classConductModeFilterValue'] ?? [];
            $visibilityFilterValue = $bodyData['visibilityFilterValue'] ?? [];
            $permissionFilterValue = $bodyData['permissionFilterValue'] ?? [];
            $tutorDurationFilterValue = $bodyData['tutorDurationFilterValue'] ?? [];
            $searchTutorName = $bodyData['searchTutorName'] ?? '';


            $arrayModes =  explode(',', $classConductModeValue);
            $arrayVisibility =  explode(',', $visibilityFilterValue);
            $arrayPermission =  explode(',', $permissionFilterValue);
            $arrayDuration =  explode(',', $tutorDurationFilterValue);


            // print_r($arrayVisibility);

            $sql = "SELECT tutor.*, user.* FROM tutor INNER JOIN user ON tutor.user_id = user.id WHERE tutor.is_approved = 1";

            if (!empty($searchTutorName)) {
                $sql .= " AND CONCAT(user.first_name,' ',user.last_name) LIKE '%$searchTutorName%' ";
            }

            if (!empty($arrayModes[0]) && !empty($arrayModes[1]) && !empty($arrayModes[2])) {
                $sql .= " AND user.mode IN ('$arrayModes[0]','$arrayModes[1]','$arrayModes[2]')";
            } else if (!empty($arrayModes[0]) && !empty($arrayModes[1])) {
                $sql .= " AND user.mode IN ('$arrayModes[0]','$arrayModes[1]')";
            } elseif (!empty($arrayModes[0])) {
                $sql .= " AND user.mode = '$arrayModes[0]'";
            }



            if (!empty($arrayVisibility[0]) && !empty($arrayVisibility[1])) {
                if ($arrayVisibility[0] == 'hide') {
                    $sql .= ' AND (tutor.is_hidden = 1';
                }
                if ($arrayVisibility[1] == 'show') {
                    $sql .= ' OR tutor.is_hidden = 0)';
                }

                if ($arrayVisibility[0] == 'show') {
                    $sql .= ' AND (tutor.is_hidden = 0';
                }

                if ($arrayVisibility[1] == 'hide') {
                    $sql .= ' OR tutor.is_hidden = 1)';
                }
            } elseif (!empty($arrayVisibility[0])) {
                if ($arrayVisibility[0] == 'hide') {
                    $sql .= " AND tutor.is_hidden = 1";
                } else {
                    $sql .= " AND tutor.is_hidden = 0";
                }
            }


            if (!empty($arrayPermission[0]) && !empty($arrayPermission[1])) {
                if ($arrayPermission[0] == 'block') {
                    $sql .= ' AND (user.is_banned = 1';
                }
                if ($arrayPermission[1] == 'unblock') {
                    $sql .= ' OR user.is_banned = 0)';
                }

                if ($arrayPermission[0] == 'unblock') {
                    $sql .= ' AND (user.is_banned = 0';
                }

                if ($arrayPermission[1] == 'block') {
                    $sql .= ' OR user.is_banned = 1)';
                }
            } elseif (!empty($arrayPermission[0])) {

                if ($arrayPermission[0] == 'block') {
                    $sql .= " AND user.is_banned = 1";
                } else {
                    $sql .= " AND user.is_banned = 0";
                }
            }


            if (!empty($arrayDuration[0]) && !empty($arrayDuration[1]) && !empty($arrayDuration[2]) && !empty($arrayDuration[3])) {
                $current_time = date('Y');
                $year_later_0 = date('Y', strtotime("$current_time -{$arrayDuration[0]} year"));
                $year_later_1 = date('Y', strtotime("$current_time -{$arrayDuration[1]} year"));
                $year_later_2 = date('Y', strtotime("$current_time -{$arrayDuration[2]} year"));
                $year_later_3 = date('Y', strtotime("$current_time -{$arrayDuration[3]} year"));

                $sql .= " AND YEAR(user.joined_date) >= $year_later_0 AND YEAR(user.joined_date) >= $year_later_1 AND YEAR(user.joined_date) >= $year_later_2 AND YEAR(user.joined_date) >= $year_later_3";
            } else if (!empty($arrayDuration[0]) && !empty($arrayDuration[1]) && !empty($arrayDuration[2])) {
                $current_time = date('Y');
                $year_later_0 = date('Y', strtotime("$current_time -{$arrayDuration[0]} year"));
                $year_later_1 = date('Y', strtotime("$current_time -{$arrayDuration[1]} year"));
                $year_later_2 = date('Y', strtotime("$current_time -{$arrayDuration[2]} year"));


                $sql .= " AND YEAR(user.joined_date) >= $year_later_0 AND YEAR(user.joined_date) >= $year_later_1 AND YEAR(user.joined_date) >= $year_later_2";
            } else if (!empty($arrayDuration[0]) && !empty($arrayDuration[1])) {
                $current_time = date('Y');
                $year_later_0 = date('Y', strtotime("$current_time -{$arrayDuration[0]} year"));
                $year_later_1 = date('Y', strtotime("$current_time -{$arrayDuration[1]} year"));


                $sql .= " AND YEAR(user.joined_date) >= $year_later_0 AND YEAR(user.joined_date) >= $year_later_1";
            } else if (!empty($arrayDuration[0])) {
                $current_time = date('Y');
                $year_later_0 = date('Y', strtotime("$current_time -{$arrayDuration[0]} year"));


                $sql .= " AND YEAR(user.joined_date) >= $year_later_0";
            }

            // echo $sql;

            $allTutors = $this->filterModel->getTutorByQuery($sql);

            $filterResult = $allTutors;
        }

        $data = $filterResult;

        $this->view('admin/tutorSearch&FilterOutput', $request, $data);
    }





    public function filterForClassPage(Request $request)
    {

        if (!$request->isLoggedIn()) {
            redirect('/login');
        }


        $filterResult = [];

        $allClasses = $this->filterModel->getAllClasses();

        $allSubjects = $this->filterModel->getAllSubjects();

        foreach ($allClasses as $x) {
            $tutorId = $x->tutorID;

            $tutor = $this->filterModel->findTutor($tutorId);

            $x->tutor = $tutor;
        }

        $data = [
            'allClasses' => $allClasses,
            'allSubjects' => $allSubjects
        ];


        if ($request->isGet()) {
            $bodyData = $request->getBody();

            // $searchClassValue = $bodyData['searchClassValue'];
            $classFeesInputMaxValue = $bodyData['classFeesInputMaxValue'];
            $ratingFilterValue = $bodyData['ratingFilterValue'];
            $completionStatusFilterValue = $bodyData['completionStatusFilterValue'];
            $subjectFilterValue = $bodyData['subjectFilterValue'];

            $arrayRating = explode(',', $ratingFilterValue);
            $arrayStatus = explode(',', $completionStatusFilterValue);
            $arraySubjects = explode(',', $subjectFilterValue);


            // print_r($arrayStatus);
            // echo '<br>';


            if (array_key_exists("0", $arrayStatus)) {
                if ($arrayStatus[0] == 'complete') {
                    $arrayStatus[0] = 1;
                } else {
                    $arrayStatus[0] = 0;
                }
            }

            if (array_key_exists("1", $arrayStatus)) {
                if ($arrayStatus[1] == 'active') {
                    $arrayStatus[1] = 0;
                } else {
                    $arrayStatus[1] = 1;
                }
            }


            function array_contains_value_less_than_rating($arr, $starCount)
            {
                foreach ($arr as $item) {
                    if ($starCount < $item) {
                        return true;
                    }
                }
                return false;
            }


            // print_r($arrayStatus);

            if (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }

                    if ($aClass->session_rate <= $classFeesInputMaxValue && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && in_array($aClass->completion_status, $arrayStatus)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && in_array($aClass->completion_status, $arrayStatus) && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if ($aClass->session_rate <= $classFeesInputMaxValue && in_array($aClass->completion_status, $arrayStatus) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && array_contains_value_less_than_rating($arrayRating, $aClass->current_rating)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if ($aClass->session_rate <= $classFeesInputMaxValue && array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->completion_status, $arrayStatus)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->session_rate <= $classFeesInputMaxValue && array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->completion_status, $arrayStatus) && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if ($aClass->session_rate <= $classFeesInputMaxValue && array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->completion_status, $arrayStatus) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (array_contains_value_less_than_rating($arrayRating, $aClass->current_rating)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if (array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->completion_status, $arrayStatus)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->completion_status, $arrayStatus) && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if (array_contains_value_less_than_rating($arrayRating, $aClass->current_rating) && in_array($aClass->completion_status, $arrayStatus) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->completion_status, $arrayStatus)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->completion_status, $arrayStatus) && in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if (in_array($aClass->completion_status, $arrayStatus) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($completionStatusFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }

                    if (in_array($aClass->subjectName, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($completionStatusFilterValue) && empty($subjectFilterValue)) {
                $filterResult = $allClasses;
            } else {
                $filterResult = $allClasses;
            }
        }


        $uniqueFilterResult = array_unique($filterResult, SORT_REGULAR);

        $data = [
            'allClasses' => $uniqueFilterResult,
        ];

        $this->view('admin/classSearch&FilterOutput', $request, $data);
    }




    public function filterForStudentComplaint(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $filterResult = [];



        if ($request->isGet()) {
            $bodyData = $request->getBody();

            $studentComplaintSearchName = $bodyData['search_student_name_value'];
            $studentComplaintFilterName = $bodyData['student_complaint_filter_value'];
            $currentPageNum = $bodyData['currentPageNum'];

            // echo $studentComplaintSearchName;
            // echo $studentComplaintFilterName;
            // echo $currentPageNum;

            if ($currentPageNum == 'null') {
                $currentPageNum = 1;
            }


            $rowsPerPage = 5;
            $totalNumOfStudentComplaints = $this->filterModel->totalNumOfStudentComplaints();
            $lastPageNum = ceil($totalNumOfStudentComplaints / $rowsPerPage);

            $start = ($currentPageNum - 1) * $rowsPerPage;

            $allStudentComplaints = $this->filterModel->getStudentComplaints($start, $rowsPerPage);

            // next page
            if ($currentPageNum < $lastPageNum) {
                $nextPageNum = $currentPageNum + 1;
            } else {
                $nextPageNum = $lastPageNum;
            }

            // previous page
            if ($currentPageNum > 1) {
                $previousPageNum = $currentPageNum - 1;
            } else {
                $previousPageNum = 1;
            }


            foreach ($allStudentComplaints as $x) {
                $reasonID = $x->reason_id;
                $reportReason = $this->filterModel->reportSeasonById($reasonID);
                $x->reportReason = $reportReason;

                $tutorID = $x->tutor_id;
                $tutor = $this->filterModel->userById($tutorID);
                $x->tutor = $tutor;

                $studentID = $x->student_id;
                $student = $this->filterModel->userById($studentID);
                $x->student = $student;
            }


            $totalNumOfStudentComplaints = $this->filterModel->totalNumOfStudentComplaints();


            if (empty($studentComplaintSearchName) && $studentComplaintFilterName == 'all') {
                $filterResult = $allStudentComplaints;
            } else if (empty($studentComplaintSearchName) && $studentComplaintFilterName == 'not_choose') {
                $filterResult = $allStudentComplaints;
            } else if (empty($studentComplaintSearchName) && $studentComplaintFilterName == 'solved') {
                foreach ($allStudentComplaints as $aStudentComplaint) {
                    if ($aStudentComplaint->is_inquired == '1') {
                        array_push($filterResult, $aStudentComplaint);
                    }
                }
            } else if (empty($studentComplaintSearchName) && $studentComplaintFilterName == 'not_resolve') {
                foreach ($allStudentComplaints as $aStudentComplaint) {
                    if ($aStudentComplaint->is_inquired == '0') {
                        array_push($filterResult, $aStudentComplaint);
                    }
                }
            } else if (!empty($studentComplaintSearchName) && $studentComplaintFilterName == 'not_choose') {
                foreach ($allStudentComplaints as $aStudentComplaint) {
                    if (str_contains(strtolower($aStudentComplaint->student->first_name . ' ' . $aStudentComplaint->student->last_name), strtolower($studentComplaintSearchName))) {
                        array_push($filterResult, $aStudentComplaint);
                    }
                }
            } else if (!empty($studentComplaintSearchName) && $studentComplaintFilterName == 'all') {
                foreach ($allStudentComplaints as $aStudentComplaint) {
                    if (($aStudentComplaint->is_inquired == '0' || $aStudentComplaint->is_inquired == '1') && str_contains(strtolower($aStudentComplaint->student->first_name . ' ' . $aStudentComplaint->student->last_name), strtolower($studentComplaintSearchName))) {
                        array_push($filterResult, $aStudentComplaint);
                    }
                }
            } else if (!empty($studentComplaintSearchName) && $studentComplaintFilterName == 'solved') {
                foreach ($allStudentComplaints as $aStudentComplaint) {
                    if ($aStudentComplaint->is_inquired == '1' && str_contains(strtolower($aStudentComplaint->student->first_name . ' ' . $aStudentComplaint->student->last_name), strtolower($studentComplaintSearchName))) {
                        array_push($filterResult, $aStudentComplaint);
                    }
                }
            } else if (!empty($studentComplaintSearchName) && $studentComplaintFilterName == 'not_resolve') {
                foreach ($allStudentComplaints as $aStudentComplaint) {
                    if ($aStudentComplaint->is_inquired == '0' && str_contains(strtolower($aStudentComplaint->student->first_name . ' ' . $aStudentComplaint->student->last_name), strtolower($studentComplaintSearchName))) {
                        array_push($filterResult, $aStudentComplaint);
                    }
                }
            } else {
                $filterResult = $allStudentComplaints;
            }



            $uniqueFilterResult = array_unique($filterResult, SORT_REGULAR);

            $data = [
                'allStudentComplaints' => $uniqueFilterResult,
                'totalNumOfStudentComplaints' => $totalNumOfStudentComplaints,
            ];

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';


            $this->view('admin/studentComplainSearch&FilterResult', $request, $data);
        }
    }



    public function filterForTutorComplaint(Request $request)
    {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        $filterResult = [];


        if ($request->isGet()) {
            $bodyData = $request->getBody();

            $tutorComplaintSearchName = $bodyData['search_tutor_name_value'];
            $tutorComplaintFilterName = $bodyData['tutor_complaint_filter_value'];
            $currentPageNum = $bodyData['currentPageNum'];

            // echo $tutorComplaintSearchName;
            // echo $tutorComplaintFilterName;
            // echo $currentPageNum;

            if ($currentPageNum == 'null') {
                $currentPageNum = 1;
            }


            $rowsPerPage = 5;
            $totalNumOfTutorComplaints = $this->filterModel->totalNumOfTutorComplaints();
            $lastPageNum = ceil($totalNumOfTutorComplaints / $rowsPerPage);

            $start = ($currentPageNum - 1) * $rowsPerPage;

            $allTutorComplaints = $this->filterModel->getTutorComplaints($start, $rowsPerPage);

            // next page
            if ($currentPageNum < $lastPageNum) {
                $nextPageNum = $currentPageNum + 1;
            } else {
                $nextPageNum = $lastPageNum;
            }

            // previous page
            if ($currentPageNum > 1) {
                $previousPageNum = $currentPageNum - 1;
            } else {
                $previousPageNum = 1;
            }


            foreach ($allTutorComplaints as $x) {
                $reasonID = $x->reason_id;
                $reportReason = $this->filterModel->reportSeasonById($reasonID);
                $x->reportReason = $reportReason;

                $tutorID = $x->tutor_id;
                $tutor = $this->filterModel->userById($tutorID);
                $x->tutor = $tutor;

                $studentID = $x->student_id;
                $student = $this->filterModel->userById($studentID);
                $x->student = $student;
            }


            $totalNumOfTutorComplaints = $this->filterModel->totalNumOfTutorComplaints();


            if (empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'all') {
                $filterResult = $allTutorComplaints;
            } else if (empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'not_choose') {
                $filterResult = $allTutorComplaints;
            } else if (empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'solved') {
                foreach ($allTutorComplaints as $aTutorComplaint) {
                    if ($aTutorComplaint->is_inquired == '1') {
                        array_push($filterResult, $aTutorComplaint);
                    }
                }
            } else if (empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'not_resolve') {
                foreach ($allTutorComplaints as $aTutorComplaint) {
                    if ($aTutorComplaint->is_inquired == '0') {
                        array_push($filterResult, $aTutorComplaint);
                    }
                }
            } else if (!empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'not_choose') {
                foreach ($allTutorComplaints as $aTutorComplaint) {
                    if (str_contains(strtolower($aTutorComplaint->tutor->first_name . ' ' . $aTutorComplaint->tutor->last_name), strtolower($tutorComplaintSearchName))) {
                        array_push($filterResult, $aTutorComplaint);
                    }
                }
            } else if (!empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'all') {
                foreach ($allTutorComplaints as $aTutorComplaint) {
                    if (($aTutorComplaint->is_inquired == '1' || $aTutorComplaint->is_inquired == '0') && str_contains(strtolower($aTutorComplaint->tutor->first_name . ' ' . $aTutorComplaint->tutor->last_name), strtolower($tutorComplaintSearchName))) {
                        array_push($filterResult, $aTutorComplaint);
                    }
                }
            } else if (!empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'solved') {
                foreach ($allTutorComplaints as $aTutorComplaint) {
                    if ($aTutorComplaint->is_inquired == '1' && str_contains(strtolower($aTutorComplaint->tutor->first_name . ' ' . $aTutorComplaint->tutor->last_name), strtolower($tutorComplaintSearchName))) {
                        array_push($filterResult, $aTutorComplaint);
                    }
                }
            } else if (!empty($tutorComplaintSearchName) && $tutorComplaintFilterName == 'not_resolve') {
                foreach ($allTutorComplaints as $aTutorComplaint) {
                    if ($aTutorComplaint->is_inquired == '0' && str_contains(strtolower($aTutorComplaint->tutor->first_name . ' ' . $aTutorComplaint->tutor->last_name), strtolower($tutorComplaintSearchName))) {
                        array_push($filterResult, $aTutorComplaint);
                    }
                }
            } else {
                $filterResult = $allTutorComplaints;
            }



            $uniqueFilterResult = array_unique($filterResult, SORT_REGULAR);

            $data = [
                'allTutorComplaints' => $uniqueFilterResult,
                'totalNumOfTutorComplaints' => $totalNumOfTutorComplaints,
            ];

            // echo '<pre>';
            // print_r($data);
            // echo '</pre>';


            $this->view('admin/tutorComplainSearch&FilterResult', $request, $data);
        }
    }
}
