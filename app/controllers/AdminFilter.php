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
}
