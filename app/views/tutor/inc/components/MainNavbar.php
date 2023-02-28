<?php

class MainNavbar
{
    public static function render(Request $request): void
    {
        echo '
        <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image"></span>

                <div class="text logo-text">
                    <span class="name">Uniගුරා</span>
                    <span class="profession">Tutor Name</span>
                </div>
            </div>

            <i style="display:none;" class="fa-solid fa-chevron-right toggle"></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    <li title= "Chat" class="nav-link">
                        <a href="' . URLROOT . '/tutor/chat'  . '">
                            <i class="fa-regular fa-envelope icon"></i>
                            <span class="text nav-text">Messages</span>
                        </a>
                    </li>

                    <li title= "Notification" class="nav-link notify">
                        <a href="' . URLROOT . '/tutor/notifications'  . '">
                            <i class="fa-regular fa-bell icon"></i>
                            <span class="text nav-text ">Notifications</span>
                        </a>
                    </li>

                    <li title= "Dashboard" class="nav-link home">
                        <a href="' . URLROOT . '/tutor/dashboard'  . '">
                            <i class="fa-solid fa-house icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li title= "Payments"  class="nav-link">
                        <a  href="' . URLROOT . '/tutor/payments'  . '">
                            <i class="fa-solid fa-chart-line icon"></i>
                            <span class="text nav-text">Payments</span>
                        </a>
                    </li>

                    <li title= "Classes" class="nav-link myclass">
                        <a href="' . URLROOT . '/tutor/classes'  . '">
                            <i class="fa-solid fa-graduation-cap icon"></i>
                            <span class="text nav-text">Classes</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li title= "My profile" class="">
                <a href="' . URLROOT . '/tutor/update-profile'  . '">
                        <i class="fa-solid fa-user icon"></i>
                        <span class="text nav-text">User</span>
                    </a>
                </li>
                <li title= "Logout" class="">
                    <a  href="' . URLROOT . '/logout' . '">
                        <i class="fa-solid fa-right-from-bracket icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>

            </div>
        </div>
    </nav>   ';
    }

    private static function getStudentProfilePicture($id)
    {
        $tutorStudentAuth = new ModelTutorStudentAuth();
        $img = $tutorStudentAuth->getUserProfilePicture($id);
        if ($img) {
            return $img;
        } else {
            return '/public/img/student/profile.png';
        }
    }
}
