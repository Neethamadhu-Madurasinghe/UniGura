<?php

class ModelStudentTimeSlot {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTimeTable($id): array {
        $this->db->query('SELECT id, day, time, state FROM time_slot WHERE tutor_id=:id ORDER BY day, time');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }

    public function isTimeSlotFree($id) {
        $this->db->query('SELECT state FROM time_slot WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultOne()->state == 1;
    }
}