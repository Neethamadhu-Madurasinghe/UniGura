<?php

class ModelStudentRequest {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//  Checks whether the request exists when the tutorId, studentId and classTemplateId are given
    public function doesRequestExist(array $data): bool {
        $this->db->query('SELECT * FROM request WHERE
                          tutor_id=:tutor_id AND
                          student_id=:student_id AND
                          class_template_id=:class_template_id');

        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('class_template_id', $data['template_id'], PDO::PARAM_INT);

        $this->db->resultOne();
//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }

    public function makeRequest(array $data): bool {
//        Since there are two Writes, a transaction will be executed
        $this->db->startTransaction();

        $this->db->query('INSERT INTO request SET
                 class_template_id = :template_id,
                 mode = :mode,
                 tutor_id = :tutor_id,
                 student_id = :student_id
                 ');

        $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
        $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
        $this->db->bind('template_id', $data['template_id'], PDO::PARAM_INT);
        $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);

        $this->db->execute();
//       Get the Id of the newly added request
        $requestId = $this->db->lastId();

//       Use the id to insert timeslots of that request
        foreach ($data['time_slots'] as $timeSlot) {
            $this->db->query('INSERT INTO request_time_slot SET request_id=:request_id, time_slot_id=:time_slot_id');
            $this->db->bind('request_id', $requestId, PDO::PARAM_INT);
            $this->db->bind('time_slot_id', $timeSlot, PDO::PARAM_INT);

            $this->db->execute();
        }

        return $this->db->commitTransaction();
    }
}