<?php

class ModelStudent {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//    Given the id of student, returns the geo-location of that student
    public function getStudentLocation($id) {
        $this->db->query('SELECT ST_X(location) as longitude, ST_Y(location) as latitude FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOne();
    }

// TODO: This function should be moved into tutor model
// Check whether a tutor has enough number of free slots when the tutor id and required number of free slots are given
    public function isTutorFree($id, $numberOfSlots): bool {
        $this->db->query('SELECT COUNT(id) AS count FROM time_slot WHERE
                                    tutor_id=:id AND state=1 GROUP BY
                                    day HAVING COUNT(id)>=:number_of_slots;');


        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind('number_of_slots', $numberOfSlots, PDO::PARAM_INT);

        $rows = $this->db->resultAll();
        return count($rows) > 0;
    }

//    Return all states of all the timeslots when the tutor id is given
    public function getTimeSlotStatesByTutorId($id, string $day = 'all', string $time = 'all'): array {
        $dayString = ' ';
        $timeString = ' ';

        if ($day !== 'all') {
            $dayString = ' AND day=:day ';
        }

        if ($time !== 'all') {
            $timeString = ' AND time>=:time ';
            $time = $time . ':00:00';
        }

        $this->db->query('SELECT state FROM time_slot WHERE tutor_id=:id'
                                                . $dayString
                                                . $timeString .
                                                'ORDER BY day, time;');

        $this->db->bind('id', $id, PDO::PARAM_INT);

        if ($day !== 'all') {
            $this->db->bind('day', $day, PDO::PARAM_STR);
        }

        if ($time !== 'all') {
            $this->db->bind('time', $time, PDO::PARAM_STR);
        }

        return $this->db->resultAllAssoc();
    }

    public function getTimeTable($id): array {
        $this->db->query('SELECT id, day, time, state FROM time_slot WHERE tutor_id=:id ORDER BY day, time');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        return $this->db->resultAllAssoc();
    }
}