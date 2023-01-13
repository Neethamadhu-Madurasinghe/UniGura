<?php

class ModelDashboard
{
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getSubjects():array {
        $this->db->query('SELECT * FROM subject');

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }

    public function getModule($subject_id){
        $this->db->query("SELECT * FROM module WHERE subject_id=$subject_id");

        $rows = $this->db->resultAll();
        
        if($this->db->rowCount() >= 0) {    
            return $rows;
        }else {
            return false;
        }
    }

}