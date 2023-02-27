<?php

class IntermediateNavBar {
    public static function render(Request $request): void
    {
        echo '
            <div class="intermediate-nav-bar">
                <div class="logo-container">
                    <img src="' . URLROOT . '/public/img/common/logo.png' . '" alt="" srcset="" class="nav-logo">
                </div>
                <div class="nav-link-container-container">
                    <div class="nav-bar-link-container">
                        <a href="' . URLROOT . '/logout' . '">Logout</a>
                    </div>
                </div>
              </div> 
              
              ';
    }
}