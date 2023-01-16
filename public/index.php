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









$router->registerController('/login', [TutorStudentAuth::class, 'login']);
$router->registerController('/student/register', [TutorStudentAuth::class, 'tutorStudentRegister']);
$router->registerController('/tutor/register', [TutorStudentAuth::class, 'tutorStudentRegister']);

$router->registerController('/student/complete-profile', [StudentProfile::class, 'studentCompleteProfile']);







// Admin routes








// Tutor routes








// Student routes



$router->resolve();
