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
    public function isAdmin(): bool {
        return $_SESSION['user_role'] === 0;
    }

    public function isTutor(): bool {
        return $_SESSION['user_role'] === 1;
    }

    public function isStudent(): bool {
        return $_SESSION['user_role'] === 2;
    }

}