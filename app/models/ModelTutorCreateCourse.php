<?php

class ModelTutorCreateCourse{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getAllSubject(){
        $this->db->query('select * from subject');

        $row = $this->db->resultAll();

        return $row;
    }

    public function getModules($subjectid){
        $this->db->query('select * from module where id = :subject_id');
        $this->db->bind(':subject_id',$subjectid);

        return $this->db->resultAll();
    }




}



?>