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



echo $_SESSION['user_role'];






// Admin routes








// Tutor routes
$router->registerController('/tutor/complete-profile', [TutorStudentProfileComplete::class, 'tutorCompleteProfile']);



$router->registerController('/tutor/pending', [TutorPending::class, 'tutorPending']);

$router->registerController('/tutor/aproved', [TutorPending::class, 'tutorAproved']);
$router->registerController('tutor/complete-bank-detials', [TutorPending::class, 'tutorCompleteBankDetials']);

$router->registerController('/tutor/dashboard', [TutorDashboard::class, 'dashboard']);
$router->registerController('/tutor/dashboard/create-class-template', [TutorDashboard::class, 'createClassTemplate']);
$router->registerController('/tutor/dashboard/api/modules', [TutorDashboard::class, 'getModule']);

$router->registerController('/tutor/notifications', [TutorNotification::class, 'notification']);







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
