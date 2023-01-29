<?php
class ModelStudentSubject {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//   Return an array of all subjects that are not hidden.
//  Pass true as an argument to get only subjects that have at least on unhidden module
    public function getVisibleSubjects(bool $onlyWithModules = false) {
        $this->db->query('SELECT * FROM subject where is_hidden=0');
        $subjects = $this->db->resultAllAssoc();

        if ($onlyWithModules) {
            $subjects = array_filter($subjects, function($subject): bool {
               $this->db->query('SELECT * FROM module WHERE subject_id=:subject_id AND is_hidden=0');
               $this->db->bind('subject_id', $subject['id']);

               return count($this->db->resultAllAssoc()) > 0;
           });
        }

//      array_filter maintains the original array indexes, array_values removes this
        return array_values($subjects);
    }
}
