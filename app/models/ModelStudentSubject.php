<?php
class ModelStudentSubject {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getVisibleSubjects(bool $onlyWithModules = false) {
        $this->db->query('SELECT * FROM subject where is_hidden=0');
        return $this->db->resultAllAssoc();
    }
}
