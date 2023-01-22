<?php
class ModelStudentSubject {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getVisibleSubjects() {
        $this->db->query('SELECT * FROM subject where is_hidden=0');
        return $this->db->resultAll();
    }
}