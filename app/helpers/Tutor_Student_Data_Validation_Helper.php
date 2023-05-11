<?php

function validateName(string $name): String
{
    if (empty($name) || !preg_match("/^[a-zA-Z]*$/", $name)) {
        return 'Please enter a valid name';
    } elseif (strlen($name) > 255) {
        return 'Name should have less than 255 characters ';
    } else {
        return '';
    }
}


function validateAccountName(string $name): String
{
    if (empty($name) || !preg_match("/^[a-zA-Z]*$/", $name)) {
        return 'Please enter a valid name';
    } elseif (strlen($name) > 50 && strlen($name) > 0) {
        return 'Account Name should have less than 50 characters and more than 2 characters ';
    } else {
        return '';
    }
}


function validateAccountNumber(String $number, String $bank, ModelTutorPending $modelObject, bool $isUnique = true): String
{
    if (empty($number) || !preg_match("/^[0-9]*$/", $number)) {
        return 'Please enter a valid Account Number';
    } elseif (!(strlen($number) > 6) && !(strlen($number) < 14)) {
        return 'Please enter a valid account number ';
    } elseif ($isUnique && $modelObject->findUserByAccountNumber($number, $bank)) {
        return 'Account no. is already Entered';
    } else {
        return '';
    }
}

function validateAddressLines(string $addressLine, bool $isMandatory = false): String
{


    if ($isMandatory && empty($addressLine)) {
        return 'Please enter a valid Address Line';
    } elseif (strlen($addressLine) > 255) {
        return 'Address Line should have less than 255 characters ';
    } else {
        return '';
    }
}


function validateCity(string $city): String
{
    if (empty($city) || !preg_match("/^[a-zA-Z0-9\s]+$/", $city)) {
        return 'Please enter a valid city';
    } elseif (strlen($city) > 255) {
        return 'City should have less than 255 characters ';
    } else {
        return '';
    }
}

function validateDistrict(string $district): String
{
    if (empty($district) || !preg_match("/^[a-zA-Z0-9\s]+$/", $district)) {
        return 'Please enter a valid District';
    } elseif (strlen($district) > 255) {
        return 'District should have less than 255 characters ';
    } else {
        return '';
    }
}

function validateYearOfExam(String $year): String
{
    $yearNumber = intval($year);

    if (empty($year) || $yearNumber == 0) {
        return 'Please enter an exam year';
    } elseif ($yearNumber < 2020) {
        return 'Exam year should be after 2020';
    } elseif ($yearNumber > 2030) {
        return 'Exam year should be before 2030';
    } else {
        return '';
    }
}

function validateTelephoneNumber(String $telephone, ModelTutorStudentCompleteProfile $modelObject, bool $isUnique = true): String
{
    if (empty($telephone) || !preg_match("/^[0-9]*$/", $telephone)) {
        return 'Please enter a valid telephone no.';
    } elseif (strlen($telephone) !== 10) {
        return 'Telephone no. should have  10 characters ';
    } elseif ($isUnique && $modelObject->findUserByTelephoneNumber($telephone)) {
        return 'Telephone no. is already in use';
    } else {
        return '';
    }
}

function validateFilePath(String $filePath, String $messageOnError): String
{
    if (empty($filePath)) {
        return $messageOnError;
    } else {
        return '';
    }
}


function validateDescription(String $description): String
{
    if (strlen($description) >= 100) {
        return 'Bio should have less than 1000 characters';
    } else {
        return '';
    }
}

function validateUniversity(String $university): String
{
    if (empty($university) || !preg_match("/^[a-zA-Z\s]*$/", $university)) {
        return 'Please enter a valid University';
    } elseif (strlen($university) > 255) {
        return 'University should have less than 255 characters ';
    } else {
        return '';
    }
}


function validatePassword(string $password, string $confirmPassword): String
{
    if (empty($password)) {
        return 'Please enter a valid password';
    } elseif (strlen($password) < 4) {
        return 'Password should be minimum 4 characters long';
    } elseif ($password !== $confirmPassword) {
        return 'Please confirm the password';
    } else {
        return '';
    }
}


// *******************  START - created by madusharini (For tutor profile update validation) ********************


function validateRate(string $number): String
{
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

function validateAccountNameForTutor(String $holderName, ModelTutorStudentCompleteProfile $modelObject, int $tutor_id): String
{
    if (empty($holderName) || !preg_match("/^[a-zA-Z\s]*$/", $holderName)) {
        return 'Please enter a valid Account Name';
    } elseif ($modelObject->findUserByAccountHolderNameForTutor($holderName, $tutor_id)) {
        return 'Account Holder Name is already in use';
    } elseif (strlen($holderName) > 255) {
        return 'Account Name should have less than 255 characters ';
    } else {
        return '';
    }
}



function validateAccountNumberForTutor(String $accountNumber, ModelTutorStudentCompleteProfile $modelObject, int $tutor_id): String
{
    if (empty($accountNumber) || !preg_match("/^[0-9]*$/", $accountNumber)) {
        return 'Please enter a valid Account Number';
    } elseif ($modelObject->findUserByAccountNumberForTutor($accountNumber, $tutor_id)) {
        return 'Account Number is already in use';
    } else {
        return '';
    }
}



function validateTelephoneNumberForTutor(String $telephone, ModelTutorStudentCompleteProfile $modelObject, int $tutor_id): String
{
    if (empty($telephone) || !preg_match("/^[0-9]*$/", $telephone)) {
        return 'Please enter a valid telephone no.';
    } elseif (strlen($telephone) !== 10) {
        return 'Telephone no. should have  10 characters ';
    } elseif ($modelObject->findUserByTelephoneNumberForTutor($telephone, $tutor_id)) {
        return 'Telephone no. is already in use';
    } else {
        return '';
    }
}


function validateBankName(String $bankName): String
{
    if (empty($bankName) || !preg_match("/^[a-zA-Z\s]*$/", $bankName)) {
        return 'Please enter a valid Bank Name';
    } elseif (strlen($bankName) > 255) {
        return 'Bank Name should have less than 255 characters ';
    } else {
        return '';
    }
}


function validateBranch(String $branch): String
{
    if (empty($branch) || !preg_match("/^[a-zA-Z\s]*$/", $branch)) {
        return 'Please enter a valid Branch';
    } elseif (strlen($branch) > 255) {
        return 'Branch should have less than 255 characters ';
    } else {
        return '';
    }
}


// *******************  END - created by madusharini (For tutor profile update validation) ********************



// created by viraj

function validateTutorReportReason(String $reason, ModelTutorStudentCompleteProfile $modelObject): String
{
    if (empty($reason) || strlen($reason) < 3) {
        return 'Please enter a valid reason';
    } elseif ($modelObject->findReasonIdByTutorReportReason($reason)) {
        return 'Reason is already in use';
    } else if (strlen($reason) > 40) {
        return 'Reason should have less than 40 characters';
    } else {
        return '';
    }
}


function validateStudentReportReason(String $reason, ModelTutorStudentCompleteProfile $modelObject): String
{
    if (empty($reason) || strlen($reason) < 3) {
        return 'Please enter a valid reason';
    } elseif ($modelObject->findReasonIdByStudentReportReason($reason)) {
        return 'Reason is already in use';
    } else if (strlen($reason) > 40) {
        return 'Reason should have less than 40 characters';
    } else {
        return '';
    }
}





