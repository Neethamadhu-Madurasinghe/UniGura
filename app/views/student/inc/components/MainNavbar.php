<?php

class MainNavbar {
    public static function render(Request $request): void {
        echo '
            <div class="student-nav-bar">
                <div class="logo-container">
                    <a href="' . URLROOT . '/student/dashboard' . '">
                        <img src="' . URLROOT . '/public/img/common/logo.png' . '" alt="" srcset="" class="nav-logo">
                    </a>
                </div>
                
                <div class="nav-link-container-container">
                    <div class="nav-bar-link-container">
                        <a href="#about">
                            <div class="icon">
                                <img src="' . URLROOT . '/public/img/student/bell.png' . '" alt=""> <span>17</span>
                            </div>
                        </a>
        
                        <div class="profile-picture">
                            <img
                            src="' . URLROOT . MainNavbar::getStudentProfilePicture($request) . '"
                            alt="" class="profile-picture-img">
                            <div class="profile-menu profile-menu-hidden">
                                <a href="#g">Profile</a>
                                <a href="' . URLROOT . '/logout' . '">Logout</a>
                            </div>
                        </div>
        
                    </div>
                </div>
            </div>
        ';
    }

    private static function getStudentProfilePicture(Request $request) {
        $img = $request->getUserPicture();

        if ($img) {
            return $img;
        }else {
            return '/public/img/student/profile.png';
        }
    }
}