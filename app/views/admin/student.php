<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/401cc96be7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/admin/student.css">
    <script defer src="../class/main.js"></script>
    <title>Document</title>
</head>

<body>

    <?php
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    ?>

    <div class="student-page">

        <div class="card-section">
            <?php foreach ($data as $aStudent) : ?>
                <div class="card">
                    <div class="profile-picture">
                        <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="student profile picture">
                    </div>
                    <div class="name">
                        <h2><?php echo $aStudent->student->first_name . ' ' . $aStudent->student->last_name ?></h2>
                    </div>
                    <div class="info">
                        <h5>Phone: <?php echo $aStudent->student->phone_number ?></h5>
                        <h5>Exam Year: <?php echo $aStudent->year_of_exam ?></h5>
                    </div>
                    <div class="view-profile">
                        <a href="viewStudentProfile?studentID=<?php echo $aStudent->user_id ?>"><button class="view-student-profile-btn">View Profile</button></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="filter-selection">

            <div class="total-student">
                <!-- <h1>15</h1> -->
            </div>

            <div class="search">
                <div class="search-bar">
                    <div class="icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="input">
                        <input type="text" placeholder="Search for Class">
                    </div>
                </div>
            </div>


            <div class="filter-functions">
                <div class="search-btn">
                    <button><i class="fas fa-search"></i>Find</button>
                </div>
                <div class="filter-btn">
                    <button id="filter"><i class="fas fa-filter"></i>Filter</button>
                </div>
                <div class="reset-btn">
                    <button id="filter-reset-btn"><i class="fas fa-redo"></i>Reset</button>
                </div>
            </div>


            <div class="subject-filter">
                <div class="subject">
                    <h1>By Subject</h1>
                </div>
                <div class="subject-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="maths" name="subject" value="maths">
                        <label for="maths">Maths</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="science" name="subject" value="science">
                        <label for="science">Science</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="english" name="subject" value="english">
                        <label for="english">English</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="history" name="subject" value="history">
                        <label for="history">History</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="other" name="subject" value="all">
                        <label for="other">All</label>
                    </div>
                </div>
            </div>


            <div class="mode-filter">
                <div class="mode">
                    <h1>By Mode</h1>
                </div>
                <div class="mode-select">
                    <div class="radio-button">
                        <input type="radio" id="online" name="mode" value="online">
                        <label for="online">Online</label>
                    </div>
                    <div class="radio-button">
                        <input type="radio" id="offline" name="mode" value="offline">
                        <label for="offline">Offline</label>
                    </div>
                    <div class="radio-button">
                        <input type="radio" id="offline" name="mode" value="both">
                        <label for="offline">Both</label>
                    </div>
                </div>
            </div>


            <div class="visibility-filter">
                <div class="duration">
                    <h1>By Visibility</h1>
                </div>
                <div class="visibility-select">
                    <div class="checkbox-button">
                        <input type="checkbox" id="other" name="subject" value="all">
                        <label for="other">Show</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="other" name="subject" value="all">
                        <label for="other">Hide</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="other" name="subject" value="all">
                        <label for="other">Unblock</label>
                    </div>
                    <div class="checkbox-button">
                        <input type="checkbox" id="other" name="subject" value="all">
                        <label for="other">Block</label>
                    </div>
                </div>
            </div>

        </div>

    </div>



    </div>


</body>

</html>