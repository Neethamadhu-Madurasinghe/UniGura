<?php

class TutoringClassCard {
    public static function render($data): void {
        if (!$data['tutor']['profile_picture']) {
            $data['tutor']['profile_picture'] = '/public/img/common/profile.png';
        }

        if ($data['day_count'] > 0) {
            $data['completion'] = round($data['incomplete_day_count'] * 100 / $data['day_count']);
        }else {
            $data['completion'] = 0;
        }

        $data["class_type"] = ucfirst($data["class_type"]);

        echo '
        <div class="class-card">
            <div class="class-card-top-section">
                <h2>' . $data["module"]["name"] . ' ' . $data["class_type"] . '</h2>
                <h4>' . $data["subject"]["name"] . '</h4>
            </div>
            <div class="class-card-bottom-section">
                <div class="name-row">
                    <div class="class-card-profile-picture-container">
                        <img src="' . URLROOT . $data["tutor"]["profile_picture"] . '" alt="" srcset="">
                    </div>
                    <p>' . $data["tutor"]["first_name"] . ' ' . $data["tutor"]["last_name"] . '</p>
                     <div class="class-card-payment-due-container">
                        <img
                        src="' . URLROOT . "/public/img/common/money 1.png" . '"
                        class="' . ($data["payment_due_day_count"] > 0 ?
                                    "payment-due-image" :
                                    "payment-due-image-hidden") .'">
                     </div>
                </div>
                
                <div class="progress-bar-row">
                    <p>' . $data['completion'] . '%</p>
                    <div class="progress-bar-outer">
                        <div class="progress-bar-inner" style="width: ' . $data['completion'] . '%"></div>
                    </div>
                </div>
                <button class="btn btn-enter-class">Enter</button>
            </div>
        </div>';
    }
}

