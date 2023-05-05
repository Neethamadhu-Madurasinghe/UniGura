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
                <img src="./logo.png" alt="">
            </li>

            
            <li>
                <a href="dashboard">
                    <span class="icon"><i class="fa fa-solid fa-house"></i></span>
                    <span class="title">Home</span>
                </a>
            </li>
            <li>
                <a href="student">
                    <span class="icon"><i class="fa fa-graduation-cap icon"></i></span>
                    <span class="title">Student</span>
                </a>
            </li>
            <li>
                <a href="tutor">
                    <span class="icon"><i class="fa fa-person-chalkboard icon"></i></span>
                    <span class="title">Tutor</span>
                </a>
            </li>
            <li>
                <a href="class">
                    <span class="icon"><i class="fa fa-school icon"></i></span>
                    <span class="title">Class</span>
                </a>
            </li>
            <li>
                <a href="subjectModule">
                    <span class="icon"><i class="fa fa-light fa-book icon"></i></span>
                    <span class="title">Subject</span>
                </a>
            </li>
            <li>
                <a href="statistics">
                    <span class="icon"><i class="fa fa-solid fa-chart-simple icon "></i></span>
                    <span class="title">Statistic</span>
                </a>
            </li>
            <li>
                <a href="tutorRequest">
                    <span class="icon"><i class="fa fa-solid fa-user-plus"></i></span>
                    <span class="title">Request</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon"><i class="fa fa-sharp fa-light fa-file-circle-exclamation"></i></span>
                    <span class="title">Complaint</span>
                </a>
            </li>
            <li>
                <a href="payment">
                    <!-- <span class="icon"><i class="fa fa-money-bill-wave icon"></i></span> -->
                    <span class="icon"><i class="fa fa-sharp fa-sack-dollar"></i></span>
                    <span class="title">Payment</span>
                </a>
            </li>
            <li>
                <a href="notification">
                    <span class="icon"><i class="fa fa-bell icon"></i></span>
                    <span class="title">Notification</span>
                </a>
            </li>
            <li>
                <a href="profileView">
                    <span class="icon"><i class="fa fa-user icon"></i></span>
                    <span class="title">Profile</span>
                </a>
            </li>



            <li class="log-out">
                <a href="../logout">
                    <span class="icon"><i class="fa fa-solid fa-right-from-bracket fa-rotate-180"></i></span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </div>