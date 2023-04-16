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

                    </div>
                    
                    <div class="nav-link-container-container">
                        <div class="nav-bar-link-container">
                        
                            <div class="icon">
                                <a href="' . URLROOT . '/student/chat' . '">
                                    <img src="' . URLROOT . '/public/img/student/email.png' . '" alt="" class="notification-bell-icon"> <span class="message-span no-notification">00</span>
                                </a>
                            </div>
                        
                           <div class="icon notification-dropdown">
                                <img src="' . URLROOT . '/public/img/student/bell.png' . '" alt="" class="notification-bell-icon"> <span class="notification-span no-notification">00</span>
                                <div class="notification-list">
                                    <ul id="notification-card-list">
                                        
                                    </ul>
                                </div>
                            </div>
            
                            <div class="profile-picture">
                                <img
                                src="' . URLROOT . MainNavbar::getStudentProfilePicture($request) . '"
                                alt="" class="profile-picture-img">
                                <div class="profile-menu profile-menu-hidden">
                                    <a href="' . URLROOT . '/student/profile' . '">Profile</a>
                                    <a href="' . URLROOT . '/logout' . '">Logout</a>
                                </div>
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
