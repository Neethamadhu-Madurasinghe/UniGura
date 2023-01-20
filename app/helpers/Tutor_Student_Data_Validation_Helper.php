<?php

function validateName(string $name): String {
    if (empty($name) || !preg_match("/^[a-zA-Z]*$/", $name)) {
        return 'Please enter a valid name';

    }elseif (strlen($name) > 255) {
        return 'Name should have less than 255 characters ';

    }else {
        return '';
    }
}

function validateLetterBoxNumber(string $number): String {
    if (empty($number) || !preg_match("/^[a-zA-Z0-9-\/\s]*$/", $number)) {
        return 'Please enter a valid number';

    }elseif (strlen($number) > 255) {
        return 'Number should have less than 255 characters ';

    }else {
        return '';
    }
}

function validateStreet(string $street): String {
    if (empty($street) || !preg_match("/^[a-zA-Z-\s]*$/", $street)) {
        return 'Please enter a valid street name';

    }elseif (strlen($street) > 255) {
        return 'Street name should have less than 255 characters ';

    }else {
        return '';
    }
}

function validateCity(string $city): String {
    if (empty($city) || !preg_match("/^[a-zA-Z\s]*$/", $city)) {
        return 'Please enter a valid city';

    }elseif (strlen($city) > 255) {
        return 'City should have less than 255 characters ';

    }else {
        return '';
    }
}

function validateYearOfExam(String $year): String {
    $yearNumber = intval($year);

    if (empty($year) || $yearNumber == 0) {
        return 'Please enter an exam year';

    }elseif ($yearNumber < 2020) {
        return 'Exam year should be after 2020';

    }elseif ($yearNumber > 2030) {
        return 'Exam year should be before 2030';

    }else {
        return '';
    }
}

function validateTelephoneNumber(String $telephone, ModelTutorStudentCompleteProfile $modelObject): String {
    if (empty($telephone) || !preg_match("/^[0-9]*$/", $telephone)) {
        return 'Please enter a valid telephone no.';

    }elseif (strlen($telephone) !== 10) {
        return 'Telephone no. should have  10 characters ';

    }elseif ($modelObject->findUserByTelephoneNumber($telephone)) {
        return 'Telephone no. is already in use';

    }else {
        return '';
    }
}

function validateFilePath(String $filePath, String $messageOnError): String {
    if (empty($filePath)) {
        return $messageOnError;

    }else {
        return '';
    }
}

function validateDescription(String $description): String {
    if (strlen($description) >= 100) {
        return 'Bio should have less than 1000 characters';

    }else {
        return '';
    }
}

function validateUniversity(String $university): String {
    if (empty($university) || !preg_match("/^[a-zA-Z\s]*$/", $university)) {
        return 'Please enter a valid University';

    }elseif (strlen($university) > 255) {
        return 'University should have less than 255 characters ';

    }else {
        return '';
    }
}


?>