<?php

class ModelStudentReschedule {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function doesRequestExist(int $id): bool {
        $this->db->query('SELECT * FROM reschedule WHERE tutoring_class_id=:class_id');

        $this->db->bind('class_id', $id, PDO::PARAM_INT);
        $this->db->resultOne();
//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }

    public function makeRequest(array $data): bool {
//        Since there are more than one writes, a transaction will be executed
        $this->db->startTransaction();

        foreach ($data['time_slots'] as $timeslot) {
            $this->db->query('INSERT INTO reschedule SET
                 time_slot_id = :time_slot_id,
                 tutoring_class_id = :tutoring_class_id');

            $this->db->bind('time_slot_id', $timeslot, PDO::PARAM_INT);
            $this->db->bind('tutoring_class_id', $data['class_id'], PDO::PARAM_INT);
            $this->db->execute();
        }

        return $this->db->commitTransaction();
    }
}