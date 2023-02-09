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








// Tutor routes
$router->registerController('/tutor/complete-profile', [TutorStudentProfileComplete::class, 'tutorCompleteProfile']);
$router->registerController('/tutor/create-course', [TutorCreateCourse:: class, 'tutorcreatecourse'] );
$router->registerController('/tutor/storeData', [TutorCreateCourse:: class, 'storeData'] );
$router->registerController('/tutor/update-profile',[TutorUpdateProfile:: class, 'tutorupdateProfile']);
$router->registerController('/tutor/report-problem',[TutorReportProblem:: class, 'tutorreportProblem']);



$router->registerController('/tutor/pending', [TutorPending::class, 'tutorPending']);

$router->registerController('/tutor/aproved', [TutorPending::class, 'tutorAproved']);
$router->registerController('tutor/complete-bank-detials', [TutorPending::class, 'tutorCompleteBankDetials']);
$router->registerController('tutor/tutor-time-slot-input', [TutorPending::class, 'tutorTimeSlotInput']);
$router->registerController('tutor/tutor-time-slot-inputs', [TutorPending::class, 'help']);



$router->registerController('/tutor/dashboard', [TutorDashboard::class, 'dashboard']);
$router->registerController('/tutor/dashboard/create-class-template', [TutorDashboard::class, 'createClassTemplate']);
$router->registerController('/tutor/dashboard/api/modules', [TutorDashboard::class, 'getModule']);
$router->registerController('/tutor/viewcourse', [TutorCourse::class, 'viewcourse']);
$router->registerController('/tutor/createday', [TutorCourse::class, 'createDay']);
$router->registerController('/tutor/classes', [TutorClass::class, 'mainpage']);
$router->registerController('/tutor/payments', [TutorPayments::class, 'mainpage']);
$router->registerController('/tutor/chat', [TutorChat::class, 'mainpage']);
$router->registerController('/tutor/notification', [TutorNotification::class, 'mainpage']);
$router->registerController('/tutor/calender', [TutorCalender::class, 'mainpage']);



$router->registerController('/tutor/notifications', [TutorNotification::class, 'notification']);


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


$router->resolve();
