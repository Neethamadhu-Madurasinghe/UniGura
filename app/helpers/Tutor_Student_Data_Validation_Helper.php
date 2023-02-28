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

function validateAddressLines(string $addressLine, bool $isMandatory = false): String {

    if ($isMandatory && empty($addressLine)) {
        return 'Please enter a valid Address Line';

    }elseif (strlen($addressLine) > 255) {
        return 'Address Line should have less than 255 characters ';

    }else {
        return '';
    }
}


function validateCity(string $city): String {
    if (empty($city) || !preg_match("/^[a-zA-Z0-9\s]+$/", $city)) {
        return 'Please enter a valid city';

    }elseif (strlen($city) > 255) {
        return 'City should have less than 255 characters ';

    }else {
        return '';
    }
}

function validateDistrict(string $district): String {
    if (empty($district) || !preg_match("/^[a-zA-Z0-9\s]+$/", $district)) {
        return 'Please enter a valid District';

    }elseif (strlen($district) > 255) {
        return 'District should have less than 255 characters ';

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

function validateTelephoneNumber(String $telephone, ModelTutorStudentCompleteProfile $modelObject, bool $isUnique = true): String {
    if (empty($telephone) || !preg_match("/^[0-9]*$/", $telephone)) {
        return 'Please enter a valid telephone no.';

    }elseif (strlen($telephone) !== 10) {
        return 'Telephone no. should have  10 characters ';

    }elseif ($isUnique && $modelObject->findUserByTelephoneNumber($telephone)) {
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




//created by sachithra

function validateRate(string $number): String {
    if (filter_var($number, FILTER_VALIDATE_INT)) {
        $int = intval($number);
        if ($int >= 500 && $int < 5000) {
          return "";
        } else {
            return "Amount must in a range between LKR (500 - 5000)";
        }
      } else {
         return "Please enter a valid amount";
      }
}












?>