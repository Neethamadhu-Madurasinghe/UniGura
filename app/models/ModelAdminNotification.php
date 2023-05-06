<?php

class ModelAdminNotification
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUnseenNotifications($adminID)
    {
        $this->db->query('SELECT * FROM notification WHERE user_id = :adminID');
        $this->db->bind(':adminID',$adminID);
        return $this->db->resultAll();
    }

    public function getUserById($userID)
    {
        $this->db->query('SELECT * FROM user WHERE id = :user_id');
        $this->db->bind(':user_id', $userID);
        return $this->db->resultOne();
    }

    public function clearNotification()
    {
        $this->db->query('UPDATE notification SET is_seen = 1');
        // $this->db->bind(':notification_id', $notificationID);
        return $this->db->execute();
    }

    public function getNotificationCount(){
        $this->db->query('SELECT * FROM notification WHERE is_seen = 0');
        $this->db->resultAll();

        return $this->db->rowCount();

    }
}
