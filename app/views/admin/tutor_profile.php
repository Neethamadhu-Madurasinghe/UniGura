<?php require_once APPROOT . '/views/admin/side_bar.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin/tutorProfile.css">
<script defer src="<?php echo URLROOT ?>/public/js/admin/tutor.js"></script>



<section class="home" id="home">
    <p></p>
    <p></p>
    <p></p>
    <p></p>

    <div class="tutor-profile-page">
        <div class="top-details-box">
            <div class="tutor-details">
                <div class="profile-picture">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="name-actions">
                    <div class="name">
                        <h1>Viraj Sandakelum<span>(Tutor)</span></h1><br>
                    </div>
                    <div class="actions">
                        <div class="button">
                            <a href="#" title="Show"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/show.png"></a>
                        </div>
                        <div class="button">
                            <a href="#" title="Hide"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/hide.png"></a>
                        </div>
                        <div class="button">
                            <a href="#" title="Block"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/block.png"></a>
                        </div>
                        <div class="button">
                            <a href="#" title="Unblock"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/unblock.png"></a>
                        </div>
                        <div class="button">
                            <a href="#" title="Chat"><img src="<?php echo URLROOT ?>/public/img/admin/student_tutor_profile/chat.png"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="class-summary">
                <div class="total-class">
                    <h1>Total Classes</h1>
                    <h2>10</h2>
                </div>
                <div class="pending-amount">
                    <h1>Pending Amount</h1>
                    <h2>Rs. 1000</h2>
                </div>
            </div>
        </div>


        <!--===================================== Tutor AVAILABLE TIME SLOTS========================= -->

        <div class="pop-time-table">
            <!-- <h1>Select time slots</h1> -->

            <div class="time-table-container">
                <table id="time-table">
                    <tr class="time-table-titles">
                        <th id="">Monday</th>
                        <th id="">Tuesday</th>
                        <th id="">Time</th>
                        <th id="">Wednesday</th>
                        <th id="">Thursday</th>
                        <th id="">Friday</th>
                        <th id="">Satday</th>
                        <th id="">Sunday</th>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    <tr>
                        <th>8.00-10.00</th>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-selected"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-free"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                        <td class="slot slot-used"></td>
                    </tr>

                    </tr>
                </table>

                <div class="color-introduce">
                    <table id="time-table">
                        <tr>
                            <td class="slot slot-used">Not Available</td>
                            <td class="slot slot-free">Available</td>
                            <td class="slot slot-selected">In Work</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>



        <div class="3-filed-section">
            <div class="filed-selection-btn">
                <div class="info-btn">
                    <button>Tutor Info</button>
                </div>
                <div class="active-class-btn">
                    <button>Active Class</button>
                </div>
                <div class="finished-class-btn">
                    <button>Finished Class</button>
                </div>
            </div>
        </div>


        <div class="tutor-info">
            <div class="section-1">
                <div class="first-name">
                    <h1>First Name: </h1>
                    <h2>Viraj</h2>
                </div>
                <div class="letter-box-number">
                    <h1>Letter Box Number: </h1>
                    <h2>123</h2>
                </div>
                <div class="city">
                    <h1>City: </h1>
                    <h2>Colombo</h2>
                </div>
                <div class="tel-number">
                    <h1>Tel Number: </h1>
                    <h2>0771234567</h2>
                </div>
                <div class="medium">
                    <h1>Medium: </h1>
                    <h2>Sinhala</h2>
                </div>
            </div>

            <div class="section-2">
                <div class="last-name">
                    <h1>Last Name: </h1>
                    <h2>Sandakelum</h2>
                </div>
                <div class="street">
                    <h1>Street: </h1>
                    <h2>Colombo</h2>
                </div>
                <div class="year-of-exam">
                    <h1>Year of Exam: </h1>
                    <h2>2021</h2>
                </div>
                <div class="gender">
                    <h1>Gender : </h1>
                    <h2>Male</h2>
                </div>
                <div class="preferred-class-mode">
                    <h1>Preferred Class Mode: </h1>
                    <h2>Online</h2>
                </div>
            </div>
        </div>



        <div class="active-classes">

            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>

            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>

            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>


            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>


            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>

        </div>


        <div class="finished-classes">

            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>


            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>



            <div class="one-class">
                <div class="tutor-profile">
                    <img src="<?php echo URLROOT ?>/public/img/admin/profile.png">
                </div>
                <div class="class-details">
                    <div class="tutor-name">
                        <h1>Tutor: </h1>
                        <h2>Viraj Sandakelum</h2>
                    </div>
                    <div class="subject">
                        <h1>Subject: </h1>
                        <h2>Maths</h2>
                    </div>
                    <div class="lessson">
                        <h1>Lesson: </h1>
                        <h2>Lesson 1</h2>
                    </div>
                    <div class="day">
                        <h1>Day: </h1>
                        <h2>Monday</h2>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>


</body>

</html>