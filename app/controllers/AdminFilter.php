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

            // print_r($arrayVisibility);

            if (array_key_exists("0", $arrayVisibility)) {
                if ($arrayVisibility[0] == 'block') {
                    $arrayVisibility[0] = 1;
                } else {
                    $arrayVisibility[0] = 0;
                }
            }

            if (array_key_exists("1", $arrayVisibility)) {
                if ($arrayVisibility[1] == 'unblock') {
                    $arrayVisibility[1] = 0;
                } else {
                    $arrayVisibility[1] = 1;
                }
            }

            // print_r($arrayVisibility);

            // Array ( [0] => block [1] => unblock ) 
            // Array ( [0] => 1 [1] => 0 )


            if (array_key_exists("0", $arrayModes) && array_key_exists("1", $arrayModes)) {
                if ($arrayModes[0] == 'online' && $arrayModes[1] == 'physical') {
                    unset($arrayModes[1]);
                    $arrayModes[0] = 'both';
                } else if ($arrayModes[0] == 'physical' && $arrayModes[1] == 'online') {
                    unset($arrayModes[1]);
                    $arrayModes[0] = 'both';
                }
            }

            // print_r($arrayModes);


            if (empty($searchStudentName) && empty($classConductModeValue) && empty($visibilityFilterValue)) {
                $filterResult = $allStudent;
            } elseif (empty($searchStudentName) && empty($classConductModeValue) && !empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (in_array($aStudent->student->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aStudent);
                    }
                }
            } elseif (empty($searchStudentName) && !empty($classConductModeValue) && empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (in_array($aStudent->student->mode, $arrayModes)) {
                        array_push($filterResult, $aStudent);
                    }
                }
            } elseif (empty($searchStudentName) && !empty($classConductModeValue) && !empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (in_array($aStudent->student->mode, $arrayModes) && in_array($aStudent->student->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aStudent);
                    }
                }
            } elseif (!empty($searchStudentName) && empty($classConductModeValue) && empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (str_contains(strtolower($aStudent->student->first_name . ' ' . $aStudent->student->last_name), strtolower($searchStudentName))) {
                        array_push($filterResult, $aStudent);
                    }
                }
            } elseif (!empty($searchStudentName) && empty($classConductModeValue) && !empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (str_contains(strtolower($aStudent->student->first_name . ' ' . $aStudent->student->last_name), strtolower($searchStudentName)) && in_array($aStudent->student->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aStudent);
                    }
                }
            } elseif (!empty($searchStudentName) && !empty($classConductModeValue) && empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (str_contains(strtolower($aStudent->student->first_name . ' ' . $aStudent->student->last_name), strtolower($searchStudentName)) && in_array($aStudent->student->mode, $arrayModes)) {
                        array_push($filterResult, $aStudent);
                    }
                }
            } elseif (!empty($searchStudentName) && !empty($classConductModeValue) && !empty($visibilityFilterValue)) {
                foreach ($allStudent as $aStudent) {
                    if (str_contains(strtolower($aStudent->student->first_name . ' ' . $aStudent->student->last_name), strtolower($searchStudentName)) && in_array($aStudent->student->mode, $arrayModes) && in_array($aStudent->student->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aStudent);
                    }
                }
            }
        }

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


            if (array_key_exists("0", $arrayVisibility)) {
                if ($arrayVisibility[0] == 'show') {
                    $arrayVisibility[0] = 1;
                } else {
                    $arrayVisibility[0] = 0;
                }
            }

            if (array_key_exists("1", $arrayVisibility)) {
                if ($arrayVisibility[1] == 'hide') {
                    $arrayVisibility[1] = 0;
                } else {
                    $arrayVisibility[1] = 1;
                }
            }


            if (array_key_exists("0", $arrayPermission)) {
                if ($arrayPermission[0] == 'block') {
                    $arrayPermission[0] = 1;
                } else {
                    $arrayPermission[0] = 0;
                }
            }

            if (array_key_exists("1", $arrayPermission)) {
                if ($arrayPermission[1] == 'unblock') {
                    $arrayPermission[1] = 0;
                } else {
                    $arrayPermission[1] = 1;
                }
            }

            // print_r($arrayVisibility);

            $sql = "SELECT tutor.*, user.* FROM tutor INNER JOIN user ON tutor.user_id = user.id";

            if (!empty($searchTutorName)) {
                $sql .= " WHERE user.first_name LIKE '%$searchTutorName%' OR user.last_name LIKE '%$searchTutorName%'";
            }

            if (!empty($classConductModeValue) && !empty($arrayModes[1])) {
                $sql .= " AND user.mode IN ('$arrayModes[0]','$arrayModes[1]')";
            } elseif (!empty($classConductModeValue)) {
                $sql .= " AND user.mode = '$arrayModes[0]'";
            }

            if (!empty($visibilityFilterValue) && !empty($arrayVisibility[1])) {
                $sql .= " AND tutor.is_hidden IN ('$arrayVisibility[0]','$arrayVisibility[1]')";
            } elseif (!empty($visibilityFilterValue)) {
                $sql .= " AND tutor.is_hidden = '$arrayVisibility[0]'";
            }

            if (!empty($permissionFilterValue) && !empty($arrayPermission[1])) {
                $sql .= " AND user.is_banned IN ('$arrayPermission[0]','$arrayPermission[1]')";
            } elseif (!empty($permissionFilterValue)) {
                $sql .= " AND user.is_banned = '$arrayPermission[0]'";
            }

            if (!empty($tutorDurationFilterValue) && !empty($arrayDuration[1])) {
                $current_time = date('Y-m-d H:i:s');
                $one_year_later = date('Y-m-d H:i:s', strtotime($current_time . ' +1 year'));

                echo $current_time;
                echo '<br>';

                echo $one_year_later;

                // $joinedDate = $->joined_date;
                // $specific_time = new DateTime($joinedDate);

                // $time_diff = $current_time->diff($specific_time)->y;

                // echo $current_time;

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
                    if ($aStudentComplaint->is_inquired == '1' && str_contains(strtolower($aStudentComplaint->student->first_name . ' ' . $aStudentComplaint->student->last_name), strtolower($studentComplaintSearchName))) {
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
                    if ($aTutorComplaint->is_inquired == '1' && str_contains(strtolower($aTutorComplaint->tutor->first_name . ' ' . $aTutorComplaint->tutor->last_name), strtolower($tutorComplaintSearchName))) {
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
