<?php
class LandingPageNavBar {
    private Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function render(): void {
        echo '
            <div class="student-nav-bar">
                <div class="logo-container">
                    <img src="'. URLROOT . '/public/img/logo.png' .'" alt="" srcset="" class="nav-logo">
                </div>
                <div class="nav-link-container-container">
                    <div class="nav-bar-link-container">
        ';
        if ($this->request->getPath() === 'student/register') {
            echo '
                  <a href="' . URLROOT . '/login'  . '">Login</a>
                  <a href="' . URLROOT . '/tutor/register' . '">Become a tutor</a>
                  <a href="#">About us</a>
                  ';

        }elseif ($this->request->getPath() === 'tutor/register') {
            echo '
                  <a href="' . URLROOT . '/login'  . '">Login</a>
                  <a href="' . URLROOT . '/student/register' . '">Become a Student</a>
                  <a href="#">About us</a>
                  ';

        }elseif ($this->request->getPath() === 'login') {
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