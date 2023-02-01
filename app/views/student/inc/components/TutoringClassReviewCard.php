<?php

class TutoringClassReviewCard {
    public static function render(array $data): void {
//       Format data
        $data['profile_picture'] = $data['profile_picture'] ?: '/public/img/common/profile.png';

        echo '
        <div class="review-container">
            <div class="review-card">
                <div class="review-card-top-section">
                    <div class="review-card-image-container">
                        <img src="' . URLROOT . $data["profile_picture"] . '" alt="" srcset="">
                    </div>
                    <div class="review-card-title-container">
                        <h3>' . $data["first_name"] . ' ' . $data["last_name"] . '</h3>
                        <div>';

                        for($i = 0; $i < $data['rating']; $i++) {
                            echo '<i class="fa-solid fa-star"></i>';
                        }

        echo '
                        </div>
                    </div>
                </div>
                <div class="review-card-bottom-section">
                    <p>' . $data["description"] . '</p>
                </div>
            </div>
        </div>
        ';
    }
}