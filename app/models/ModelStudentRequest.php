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
                          class_template_id=:class_template_id AND
                          status=0');

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

        if($data['mode'] != 'online') {
            $this->db->query('INSERT INTO request SET
                 class_template_id = :template_id,
                 mode = :mode,
                 tutor_id = :tutor_id,
                 student_id = :student_id,
                 location = ST_PointFromText(:location, :srid)   
                 ');

            $location = 'POINT(' . floatval($data['custom_location'][0]) . " " . floatval($data['custom_location'][1]) . ')';

            $this->db->bind('tutor_id', $data['tutor_id'], PDO::PARAM_INT);
            $this->db->bind('student_id', $data['student_id'], PDO::PARAM_INT);
            $this->db->bind('template_id', $data['template_id'], PDO::PARAM_INT);
            $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);
            $this->db->bind('location', $location, PDO::PARAM_STR);
            $this->db->bind('srid', 4326, PDO::PARAM_INT);

        } else {
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
        }

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

    public function getAllRequestsByStudentId($id): array {
        $this->db->query('SELECT id FROM request WHERE student_id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $requestIds = $this->db->resultAllAssoc();
        $requests = [];

        foreach ($requestIds as $requestId) {
            $this->db->query('SELECT 
                                request.id,
                                request.mode,
                                request.class_template_id,
                                request.status,
                                user.first_name,
                                user.last_name 
                                FROM request INNER JOIN user ON
                                request.tutor_id = user.id WHERE request.id=:id;');


            $this->db->bind('id', $requestId['id'], PDO::PARAM_INT);
            $request = $this->db->resultOneAssoc();

            $this->db->query('SELECT subject.name AS subject_name,
                                module.name AS module_name
                                FROM tutoring_class_template INNER JOIN subject ON
                                tutoring_class_template.subject_id = subject.id INNER JOIN module ON
                                tutoring_class_template.module_id = module.id WHERE tutoring_class_template.id=:id');

            $this->db->bind('id', $request['class_template_id'], PDO::PARAM_INT);
            $subjectModule = $this->db->resultOneAssoc();

            $request['subject'] = $subjectModule['subject_name'];
            $request['module'] = $subjectModule['module_name'];
            $requests[] = $request;
        }

        return $requests;
    }

    public function getRequestById(int $id): array {
        $this->db->query('SELECT * FROM request WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOneAssoc();
    }

    public function deleteRequest(int $id): bool {
        $this->db->query('DELETE FROM request WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }
}