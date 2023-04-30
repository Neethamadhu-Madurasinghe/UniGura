<?php

class ModelTutorNotification
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }



    public function getNotifications($id): array
    {
        $this->db->query(' SELECT * FROM notification WHERE user_id = :id  ORDER BY created_at ASC');
 
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }

    public function mark_as_seen($id): bool
    {
        $this->db->query('UPDATE notification SET is_seen = 1 WHERE user_id = :id AND is_seen = 0;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function mark_as_delete($id): bool
    {
        $this->db->query('DELETE FROM notification WHERE id = :id ');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function get_count($id)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM notification WHERE is_seen = 0 AND user_id = :id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOne();
    }

  
}
