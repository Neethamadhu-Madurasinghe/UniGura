<?php

// Function to handle file upload - returns the path of newly uploaded file
function handleUpload(
    array $fileExtensions,
    string $destination,
    string $fieldName,
    string $fileName = ''
    ): array|bool|string {
    $destination = trim($destination, '\\');
    $destination = trim($destination, '/');

//  Normalize the given array of extensions -  [ .jpg, .png, .gif ]
    $fileExtensions = array_map(function ($fileExtension) {
        $givenFileExtensionTrimmed = trim($fileExtension, '.');
        $fileExtension = '.' . strtolower($givenFileExtensionTrimmed);
        return $fileExtension;
    }, $fileExtensions);


    if (isset($_FILES[$fieldName])) {
        $defaultFileName = $_FILES[$fieldName]['name'];
        $fileSize = $_FILES[$fieldName]['size'];
        $fileTemp = $_FILES[$fieldName]['tmp_name'];

//       Identify the extension of uploaded file
        $defaultFileNameExploded = explode('.', $defaultFileName);
        $fileExt = '.' . strtolower(end($defaultFileNameExploded));

//      only upload if file size is greater than 0 and has a valid file extension and does not have errors
        if ($fileSize > 0 && in_array($fileExt, $fileExtensions)) {
            $fileName = $fileName ?: generateRandomName();
            $fileName = explode('.', $fileName)[0];
            $file = ROOT . "\\$destination\\" . $fileName . $fileExt;

            move_uploaded_file($fileTemp, $file);

//          File paths is similar to C:\xampp\htdocs\mvc2\public\img\16696224274224.jpeg
//          But returned value should be /public/img/16696224274224.jpeg
            $file = str_replace(ROOT, '.', $file);
            $file = str_replace('\\', '/', $file);
            return $file;

        }else {
            return false;
        }

    }else {
        return false;
    }
}

function generateRandomName(): string {
    return time() . rand(1000, 9999);
}