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

        foreach ($allTutors as $tutor) {
            $tutorID = $tutor->user_id;
            $tutorContactDetails = $this->filterModel->getTutorContactDetails($tutorID);
            $tutor->contactDetails = $tutorContactDetails;
        }


        if ($request->isGet()) {
            $bodyData = $request->getBody();

            $classConductModeValue = $bodyData['classConductModeFilterValue'];
            $visibilityFilterValue = $bodyData['visibilityFilterValue'];
            $tutorDurationFilterValue = $bodyData['tutorDurationFilterValue'];
            $searchTutorName = $bodyData['searchTutorName'];


            $arrayModes =  explode(',', $classConductModeValue);
            $arrayVisibility =  explode(',', $visibilityFilterValue);
            $arrayDuration =  explode(',', $tutorDurationFilterValue);



            if (empty($searchTutorName) && empty($classConductModeValue) && empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                $filterResult = $allTutors;
            } elseif (empty($searchTutorName) && empty($classConductModeValue) && empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if ($tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (empty($searchTutorName) && empty($classConductModeValue) && !empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (in_array($aTutor->contactDetails->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (empty($searchTutorName) && empty($classConductModeValue) && !empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (in_array($aTutor->contactDetails->is_banned, $arrayVisibility) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (empty($searchTutorName) && !empty($classConductModeValue) && empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (in_array($aTutor->contactDetails->mode, $arrayModes)) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (empty($searchTutorName) && !empty($classConductModeValue) && empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (in_array($aTutor->contactDetails->mode, $arrayModes) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (empty($searchTutorName) && !empty($classConductModeValue) && !empty($visibilityFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (in_array($aTutor->contactDetails->mode, $arrayModes) && in_array($aTutor->contactDetails->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (empty($searchTutorName) && !empty($classConductModeValue) && !empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (in_array($aTutor->contactDetails->mode, $arrayModes) && in_array($aTutor->contactDetails->is_banned, $arrayVisibility) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && empty($classConductModeValue) && empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName))) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && empty($classConductModeValue) && empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && empty($classConductModeValue) && !empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && in_array($aTutor->contactDetails->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && empty($classConductModeValue) && !empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && in_array($aTutor->contactDetails->is_banned, $arrayVisibility) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && !empty($classConductModeValue) && empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && in_array($aTutor->contactDetails->mode, $arrayModes)) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && !empty($classConductModeValue) && empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && in_array($aTutor->contactDetails->mode, $arrayModes) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && !empty($classConductModeValue) && !empty($visibilityFilterValue) && empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {
                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && in_array($aTutor->contactDetails->mode, $arrayModes) && in_array($aTutor->contactDetails->is_banned, $arrayVisibility)) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } elseif (!empty($searchTutorName) && !empty($classConductModeValue) && !empty($visibilityFilterValue) && !empty($tutorDurationFilterValue)) {
                foreach ($allTutors as $aTutor) {

                    $currentTime = new DateTime();
                    $joinedDate = new DateTime($aTutor->contactDetails->joined_date);

                    $tutorTimeDuration =  $currentTime->diff($joinedDate)->format("%y");

                    if (str_contains(strtolower($aTutor->contactDetails->first_name . ' ' . $aTutor->contactDetails->last_name), strtolower($searchTutorName)) && in_array($aTutor->contactDetails->mode, $arrayModes) && in_array($aTutor->contactDetails->is_banned, $arrayVisibility) && $tutorTimeDuration <= $tutorDurationFilterValue) {
                        array_push($filterResult, $aTutor);
                    }
                }
            } else {
                $filterResult = $allTutors;
            }
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
            $studentId = $x->student_id;
            $tutorId = $x->tutor_id;
            $classId = $x->id;
            $classTemplateId = $x->class_template_id;

            $student = $this->filterModel->findStudent($studentId);
            $tutor = $this->filterModel->findTutor($tutorId);
            $classDay = $this->filterModel->findClassDay($classId);
            $classTemplate = $this->filterModel->findTutoringClassTemplate($classTemplateId);

            $x->student = $student;
            $x->tutor = $tutor;
            $x->classDay = $classDay;
            $x->classTemplate = $classTemplate;


            $module = $this->filterModel->findModule($classTemplate->module_id);
            $x->module = $module;

            $subject = $this->filterModel->findSubject($classTemplate->subject_id);
            $x->subject = $subject;
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
            $classConductModeFilterValue = $bodyData['classConductModeFilterValue'];
            $subjectFilterValue = $bodyData['subjectFilterValue'];

            $arrayRating = explode(',', $ratingFilterValue);
            $arrayModes = explode(',', $classConductModeFilterValue);
            $arraySubjects = explode(',', $subjectFilterValue);

            if (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }

                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->mode, $arrayModes)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->mode, $arrayModes) && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->mode, $arrayModes) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->classTemplate->current_rating, $arrayRating)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->mode, $arrayModes)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (!empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->mode, $arrayModes) && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if ($aClass->classTemplate->session_rate <= $classFeesInputMaxValue && in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->mode, $arrayModes) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->classTemplate->current_rating, $arrayRating)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if (in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->classTemplate->mode, $arrayModes)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && !empty($ratingFilterValue) && !empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->mode, $arrayModes) && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if (in_array($aClass->classTemplate->current_rating, $arrayRating) && in_array($aClass->mode, $arrayModes) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->classTemplate->mode, $arrayModes)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && !empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array($aClass->mode, $arrayModes) && in_array($aClass->subject->name, $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                    if (in_array($aClass->mode, $arrayModes) && in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($classConductModeFilterValue) && !empty($subjectFilterValue)) {
                foreach ($allClasses as $aClass) {
                    if (in_array('all', $arraySubjects)) {
                        array_push($filterResult, $aClass);
                    }
                }
            } elseif (empty($classFeesInputMaxValue) && empty($ratingFilterValue) && empty($classConductModeFilterValue) && empty($subjectFilterValue)) {
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
}
