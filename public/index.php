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







// Admin routes

$router->registerController('/admin/dashboard',[AdminDashboard::class,'dashboard']);
$router->registerController('/admin/subjectModule', [AdminSubjectModule::class, 'subjectsAndModules']);
$router->registerController('/admin/addSubject', [AdminSubjectModule::class, 'addSubject']);
$router->registerController('/admin/addModule', [AdminSubjectModule::class, 'addModule']);
$router->registerController('/admin/updateModule', [AdminSubjectModule::class, 'updateModule']);
$router->registerController('/admin/updateModuleHideShow', [AdminSubjectModule::class, 'updateModuleHideShow']);



$router->registerController('/admin/student', [AdminStudent::class, 'student']);
$router->registerController('/admin/viewStudentProfile', [AdminStudentProfile::class, 'viewStudentProfile']);



$router->registerController('/admin/class',[AdminClass::class,'class']);

$router->registerController('/admin/tutor',[AdminTutor::class,'tutor']);
$router->registerController('/admin/viewTutorProfile',[AdminTutorProfile::class,'viewTutorProfile']);



$router->registerController('/admin/filter',[AdminFilter::class,'filter']);
$router->registerController('/admin/requirementComplaints',[AdminRequirementComplaints::class,'requirementComplaints']);


$router->registerController('/admin/payment',[AdminPayment::class,'payment']);
$router->registerController('/admin/selectedTutorDetails',[AdminPayment::class,'selectedTutorDetails']);


$router->registerController('/admin/chat',[AdminChat::class,'chat']);

$router->registerController('/admin/notification',[AdminNotification::class,'notification']);





// Tutor routes








// Student routes



$router->resolve();
