<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/dashboard.css">
    <script defer src="<?php echo URLROOT ?>/public/js/admin/dashboard.js"></script>
    <title>Responsive side bar</title>
</head>

<body>

    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/without-logo.png" alt="" id="image">
                </span>

                <!-- <div class="text logo-text">
                    <span class="name">Codinglab</span>
                    <span class="profession">Web developer</span>
                </div> -->
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <!-- <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li> -->

                <ul class="menu-links">
                    <li class="nav-link active" id="dashboard">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class='fa fa-home-alt icon'></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link" id="student">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-graduation-cap icon"></i>
                            <span class="text nav-text">Student</span>
                        </a>
                    </li>

                    <li class="nav-link" id="tutor">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-person-chalkboard icon"></i>
                            <span class="text nav-text">Tutor</span>
                        </a>
                    </li>

                    <li class="nav-link" id="class">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-school icon"></i>
                            <span class="text nav-text">Class</span>
                        </a>
                    </li>

                    <li class="nav-link subjectLink" id="subject">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-light fa-book icon"></i>
                            <span class="text nav-text">Subject</span>
                        </a>
                    </li>

                    <li class="nav-link" id="chat">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-envelope icon"></i>
                            <span class="text nav-text">Chat</span>
                        </a>
                    </li>

                    <li class="nav-link" id="request-complaint">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-headset icon"></i>
                            <span class="text nav-text">Request & Complaint</span>
                        </a>
                    </li>

                    <li class="nav-link" id="payment">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-money-bill-wave icon"></i>
                            <span class="text nav-text">Payment</span>
                        </a>
                    </li>
                    <li class="nav-link" id="notification">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-bell icon"></i>
                            <span class="text nav-text">Notification</span>
                        </a>
                    </li>
                    <li class="nav-link" id="profile">
                        <p></p>
                        <p></p>
                        <a href="#">
                            <i class="fa fa-user icon"></i>
                            <span class="text nav-text">Profile</span>
                        </a>
                    </li>

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

            <div class="bottom-content">
                <!-- <li class="logout">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li> -->

                <!-- <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li> -->

            </div>
        </div>

    </nav>

    <section class="home" id="home">
        <p></p>
        <p></p>
        <p></p>
        <p></p>


        <div class="parent">
            <div class="div1">
                <!--=========================== TODO============================== -->
            </div>
            <div class="div2">
                <div class="menu_btn">

                    <a href="#">
                        <div class="tutors">
                            <div class="details">
                                <h2>TUTORS</h2>
                                <h2>- 00 -</h2>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-person-chalkboard"></i>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="students">
                            <div class="details">
                                <h2>STUDENTS</h2>
                                <h2>- 00 -</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-light fa-graduation-cap"></i>
                            </div>
                        </div>
                    </a>

                    <a href="#">
                        <div class="classes">
                            <div class="details">
                                <h2>CLASSES</h2>
                                <h2>- 00 -</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-school"></i>
                            </div>
                        </div>
                    </a>

                    <a href="../admin-subject/newSubject.php">
                        <div class="subjects">
                            <div class="details">
                                <h2>SUBJECTS</h2>
                                <h2>- 00 -</h2>
                            </div>
                            <div class="icon">
                                <i class="fa fa-light fa-book"></i>
                            </div>
                        </div>
                    </a>

                </div>


                <div class="class-details-table">
                    <table>
                        <thead>
                            <tr>
                                <th id="tutor-thead">Tutor</th>
                                <th>Student</th>
                                <th>Status</th>
                                <th>Subject</th>
                                <th id="classFees-thead">Class Fees</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Viraj Sandakelum</td>
                                <td>Viraj Sandakelum</td>
                                <td>
                                    <!-- <div class="complete-status">
                                        <img src="./images/green-dot.png" alt="">
                                        <h6>Completed</h6>
                                    </div> -->

                                    <div class="pending-status">
                                        <img src="./images/blue-dot.png" alt="">
                                        <h6>Pending</h6>
                                    </div>

                                    <!-- <div class="today-status">
                                        <img src="./images/red-dot.png" alt="">
                                        <h6>Today</h6>
                                    </div> -->

                                </td>
                                <td>Combine Mathtematics</td>
                                <td>RS.20000</td>
                            </tr>


                            <tr>
                                <td>Viraj Sandakelum</td>
                                <td>Viraj Sandakelum</td>
                                <td>
                                    <!-- <div class="complete-status">
                                        <img src="./images/green-dot.png" alt="">
                                        <h6>Completed</h6>
                                    </div> -->

                                    <div class="pending-status">
                                        <img src="./images/blue-dot.png" alt="">
                                        <h6>Pending</h6>
                                    </div>

                                    <!-- <div class="today-status">
                                        <img src="./images/red-dot.png" alt="">
                                        <h6>Today</h6>
                                    </div> -->

                                </td>
                                <td>Combine Mathtematics</td>
                                <td>RS.20000</td>
                            </tr>



                            <tr>
                                <td>Viraj Sandakelum</td>
                                <td>Viraj Sandakelum</td>
                                <td>
                                    <!-- <div class="complete-status">
                                        <img src="./images/green-dot.png" alt="">
                                        <h6>Completed</h6>
                                    </div> -->

                                    <div class="pending-status">
                                        <img src="./images/blue-dot.png" alt="">
                                        <h6>Pending</h6>
                                    </div>

                                    <!-- <div class="today-status">
                                        <img src="./images/red-dot.png" alt="">
                                        <h6>Today</h6>
                                    </div> -->

                                </td>
                                <td>Combine Mathtematics</td>
                                <td>RS.20000</td>
                            </tr>   


                        </tbody>
                    </table>
                </div>

            </div>

            <div class="div3">
                <div class="right_sidebar">

                    <div class="new_approval">
                        <div class="title">
                            <h2>New Approval</h2>
                            <a href="#">View All</a>
                        </div>
                        <div class="requested_list">
                            <!-- <div class="no_request">
                                <img src="./emptyTutorRequest.png" alt="">
                                <span>Looks like you haven't tutor request yet</span>
                            </div> -->


                            <div class="available-request">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="request-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>


                            <div class="available-request">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="request-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>



                            <div class="available-request">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="request-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>



                            <div class="available-request">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="request-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>


                            <div class="available-request">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="request-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="complaints">
                        <div class="title">
                            <h2>Complaints</h2>
                            <a href="#">View All</a>
                        </div>
                        <div class="complaints_list">
                            <!-- <div class="no_complaint">
                                <img src="./emptyCompliants.png" alt="">
                                <span>Looks like you haven't complaints yet</span>
                            </div> -->

                            <div class="available-complaints">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="complaint-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>


                            <div class="available-complaints">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="complaint-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>


                            <div class="available-complaints">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="complaint-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>



                            <div class="available-complaints">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="complaint-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>

                            <div class="available-complaints">
                                <div class="profile-img">
                                    <img src="./images/profile.png" alt="">
                                </div>
                                <div class="complaint-details">
                                    <h3>Viraj Sandakelum</h3>
                                    <span>Complaint about the tutor</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <script>
        console.log("aaaaaaaaaaaaaaa");
    </script>

</body>

</html>