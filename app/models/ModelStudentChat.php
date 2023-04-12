<?php

class ModelStudentChat {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getChatRoomIdByUser(int $userId1, int $userId2) {
        $this->db->query('SELECT * FROM chat_thread WHERE 
                              user_id_1=:userId1_1 AND 
                              user_id_2=:userId2_1 OR 
                              user_id_1=:userId2_2 AND 
                              user_id_2=:userId1_2');
        $this->db->bind('userId1_1', $userId1, PDO::PARAM_INT);
        $this->db->bind('userId2_1', $userId2, PDO::PARAM_INT);
        $this->db->bind('userId1_2', $userId1, PDO::PARAM_INT);
        $this->db->bind('userId2_2', $userId2, PDO::PARAM_INT);

        return $this->db->resultOneAssoc();
    }

    public function fetchMessagesByChatRoomId(int $id): array {
        $this->db->query('SELECT * FROM chat WHERE thread_id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $results = $this->db->resultAllAssoc();
        if ($results) {
            return $results;
        }else {
            return [];
        }
    }

    public function getChatRooms(int $id): array {
        $this->db->query('SELECT * FROM chat_thread WHERE 
                              user_id_1=:userId_1 OR 
                              user_id_2=:userId_2');
        $this->db->bind('userId_1', $id, PDO::PARAM_INT);
        $this->db->bind('userId_2', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }
}