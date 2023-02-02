<?php

class Request {
//    Get the path of the request URL - default '/' - eg :- /example_auth?id=1
    public function getPath() {
        $path = $_GET['url'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method(): string{
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): string {
        return $this->method() === 'get';
    }

    public function isPost(): string {
        return $this->method() === 'post';
    }



//    Get the body contents of both GET and POST requests, sanitize them and return
    public function getBody(): array {
        $body = [];

        if ($this->method() == 'get') {
            foreach ($_GET as $key => $value) {
                if ($key !== 'url') {
                    $body[$key] = trim(filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS));
                }
            }
        }

        if ($this->method() == 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = trim(filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS));
            }
        }

        return $body;
    }


//    Get session details
    public function getUserId() {
        if ($this->isLoggedIn()) {
            return $_SESSION['user_id'];
        }else {
            return false;
        }
    }

    //    Get session details
    public function getUserName() {
        if ($this->isLoggedIn()) {
            return $_SESSION['user_name'];
        }else {
            return false;
        }
    }

    //    Get session details
    public function getUserEmail() {
        if ($this->isLoggedIn()) {
            return $_SESSION['user_email'];
        }else {
            return false;
        }
    }

    //  Get profile picture
    public function getUserPicture() {
        if ($this->isLoggedIn() && ($this->isStudent() || $this->isTutor())) {
            return $_SESSION['user_picture'];
        }else {
            return false;
        }
    }

//  If user_id is set, then check LAST_ACTIVITY is set
//  If LAST_ACTIVITY is set, then check whether it is expired
//  If LAST_ACTIVITY is not set, then it remember is set to true

    public function isLoggedIn(): bool {
        if (isset($_SESSION['user_id'])) {
            if (isset($_SESSION['LAST_ACTIVITY'])) {
                if (time() - $_SESSION['LAST_ACTIVITY'] < 3600) {
                    session_regenerate_id(true);
                    $_SESSION['LAST_ACTIVITY'] = time();
                    return true;

                }else {
                    session_unset();
                    session_destroy();
                    return false;
                }
            }else {
                return true;
            }
        }else {
            return false;
        }
    }

//    Methods to identify user role

    /**
     * 0 - Admin
     * 1 - Valid tutor
     * 2 - Valid student
     * 3 - Tutor, but has not validated his email
     * 4 - Student, but has not validated his email
     * 5 - Tutor, but has not completed his personal details
     * 6 - Student, but has not completed his personal details
     * 7-  Tutor aproved, but has not completed bank details
     * 9 - Tutor had to complete bank details
     * 
     * 
     * 
     * 7- Tutor not approved
     * 8- Tutor aproved
     * 9- Tutor hasn't complete bank details
     */
    public function isAdmin(): bool {
        return $_SESSION['user_role'] === 0;
    }


    public function isAnyTutor(): bool {
        return $_SESSION['user_role'] === 1 || $_SESSION['user_role'] === 3
            || $_SESSION['user_role'] === 5 || $_SESSION['user_role'] === 7;
    }

    public function isAnyStudent(): bool {
        return $_SESSION['user_role'] === 2 || $_SESSION['user_role'] === 4 || $_SESSION['user_role'] === 6;
    }


    public function isTutor(): bool {
        return $_SESSION['user_role'] === 1;
    }

    public function isStudent(): bool {
        return $_SESSION['user_role'] === 2;
    }

    public function isEmailNotValidatedTutor(): bool {
        return $_SESSION['user_role'] === 3;
    }

    public function isEmailNotValidatedStudent(): bool {
        return $_SESSION['user_role'] === 4;
    }

    public function isProfileNotCompletedTutor(): bool {
        return $_SESSION['user_role'] === 5;
    }

    public function isProfileNotCompletedStudent(): bool {
        return $_SESSION['user_role'] === 6;
    }

    public function isNotApprovedTutor(): bool {
        return $_SESSION['user_role'] === 7;
    }

    // public function isQualificationNotCompletedTutor(): bool {
    //     return $_SESSION['user_role'] === 9;
    // }

    public function isBankDetialsNotCompletedTutor(): bool {
        return $_SESSION['user_role'] === 9;
    }


    public function isApprovedTutor():bool{
        return $_SESSION['user_role'] === 8;
    }
    

}
