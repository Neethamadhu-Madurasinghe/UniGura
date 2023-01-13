<?php

class ModelTutor{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllTutor(){
        $this->db->query("SELECT * FROM tutor");

        $rows = $this->db->resultAll();

        if($this->db->rowCount() >= 0) {
            return $rows;
        }else {
            return false;
        }
    }
}