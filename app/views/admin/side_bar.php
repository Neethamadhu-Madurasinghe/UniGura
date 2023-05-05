<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/dashboard.css">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>UniGura</title>
</head>

<body>
    <div class="navigation">
        <ul>
            <li class="logo">
                <img src="<?php echo URLROOT ?>/public/img/admin/logo.png" alt="">
            </li>


            <li class="nav-link active" id="dashboard">
                <a href="dashboard">
                    <span class="icon"><i class="fa fa-solid fa-house icon"></i></span>
                    <span class="title">Home</span>
                </a>
            </li>
            <li class="nav-link" id="student">
                <a href="student">
                    <span class="icon"><i class="fa fa-graduation-cap icon"></i></span>
                    <span class="title">Student</span>
                </a>
            </li>
            <li class="nav-link" id="tutor">
                <a href="tutor">
                    <span class="icon"><i class="fa fa-person-chalkboard icon"></i></span>
                    <span class="title">Tutor</span>
                </a>
            </li>
            <li class="nav-link" id="class">
                <a href="class">
                    <span class="icon"><i class="fa fa-school icon"></i></span>
                    <span class="title">Class</span>
                </a>
            </li>
            <li class="nav-link subjectLink" id="subject">
                <a href="subjectModule">
                    <span class="icon"><i class="fa fa-light fa-book icon"></i></span>
                    <span class="title">Subject</span>
                </a>
            </li>
            <li class="nav-link subjectLink" id="statistic">
                <a href="statistics">
                    <span class="icon"><i class="fa fa-solid fa-chart-simple icon"></i></span>
                    <span class="title">Statistic</span>
                </a>
            </li>
            <li class="nav-link" id="request-complaint">
                <a href="tutorRequest">
                    <span class="icon"><i class="fa fa-solid fa-user-plus icon"></i></span>
                    <span class="title">Request</span>
                </a>
            </li>
            <li class="nav-link" id="complaint">
                <a href="studentComplaint">
                    <span class="icon"><i class="fa fa-sharp fa-light fa-file-circle-exclamation icon"></i></span>
                    <span class="title">Complaint</span>
                </a>
            </li>
            <li class="nav-link" id="payment">
                <a href="payment">
                    <!-- <span class="icon"><i class="fa fa-money-bill-wave icon"></i></span> -->
                    <span class="icon"><i class="fa fa-sharp fa-sack-dollar icon"></i></span>
                    <span class="title">Payment</span>
                </a>
            </li>
            <li class="nav-link" id="notification">
                <a href="notification">
                    <span class="icon"><i class="fa fa-bell icon"></i></span>
                    <span class="title">Notification</span>
                </a>
            </li>
            <li class="nav-link" id="profile">
                <a href="profileView">
                    <span class="icon"><i class="fa fa-user icon"></i></span>
                    <span class="title">Profile</span>
                </a>
            </li>



            <li class="log-out">
                <a href="../logout">
                    <span class="icon"><i class="fa fa-solid fa-right-from-bracket fa-rotate-180 icon"></i></span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </div>