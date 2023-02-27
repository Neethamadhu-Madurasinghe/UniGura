<?php

require_once '../app/bootloader.php';

$request = new Request();
$router = new Router($request);



// Common routes
$router->registerController('/load-file', [FileLoader::class, 'loadFile']);
$router->registerController('/logout', [TutorStudentAuth::class, 'logout']);









$router->registerController('/login', [TutorStudentAuth::class, 'login']);
$router->registerController('/student/register', [TutorStudentAuth::class, 'tutorStudentRegister']);
$router->registerController('/tutor/register', [TutorStudentAuth::class, 'tutorStudentRegister']);








// Admin routes








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
$router->registerController('/student/profile', [StudentProfile::class, 'profile']);
$router->registerController('/api/report-tutor', [StudentTutorProfile::class, 'reportTutor']);
$router->registerController('/student/tutor-profile', [StudentTutorProfile::class, 'tutorProfile']);
$router->registerController('/student/class', [StudentClass::class, 'tutoringClass']);
$router->registerController('/student/chat', [StudentClass::class, 'chat']);


$router->resolve();
