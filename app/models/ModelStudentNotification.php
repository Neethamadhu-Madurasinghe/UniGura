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

    public function createNotification(int $userId, string $title, string $link = "", string $description = ""): bool {


        $this->db->query('INSERT INTO notification SET
                 user_id = :user_id,
                 title = :title ' .
                ($description ? ',description=:description' : '') .
                ($link ? ',link =:link' : '')
            );

        $this->db->bind('user_id', $userId, PDO::PARAM_INT);
        $this->db->bind('title', $title, PDO::PARAM_STR);

        if (strlen($link) > 0) { $this->db->bind('link', $link, PDO::PARAM_STR); }
        if (strlen($link) > 0) { $this->db->bind('description', $description, PDO::PARAM_STR); }

        return $this->db->execute();

    }
}