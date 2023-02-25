<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/dashboard.css">
    <title>UniGura</title>
</head>

<body>

    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/without-logo.png" alt="" id="image">
                </span>

                <!-- <div class="text logo-text">
                    <span class="name">UniGura</span>
                    <span class="profession">Web developer</span>
                </div> -->
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link active" id="dashboard">
                        <p></p>
                        <p></p>
                        <a href="dashboard">
                            <i class='fa fa-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link" id="student">
                        <p></p>
                        <p></p>
                        <a href="student">
                            <i class="fa fa-graduation-cap icon"></i>
                            <span class="text nav-text">Student</span>
                        </a>
                    </li>

                    <li class="nav-link" id="tutor">
                        <p></p>
                        <p></p>
                        <a href="tutor">
                            <i class="fa fa-person-chalkboard icon"></i>
                            <span class="text nav-text">Tutor</span>
                        </a>
                    </li>

                    <li class="nav-link" id="class">
                        <p></p>
                        <p></p>
                        <a href="class">
                            <i class="fa fa-school icon"></i>
                            <span class="text nav-text">Class</span>
                        </a>
                    </li>

                    <li class="nav-link subjectLink" id="subject">
                        <p></p>
                        <p></p>
                        <a href="subjectModule">
                            <i class="fa fa-light fa-book icon"></i>
                            <span class="text nav-text">Subject</span>
                        </a>
                    </li>

                    <li class="nav-link subjectLink" id="statistic">
                        <p></p>
                        <p></p>
                        <a href="statistics">
                            <i class="fa-solid fa-chart-simple icon "></i>
                            <span class="text nav-text">Statistic</span>
                        </a>
                    </li>

                    <li class="nav-link" id="request-complaint">
                        <p></p>
                        <p></p>
                        <a href="tutorRequest">
                            <i class="fa fa-headset icon"></i>
                            <span class="text nav-text">Request & Complaint</span>
                        </a>
                    </li>

                    <li class="nav-link" id="payment">
                        <p></p>
                        <p></p>
                        <a href="payment">
                            <i class="fa fa-money-bill-wave icon"></i>
                            <span class="text nav-text">Payment</span>
                        </a>
                    </li>
                    <li class="nav-link" id="notification">
                        <p></p>
                        <p></p>
                        <a href="notification">
                            <i class="fa fa-bell icon"></i>
                            <span class="text nav-text">Notification</span>
                        </a>
                    </li>
                    <li class="nav-link" id="profile">
                        <p></p>
                        <p></p>
                        <a href="profileView">
                            <i class="fa fa-user icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                <br>
                <ul>
                    <li class="nav-link" id="logout">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class='bx bx-log-out icon'></i>
                            <span class="text nav-text">logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>