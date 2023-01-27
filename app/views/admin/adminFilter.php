<?php

$filterResult = [];
$pageContent = [];

$classConductMode = [];
$classFees = [];
$selectedSubject = [];
$selectedRating = [];
$searchResult = '';

// echo '<pre>';
// print_r($data);
// echo '</pre>';

if (isset($_GET['classConductModeValue'])) {
    $classConductMode = $_GET['classConductModeValue'];
    $classConductMode = explode(',', $classConductMode);
    $classConductMode = array_filter($classConductMode);
    $classConductMode = array_values($classConductMode);

    // echo '<pre>';
    // print_r($classConductMode);
    // echo '</pre>';
}


if (isset($_GET['classFeesInputField'])) {
    $classFees = $_GET['classFeesInputField'];
    $classFees = explode(',', $classFees);
    $classFees = array_filter($classFees);
    $classFees = array_values($classFees);

    // echo '<pre>';
    // print_r($classFees);
    // echo '</pre>';
}


if (isset($_GET['selectedSubject'])) {
    $selectedSubject = $_GET['selectedSubject'];
    $selectedSubject = explode(',', $selectedSubject);
    $selectedSubject = array_filter($selectedSubject);
    $selectedSubject = array_values($selectedSubject);

    // echo '<pre>';
    // print_r($selectedSubject);
    // echo '</pre>';
}


if (isset($_GET['selectedRating'])) {
    $selectedRating = $_GET['selectedRating'];
    $selectedRating = explode(',', $selectedRating);
    $selectedRating = array_filter($selectedRating);
    $selectedRating = array_values($selectedRating);

    // echo '<pre>';
    // print_r($selectedRating);
    // echo '</pre>';
}

if (isset($_GET['searchResult'])) {
    $searchResult = $_GET['searchResult'];

    // echo '<pre>';
    // print_r($searchResult);
    // echo '</pre>';
}




if (!empty($searchResult)) {
    foreach ($data as $aClass) {
        if (str_contains(strtolower($aClass->tutor->first_name), strtolower($searchResult)) || str_contains(strtolower($aClass->tutor->last_name), strtolower($searchResult))) {
            array_push($filterResult, $aClass);
        }else{
            $index = array_search($aClass, $data);
            array_splice($data, $index, 1);
        }
    }
}



if (!empty($classConductMode)) {
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode)) {
            array_push($filterResult, $aClass);
        } else {
            $index = array_search($aClass, $data);
            array_splice($data, $index, 1);
        }
    }
}




if (!empty($classFees)) {
    foreach ($data as $aClass) {
        if ($aClass->classTemplate->session_rate <= $classFees[0]) {
            array_push($filterResult, $aClass);
        } else {
            $index = array_search($aClass, $data);
            array_splice($data, $index, 1);
        }
    }
}


if (!empty($selectedSubject)) {
    foreach ($data as $aClass) {
        if (in_array($aClass->subject->name, $selectedSubject)) {
            array_push($filterResult, $aClass);
        } else {
            $index = array_search($aClass, $data);
            array_splice($data, $index, 1);
        }
    }
}



if (!empty($selectedRating)) {
    foreach ($data as $aClass) {
        if (in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            array_push($filterResult, $aClass);
        } else {
            $index = array_search($aClass, $data);
            array_splice($data, $index, 1);
        }
    }
}



$filterResult = $data;

$pageContent = array_unique($filterResult, SORT_REGULAR);
$pageContent = array_values($pageContent);


// echo '<pre>';
// print_r($pageContent);
// echo '</pre>';

?>


<?php foreach ($pageContent as $aClass) { ?>
    <div class="one-class">
        <div class="tutor">
            <div class="profile-img">
                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
            </div>
            <div class="name">
                <h1>Tutor Name</h1>
                <h1><?php echo $aClass->tutor->first_name . ' ' . $aClass->tutor->last_name ?></h1>
            </div>
        </div>
        <div class="student">
            <div class="name">
                <h1>Student Name</h1>
                <h1><?php echo $aClass->student->first_name . ' ' . $aClass->student->last_name ?></h1>
            </div>
            <div class="profile-img">
                <img src="<?php echo URLROOT ?>/public/img/admin/profile.png" alt="">
            </div>
        </div>
        <div class="class-details">
            <div class="subject">
                <h1>Subject: <?php echo $aClass->subject->name ?></h1>
            </div>
            <div class="module">
                <h1>Module: <?php echo $aClass->module->name ?></h1>
            </div>
            <div class="day">
                <h1>Day: <?php echo $aClass->classDay->title ?></h1>
            </div>
        </div>
    </div>
<?php } ?>