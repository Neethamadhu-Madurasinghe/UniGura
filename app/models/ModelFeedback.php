<?php

class ModelFeedback {
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function createReview(int $tutor_id, int $student_id, int $template_id, int $rating, string $desciption = ''): bool {
        if ($desciption) {
            $this->db->query('INSERT INTO review SET
                    tutor_id=:tutor_id,
                    student_id=:student_id,
                    class_template_id=:template_id,
                    description=:description,
                    rating=:rating
                    ');

            $this->db->bind('description', $desciption, PDO::PARAM_STR);

        }else {
            $this->db->query('INSERT INTO review SET
                    tutor_id=:tutor_id,
                    student_id=:student_id,
                    class_template_id=:template_id,
                    rating=:rating
                    ');
        }
        echo $tutor_id;
        echo $template_id;

        $this->db->bind('tutor_id', $tutor_id, PDO::PARAM_INT);
        $this->db->bind('student_id', $student_id, PDO::PARAM_INT);
        $this->db->bind('template_id', $template_id, PDO::PARAM_INT);
        $this->db->bind('rating', $rating, PDO::PARAM_INT);

        return $this->db->execute();
    }
}