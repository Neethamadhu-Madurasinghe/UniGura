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
                                <div class="icon notification-dropdown">
                                    <img src="' . URLROOT . '/public/img/student/bell.png' . '" alt=""> <span>17</span>
                                    <div class="notification-list">
                                      <ul>
                                        <li>
                                            <a href="#">
                                              <div class="notification-card">
                                                <h3>Your account has been suspended</h3>
                                                <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.</p>
                                                <p class="time">2 hourse ago</p>
                                              </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                              <div class="notification-card">
                                                <h3>Your account has been suspended</h3>
                                                <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.</p>
                                                <p class="time">2 hourse ago</p>
                                              </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                              <div class="notification-card">
                                                <h3>Your account has been suspended</h3>
                                                <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, ab.</p>
                                                <p class="time">2 hourse ago</p>
                                              </div>
                                            </a>
                                        </li>
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
