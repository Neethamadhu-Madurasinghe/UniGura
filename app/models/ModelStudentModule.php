<?php
class ModelStudentModule {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getModule($subjectId) {
        $this->db->query('SELECT * FROM module WHERE subject_id=:subject_id AND is_hidden=0');
        $this->db->bind('subject_id', $subjectId, PDO::PARAM_INT);

        return $this->db->resultAll();
    }
}
