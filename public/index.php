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
$router->registerController('/tutor/create-course', [TutorCreateCourse::class, 'tutorcreatecourse']);
$router->registerController('/tutor/storeData', [TutorCreateCourse::class, 'storeData']);
$router->registerController('/tutor/update-profile', [TutorUpdateProfile::class, 'tutorupdateProfile']);
$router->registerController('/tutor/report-problem', [TutorReportProblem::class, 'tutorreportProblem']);



$router->registerController('/tutor/pending', [TutorPending::class, 'tutorPending']);

$router->registerController('/tutor/aproved', [TutorPending::class, 'tutorAproved']);
$router->registerController('tutor/complete-bank-detials', [TutorPending::class, 'tutorCompleteBankDetials']);
$router->registerController('tutor/tutor-time-slot-input', [TutorPending::class, 'tutorTimeSlotInput']);
$router->registerController('tutor/tutor-time-slot-inputs', [TutorPending::class, 'help']);
$router->registerController('tutor/update-time-slots', [TutorPending::class, 'updateTimeSlots']);




$router->registerController('/tutor/dashboard', [TutorDashboard::class, 'dashboard']);
$router->registerController('/tutor/dashboard/create-class-template', [TutorDashboard::class, 'createClassTemplate']);
$router->registerController('/tutor/dashboard/api/modules', [TutorDashboard::class, 'getModule']);
$router->registerController('/tutor/viewcourse', [TutorCourse::class, 'viewcourse']);
$router->registerController('/tutor/createday', [TutorCourse::class, 'createDay']);
$router->registerController('/tutor/updateclasstemplate', [TutorCourse::class, 'updateClassTemplate']);
$router->registerController('/tutor/deleteclasstemplate', [TutorCourse::class, 'deleteClassTemplate']);
$router->registerController('/tutor/sendposition', [TutorCourse::class, 'sendposition']);
$router->registerController('/tutor/addactivity', [TutorCourse::class, 'addActivityTemplate']);
$router->registerController('/tutor/getactivity', [TutorCourse::class, 'getactivity']);
$router->registerController('/tutor/viewactivitydoc', [TutorCourse::class, 'loadTutorFile']);
$router->registerController('/tutor/updateday', [TutorCourse::class, 'updateDay']);
$router->registerController('/tutor/deleteday', [TutorCourse::class, 'deleteDayTemplate']);
$router->registerController('/tutor/requestdecline', [TutorDashboard::class, 'requestDecline']);
$router->registerController('/tutor/payment', [TutorDashboard::class, 'payment']);
$router->registerController('/tutor/savepayment', [TutorDashboard::class, 'savepayment']);


$router->registerController('/tutor/classes', [TutorClass::class, 'mainpage']);
$router->registerController('/tutor/payments', [TutorPayments::class, 'mainpage']);
$router->registerController('/tutor/payments/filterpayments', [TutorPayments::class, 'filter_payments_by_day']);
$router->registerController('/tutor/payments/getpaymentamounts', [TutorPayments::class, 'monthly_payment_amounts']);


$router->registerController('/tutor/chat', [TutorChat::class, 'mainpage']);
$router->registerController('/tutor/notification', [TutorNotification::class, 'mainpage']);

$router->registerController('/tutor/viewstudentrequest', [TutorDashboard::class, 'viewrequest']);


$router->registerController('/tutor/getclassdetails', [TutorClass::class, 'getclassdetails']);



$router->registerController('/tutor/notifications', [TutorNotification::class, 'notification']);
$router->registerController('/tutor/notifications/markasseen', [TutorNotification::class, 'mark_as_seen']);
$router->registerController('/tutor/notifications/markasdelete', [TutorNotification::class, 'mark_as_delete']);
$router->registerController('/tutor/notifications/getcount', [TutorNotification::class, 'get_count']);

$router->registerController('/tutor/change-profile-picture', [TutorUpdateProfile::class, 'changeProfilePicture']);

$router->registerController('/tutor/dayunhide', [TutorClass::class, 'day_unhide']);




//payment checkout










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
$router->registerController('/student/profile', [StudentProfile::class, 'profile']);
$router->registerController('/api/report-tutor', [StudentTutorProfile::class, 'reportTutor']);
$router->registerController('/student/tutor-profile', [StudentTutorProfile::class, 'tutorProfile']);



$router->resolve();
