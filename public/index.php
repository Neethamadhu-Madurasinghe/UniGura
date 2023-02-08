<?php

require_once '../app/bootloader.php';

$request = new Request();
$router = new Router($request);

// Example routes
$router->registerController('/example/login', [ExampleAuth::class, 'login']);
$router->registerController('/example/register', [ExampleAuth::class, 'register']);
$router->registerController('/example/logout', [ExampleAuth::class, 'logout']);
$router->registerController('/example/dashboard', [ExampleDashboard::class, 'dashboard']);

$router->registerController('/api/example', [ExampleRestAPI::class, 'testAPI']);

// Common routes
$router->registerController('/load-file', [FileLoader::class, 'loadFile']);
$router->registerController('/logout', [TutorStudentAuth::class, 'logout']);









$router->registerController('/login', [TutorStudentAuth::class, 'login']);
$router->registerController('/student/register', [TutorStudentAuth::class, 'tutorStudentRegister']);
$router->registerController('/tutor/register', [TutorStudentAuth::class, 'tutorStudentRegister']);








// Admin routes

$router->registerController('/admin/dashboard', [AdminDashboard::class, 'dashboard']);
$router->registerController('/admin/subjectModule', [AdminSubjectModule::class, 'subjectsAndModules']);
$router->registerController('/admin/addSubject', [AdminSubjectModule::class, 'addSubject']);
$router->registerController('/admin/addModule', [AdminSubjectModule::class, 'addModule']);
$router->registerController('/admin/updateModule', [AdminSubjectModule::class, 'updateModule']);
$router->registerController('/admin/updateModuleHideShow', [AdminSubjectModule::class, 'updateModuleHideShow']);



$router->registerController('/admin/student', [AdminStudent::class, 'student']);
$router->registerController('/admin/viewStudentProfile', [AdminStudentProfile::class, 'viewStudentProfile']);



$router->registerController('/admin/class', [AdminClass::class, 'class']);


$router->registerController('/admin/tutor', [AdminTutor::class, 'tutor']);
$router->registerController('/admin/viewTutorProfile', [AdminTutorProfile::class, 'viewTutorProfile']);


$router->registerController('/admin/requirementComplaints', [AdminRequirementComplaints::class, 'requirementComplaints']);
$router->registerController('/admin/addStudentComplainReason', [AdminRequirementComplaints::class, 'addStudentComplainReason']);
$router->registerController('/admin/addTutorComplainReason', [AdminRequirementComplaints::class, 'addTutorComplainReason']);
$router->registerController('/admin/updateStudentComplainReason', [AdminRequirementComplaints::class, 'updateStudentComplainReason']);
$router->registerController('/admin/updateTutorComplainReason', [AdminRequirementComplaints::class, 'updateTutorComplainReason']);



$router->registerController('/admin/payment', [AdminPayment::class, 'payment']);
$router->registerController('/admin/selectedTutorDetails', [AdminPayment::class, 'selectedTutorDetails']);


$router->registerController('/admin/chat', [AdminChat::class, 'chat']);



$router->registerController('/admin/notification', [AdminNotification::class, 'notification']);
$router->registerController('/admin/notification/clearNotification', [AdminNotification::class, 'clearNotification']);




$router->registerController('/admin/viewComplaint', [AdminComplaintView::class, 'viewComplaint']);
$router->registerController('/admin/updateComplainInquire', [AdminComplaintView::class, 'updateComplainInquire']);



$router->registerController('/admin/tutorRequest', [AdminTutorRequest::class, 'tutorRequest']);
$router->registerController('/admin/studentComplaint', [AdminStudentComplaint::class, 'studentComplaint']);
$router->registerController('/admin/tutorComplaint', [AdminTutorComplaint::class, 'tutorComplaint']);
$router->registerController('/admin/complaintSetting', [AdminComplaintSetting::class, 'complaintSetting']);


$router->registerController('/admin/profileView', [AdminProfileView::class, 'profileView']);
$router->registerController('/admin/updatePassword', [AdminProfileView::class, 'updatePassword']);



$router->registerController('/admin/filterForStudentPage', [AdminFilter::class, 'filterForStudentPage']);




// Tutor routes
$router->registerController('/tutor/complete-profile', [TutorStudentProfileComplete::class, 'tutorCompleteProfile']);







// Student routes
$router->registerController(
    '/student/complete-profile',
    [TutorStudentProfileComplete::class, 'studentCompleteProfile']
);
$router->registerController(
    '/student/dashboard',
    [StudentDashboard::class, 'dashboard']
);
$router->registerController('/api/get-class', [StudentDashboard::class, 'takenClasses']);
$router->registerController('/api/modules', [FindTutor::class, 'getModule']);
$router->registerController('/api/find-tutoring-class', [FindTutor::class, 'findTutoringClass']);
$router->registerController('/api/time-table', [FindTutor::class, 'getTutorTimeTable']);
$router->registerController('/api/request', [FindTutor::class, 'sendTutorRequest']);
$router->registerController('/student/find-tutor', [FindTutor::class, 'findTutor']);
$router->registerController('/api/report-tutor', [StudentTutorProfile::class, 'reportTutor']);
$router->registerController('/student/tutor-profile', [StudentTutorProfile::class, 'tutorProfile']);


$router->resolve();
