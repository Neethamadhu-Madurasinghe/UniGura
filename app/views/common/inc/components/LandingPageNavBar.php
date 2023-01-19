<?php
class LandingPageNavBar {
    public static function render(Request $request): void {
        echo '
            <div class="student-nav-bar">
                <div class="logo-container">
                    <img src="'. URLROOT . '/public/img/common/logo.png' .'" alt="" srcset="" class="nav-logo">
                </div>
                <div class="nav-link-container-container">
                    <div class="nav-bar-link-container">
        ';
        if ($request->getPath() === 'student/register') {
            echo '
                  <a href="' . URLROOT . '/login'  . '">Login</a>
                  <a href="' . URLROOT . '/tutor/register' . '">Become a tutor</a>
                  <a href="#">About us</a>
                  ';

        }elseif ($request->getPath() === 'tutor/register') {
            echo '
                  <a href="' . URLROOT . '/login'  . '">Login</a>
                  <a href="' . URLROOT . '/student/register' . '">Become a Student</a>
                  <a href="#">About us</a>
                  ';

        }elseif ($request->getPath() === 'login') {
            echo '
                <a href="' . URLROOT . '/student/register' . '">Become a Student</a>
                <a href="' . URLROOT . '/tutor/register' . '">Become a tutor</a>
                <a href="#">About us</a>
                ';

        }else {
            echo '
                  <a href="' . URLROOT . '/login'  . '">Login</a>
                  <a href="' . URLROOT . '/student/register' . '">Become a Student</a>
                  <a href="' . URLROOT . '/tutor/register' . '">Become a tutor</a>
                  <a href="#">About us</a>
                  ';
        }

        echo '
                    </div>
                </div>
              </div>
        ';
    }
}

?>