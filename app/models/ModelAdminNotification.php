<?php

class ModelAdminNotification{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllUnseenNotifications(){
        $this->db->query('SELECT * FROM notification WHERE is_seen = 0');
        $result = $this->db->resultAll();
        return $result;
    }

    public function getUserById($userID){
        $this->db->query('SELECT * FROM user WHERE id = :user_id');
        $this->db->bind(':user_id', $userID);
        $result = $this->db->resultOne();
        return $result;
    }

    public function clearNotification($notificationID){
        $this->db->query('UPDATE notification SET is_seen = 1 WHERE id = :notification_id');
        $this->db->bind(':notification_id', $notificationID);
        $result = $this->db->execute();
        return $result;
    }
}