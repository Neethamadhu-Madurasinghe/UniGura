<?php
class LandingPageNavBar {

    public function render(): void {
        echo '
            <div class="student-nav-bar">
                <div class="logo-container">
                    <img src="'. URLROOT . '/public/img/logo.png' .'" alt="" srcset="" class="nav-logo">
                </div>
                <div class="nav-link-container-container">
                    <div class="nav-bar-link-container">
                        <a href="' . URLROOT . '/login'  . '">Login</a>
                        <a href="' . URLROOT . '/student/register' . '">Become a Student</a>
                        <a href="' . URLROOT . '/tutor/register' . '">Become a tutor</a>
                        <a href="#">About us</a>
                    </div>
                </div>
            </div>
        ';
    }
}

?>