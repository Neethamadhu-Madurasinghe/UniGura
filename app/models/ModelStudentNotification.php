<?php

class ModelStudentNotification {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllNotificationsByUserId(int $id): array {
        $this->db->query('SELECT * FROM notification WHERE user_id=:user_id ORDER BY created_at DESC LIMIT 10');
        $this->db->bind('user_id', $id, PDO::PARAM_INT);

        $results = $this->db->resultAllAssoc();
        if ($results) {
            return $results;
        }else {
            return [];
        }
    }

    public function markNotificationAsSeen(int $id): bool {
        $this->db->query('UPDATE notification SET is_seen = 1 WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }
}