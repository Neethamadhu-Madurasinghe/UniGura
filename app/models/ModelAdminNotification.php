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
        $this->db->query('SELECT * FROM notification WHERE user_id = :adminID ORDER BY created_at DESC');
        $this->db->bind(':adminID',$adminID);
        return $this->db->resultAll();
    }

    public function getUserById($userID)
    {
        $this->db->query('SELECT * FROM user WHERE id = :user_id');
        $this->db->bind(':user_id', $userID);
        return $this->db->resultOne();
    }

    public function clearNotification($adminID)
    {
        $this->db->query('UPDATE notification SET is_seen = 1 WHERE user_id = :adminID');
        $this->db->bind(':adminID',$adminID,PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function getNotificationCount($adminID){
        $this->db->query('SELECT * FROM notification WHERE is_seen = 0 AND user_id = :adminID');
        $this->db->bind(':adminID',$adminID,PDO::PARAM_INT);
        $this->db->resultAll();

        return $this->db->rowCount();
    }

    public function deleteNotification($notificationID){
        $this->db->query('DELETE FROM notification WHERE id = :notificationID');
        $this->db->bind(':notificationID', $notificationID,PDO::PARAM_INT);
        $this->db->resultAll();

        return $this->db->rowCount();
    }
}
