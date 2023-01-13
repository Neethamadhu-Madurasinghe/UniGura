<?php

$filterResult = [];
$pageContent = [];

$classConductMode = [];
$classFees = [];
$selectedSubject = [];
$selectedRating = [];

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



if (!empty($classConductMode) && !empty($classFees) && !empty($selectedSubject) && !empty($selectedRating)) {
    // echo "classConductModeValue, classFeesInputField, selectedSubject and selectedRating is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && ($aClass->classTemplate->session_rate <= $classFees[0]) && in_array($aClass->subject->name, $selectedSubject) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode) && !empty($classFees) && !empty($selectedRating)) {
    // echo "classConductModeValue, classFeesInputField and selectedRating is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && ($aClass->classTemplate->session_rate <= $classFees[0]) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode) && !empty($selectedSubject) && !empty($selectedRating)) {
    // echo "classConductModeValue, selectedSubject and selectedRating is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && in_array($aClass->subject->name, $selectedSubject) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classFees) && !empty($selectedSubject) && !empty($selectedRating)) {
    // echo "classFeesInputField, selectedSubject and selectedRating is set";
    foreach ($data as $aClass) {
        if (($aClass->classTemplate->session_rate <= $classFees[0]) && in_array($aClass->subject->name, $selectedSubject) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode) && !empty($classFees) && !empty($selectedSubject)) {
    // echo "classConductModeValue, classFeesInputField and selectedSubject is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && ($aClass->classTemplate->session_rate <= $classFees[0]) && in_array($aClass->subject->name, $selectedSubject)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode) && !empty($classFees)) {
    // echo "classConductModeValue and classFeesInputField is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && ($aClass->classTemplate->session_rate <= $classFees[0])) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode) && !empty($selectedSubject)) {
    // echo "classConductModeValue and selectedSubject is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && in_array($aClass->subject->name, $selectedSubject)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classFees) && !empty($selectedSubject)) {
    // echo "classFeesInputField and selectedSubject is set";
    foreach ($data as $aClass) {
        if (($aClass->classTemplate->session_rate <= $classFees[0]) && in_array($aClass->subject->name, $selectedSubject)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode) && !empty($selectedRating)) {
    // echo "classConductModeValue and selectedRating is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classFees) && !empty($selectedRating)) {
    // echo "classFeesInputField and selectedRating is set";
    foreach ($data as $aClass) {
        if (($aClass->classTemplate->session_rate <= $classFees[0]) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($selectedSubject) && !empty($selectedRating)) {
    // echo "selectedSubject and selectedRating is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->subject->name, $selectedSubject) && in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classConductMode)) {
    // echo "classConductModeValue is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->mode, $classConductMode)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($classFees)) {
    // echo "classFeesInputField is set";
    foreach ($data as $aClass) {
        if ($aClass->classTemplate->session_rate <= $classFees[0]) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($selectedSubject)) {
    // echo "selectedSubject is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->subject->name, $selectedSubject)) {
            $filterResult[] = $aClass;
        }
    }
} else if (!empty($selectedRating)) {
    // echo "selectedRating is set";
    foreach ($data as $aClass) {
        if (in_array($aClass->classTemplate->rating_count, $selectedRating)) {
            $filterResult[] = $aClass;
        }
    }
} else {
    // echo "Nothing is set";
    $filterResult = $data;
}


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