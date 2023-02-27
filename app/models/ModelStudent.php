<?php

class ModelStudent {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//    Given the id of student, returns the geo-location of that student
    public function getStudentLocation($id) {
//        TODO: Change logitude latitude
        $this->db->query('SELECT ST_X(location) as latitude, ST_Y(location) as longitude FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function getStudentMode($id) {
        $this->db->query('SELECT mode FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function getAllDetailsById($id) {
//      Fetch information in the user
        $this->db->query('SELECT * FROM user INNER JOIN student ON user.id = student.user_id WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $student = $this->db->resultOneAssoc();

//       Fetch location
        $location = $this->getStudentLocation($id);
        $student['latitude'] = $location->latitude;
        $student['longitude'] = $location->longitude;

        return $student;
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

    //    Used to set all the profile data of a student
    public function setStudentProfileDetails($data): bool {
        $this->db->startTransaction();

        $this->db->query('UPDATE user SET
                 first_name = :first_name,
                 last_name = :last_name,
                 phone_number = :phone_number,
                 address_line1 = :address_line_one,
                 address_line2 = :address_line_two,
                 city = :city,
                 district = :district,
                 gender = :gender,
                 mode = :mode,
                 location = ST_PointFromText(:location, :srid)
                 WHERE
                 id = :id;
                 ');

        $location = 'POINT(' . floatval($data['latitude']) . " " . floatval($data['longitude']) . ')';

        $this->db->bind('first_name', $data['first_name'], PDO::PARAM_STR);
        $this->db->bind('last_name', $data['last_name'], PDO::PARAM_STR);
        $this->db->bind('phone_number', $data['phone_number'], PDO::PARAM_STR);
        $this->db->bind('address_line_one', $data['address_line1'], PDO::PARAM_STR);
        $this->db->bind('address_line_two', $data['address_line2'], PDO::PARAM_STR);
        $this->db->bind('city', $data['city'], PDO::PARAM_STR);
        $this->db->bind('district', $data['district'], PDO::PARAM_STR);
        $this->db->bind('gender', $data['gender'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['preferred_class_mode'], PDO::PARAM_STR);
        $this->db->bind('location', $location, PDO::PARAM_STR);
        $this->db->bind('srid', 4326, PDO::PARAM_INT);
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);

        $this->db->execute();

        $this->db->query('UPDATE student SET year_of_exam=:year_of_exam, medium=:medium WHERE user_id=:id');
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('year_of_exam', $data['year_of_exam'], PDO::PARAM_INT);
        $this->db->bind('medium', $data['medium'], PDO::PARAM_STR);

        $this->db->execute();

        return $this->db->commitTransaction();
    }

}