<?php

class ModelStudentReview {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//   Returns an array with student name, id, rating and description when the id of the class template is given
    public function getReviewsWithDescriptionByTemplateId($id): array {
        $this->db->query('SELECT 
                                review.student_id AS student_id,
                                review.description AS description,
                                review.rating AS rating,
                                user.first_name AS first_name,
                                user.last_name AS last_name,
                                user.profile_picture AS profile_picture
                                FROM review INNER JOIN user
                                ON review.student_id = user.id WHERE
                                user.is_banned=:is_banned AND
                                review.class_template_id=:template_id AND
                                review.description!=:description ORDER BY review.id DESC');

        $this->db->bind('is_banned', 0, PDO::PARAM_INT);
        $this->db->bind('template_id', $id, PDO::PARAM_INT);
        $this->db->bind('description', "", PDO::PARAM_STR);

        return $this->db->resultAllAssoc();
    }
}