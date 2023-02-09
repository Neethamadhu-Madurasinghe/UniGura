<?php

class MainNavbar {
    public static function render(Request $request): void {
        echo '
            <div class="nav-bar-container">
                <div class="student-nav-bar">
                    <div class="logo-container">
                        <a href="' . URLROOT . '/student/dashboard' . '">
                            <img src="' . URLROOT . '/public/img/common/logo.png' . '" alt="" srcset="" class="nav-logo">
                        </a>

        
                        <div class="profile-picture">
                            <img
                            src="' . URLROOT . $request->getUserPicture() . '"
                            alt="" class="profile-picture-img">
                            <div class="profile-menu profile-menu-hidden">
                                <a href="' . URLROOT . '/student/profile' . '">Profile</a>
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
