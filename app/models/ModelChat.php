<?php

class ModelChat {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getChatThreadIdByUser(int $userId1, int $userId2) {
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
        $this->db->query('SELECT * FROM chat WHERE thread_id=:id ORDER BY created_at ASC');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $results = $this->db->resultAllAssoc();
        if ($results) {
            return $results;
        }else {
            return [];
        }
    }

    public function getChatThreads(int $id): array {
        $this->db->query('SELECT * FROM chat_thread WHERE 
                              user_id_1=:userId_1 OR 
                              user_id_2=:userId_2');
        $this->db->bind('userId_1', $id, PDO::PARAM_INT);
        $this->db->bind('userId_2', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function getChatThreadById(int $id) {
        $this->db->query('SELECT * FROM chat_thread WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOneAssoc();
    }

    public function getLastChatMessage(int $id) {
        $this->db->query('SELECT * FROM chat WHERE thread_id=:id ORDER BY created_at DESC LIMIT 1');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultOneAssoc();
    }

    public function saveMessage(int $threadId, string $msg, int $sender, int $receiver): bool {
        $this->db->query('INSERT INTO chat SET 
                            thread_id=:thread_id,
                            message=:message,
                            sender=:sender,
                            receiver=:receiver,
                            is_seen=0
                 ');

        echo $msg . " " . $threadId . " " . $sender . " " . $receiver;

        $this->db->bind('thread_id', $threadId, PDO::PARAM_INT);
        $this->db->bind('message', $msg, PDO::PARAM_STR);
        $this->db->bind('sender', $sender, PDO::PARAM_INT);
        $this->db->bind('receiver', $receiver, PDO::PARAM_INT);

        return $this->db->execute();
    }

//    Returns the number of unseen messages when the chatThreadId and userId is given
    public function getNumberOfUnseenMessages(int $userId, int $threadId = 0): int {
        if ($threadId === 0) {
            $this->db->query('SELECT * FROM chat WHERE receiver=:receiver_id AND is_seen=0');
        }else {
            $this->db->query('SELECT * FROM chat WHERE thread_id=:thread_id AND receiver=:receiver_id AND is_seen=0');
            $this->db->bind('thread_id', $threadId, PDO::PARAM_INT);
        }
        $this->db->bind('receiver_id', $userId, PDO::PARAM_INT);

        $this->db->execute();
        return $this->db->rowCount();
    }

//    Mark a set of messages as seen
    public function markThreadAsSeen(int $userId, int $threadId): bool {
        $this->db->query('UPDATE chat SET is_seen=1 WHERE thread_id=:thread_id AND receiver=:receiver_id');

        $this->db->bind('thread_id', $threadId, PDO::PARAM_INT);
        $this->db->bind('receiver_id', $userId, PDO::PARAM_INT);
        return $this->db->execute();
    }

//    Create a new chat thread
    public function createNewChatThread(int $userId1, int $userId2): bool {
        $this->db->query('INSERT INTO chat_thread SET 
                            user_id_1=:user_id_1,
                            user_id_2=:user_id_2
                 ');

        $this->db->bind('user_id_1', $userId1, PDO::PARAM_INT);
        $this->db->bind('user_id_2', $userId2, PDO::PARAM_INT);
        return $this->db->execute();
    }
}