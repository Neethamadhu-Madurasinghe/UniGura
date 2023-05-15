<?php

class TutoringClassDay {
    public static function render(array $day, array $data): void { ?>

        <div class="class-card">
            <div class="class-card-top-section">
                <h2>Day <?php echo $day['position'] . ' - ' . $day['title'] ?></h2>
                <label class="custom-checkbox">
                    <input type="checkbox" name="" class="disabled-check-box"  <?php echo $day['is_completed'] == 1 ? 'checked' : ''?> disabled >
                    <span class="checkmark disabled"></span>
                </label>
            </div>

            <div class="class-card-bottom-section">
                <?php if(empty($day['activities'])): ?>
                    <p class="activity-component">No visible activities</p>
                <?php else:?>
                    <?php foreach($day['activities'] as $activity): ?>
                        <div class="activity-row">
                            <!--                            Just text-->
                            <?php if ($activity['type'] == 2): ?>
                                <div>
                                    <img class="activity-icon" src="<?php echo URLROOT . '/public/img/student/writing.png' ?>">
                                    <p class="activity-component"><?php echo $activity['description'] ?></p>
                                </div>

                                <!--                               File upload - this is a dynamically created form -->
                            <?php elseif ($activity['type'] == 1): ?>
                                <form class="file-upload-form" action="" id="assignment-submit-form-<?php echo $activity['id']?>" method="POST" enctype = "multipart/form-data">
                                    <div>
                                        <img class="activity-icon" src="<?php echo URLROOT . '/public/img/student/upload.png' ?>">
                                        <label for="file-upload-<?php echo $activity['id']?>" class="file-upload-label activity-component">
                                            <?php echo $activity['description'] ?>
                                        </label>
                                    </div>
                                    <input id="file-upload-<?php echo $activity['id']?>" class="file-upload-input" type="file" name="assignment-file" />

                                    <label class="custom-checkbox">
                                        <input type="checkbox" name="" class="disabled-check-box"  <?php echo $activity['is_completed'] == 1 ? "checked" : ""?> disabled>
                                        <span class="checkmark disabled"></span>
                                    </label>

                                    <!--                                    Hidden input filed for give the activity id-->
                                    <input type="hidden" name="activity-id" value="<?php echo $activity['id'] ?>">
                                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                                </form>

                                <!--                               File download-->
                            <?php elseif ($activity['type'] == 0) : ?>
                                <div>
                                    <img class="activity-icon" src="<?php echo URLROOT . '/public/img/student/pdf.png' ?>">
                                    <a href="<?php echo URLROOT . '/load-file?file=' . $activity['link']  ?>" class="activity-component"><?php echo $activity['description'] ?></a>
                                </div>
                                <label class="custom-checkbox">
                                    <input type="checkbox" class="download-link" id="" name="<?php echo $activity['id']?>" <?php echo $activity['is_completed'] == 1 ? "checked" : ""?> >
                                    <span class="checkmark"></span>
                                </label>

                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <?php if ($day['is_completed'] == 1 && $day['payment_status'] == 0): ?>
                <div class="payment-btn-container">
                    <button class="btn btn-payment">Pay <?php echo $data['payment']['amount'] . ' LKR'?></button>
<!--                    Adding all the payment related data into this hidden element -->
                    <div class="invisible"
                        <?php foreach ($day['payment'] as $key => $value) {
                            echo 'data-' .  $key . '=' . str_replace(' ', '', $value) . ' ';
                            }
                        ?>
                        <?php foreach ($data['payment'] as $key => $value) {
                            echo 'data-' .  $key . '=' . str_replace(' ', '', $value) . ' ';
                        }
                        ?>
                    ></div>
                </div>
            <?php elseif ($day['is_completed'] == 1 && $day['payment_status'] == 1): ?>
                <div class="payment-btn-container">
                    <h4>Paid</h4>
                </div>
            <?php endif; ?>
        </div>


<?php
    }

}


?>