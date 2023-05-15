<?php

class ModelAdminHideShowBlockUnblock{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function hideTutor($tutorId) {
        $this->db->query("UPDATE tutor SET is_hidden = 1 WHERE user_id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        $this->db->execute();
    }

    public function showTutor($tutorId) {
        $this->db->query("UPDATE tutor SET is_hidden = 0 WHERE user_id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        $this->db->execute();
    }

    public function blockTutor($tutorId) {
        $this->db->query("UPDATE user SET is_banned = 1 WHERE id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        $this->db->execute();
    }

    public function unblockTutor($tutorId) {
        $this->db->query("UPDATE user SET is_banned = 0 WHERE id = :tutor_id");

        $this->db->bind(':tutor_id', $tutorId);

        $this->db->execute();
    }



    public function blockStudent($studentId){
        $this->db->query("UPDATE user SET is_banned = 1 WHERE id = :studentId ");

        $this->db->bind(':studentId', $studentId);

        $this->db->execute();
    }

    public function unblockStudent($studentId){
        $this->db->query("UPDATE user SET is_banned = 0 WHERE id = :studentId");

        $this->db->bind(':studentId',$studentId);

        $this->db->execute();
    }


    public function addNotification($userID, $title, $description)
    {
        $this->db->query("INSERT INTO notification (user_id, title,description) VALUES (:user_id,:title,:description)");
        $this->db->bind(':user_id', $userID,PDO::PARAM_INT);
        $this->db->bind(':title', $title,PDO::PARAM_STR);
        $this->db->bind(':description', $description,PDO::PARAM_STR);
        return $this->db->execute();
    }
}