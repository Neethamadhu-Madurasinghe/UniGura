<?php

class ModelStudentReschedule {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function reschedule(array $data): bool {
//        Since there are more than one writes, a transaction will be executed
        $this->db->startTransaction();

//        Free the currently in-used time slots
        $this->db->query('UPDATE time_slot SET state=1, tutoring_class_id=NULL WHERE tutoring_class_id=:tutoring_class_id');
        $this->db->bind('tutoring_class_id', $data['class_id'], PDO::PARAM_INT);
        $this->db->execute();

//        Occupy new time slots
        foreach ($data['time_slots'] as $timeslot) {
            $this->db->query('UPDATE time_slot SET state=2, tutoring_class_id = :tutoring_class_id WHERE id=:id');
            $this->db->bind('tutoring_class_id', $data['class_id'], PDO::PARAM_INT);
            $this->db->bind('id', $timeslot, PDO::PARAM_INT);
            $this->db->execute();
        }

//        Get the date and time of the first time slot
        $this->db->query('SELECT * FROM time_slot WHERE id=:id');
        $this->db->bind('id', $data['time_slots'][0], PDO::PARAM_INT);
        $firstTimeSlot = $this->db->resultOneAssoc();

        print_r($firstTimeSlot);

//        Save those date on class table
        $this->db->query('UPDATE tutoring_class SET date=:date, time=:time WHERE id=:class_id');
        $this->db->bind('date', $firstTimeSlot['day'], PDO::PARAM_STR);
        $this->db->bind('time', $firstTimeSlot['time'], PDO::PARAM_STR);
        $this->db->bind('class_id', $data['class_id'], PDO::PARAM_STR);
        $this->db->execute();

        return $this->db->commitTransaction();
    }
}