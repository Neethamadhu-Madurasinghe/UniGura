<?php 

class ModelTutorClass{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
        
    }

    public function getTutorClasses($id){
        $this->db->query('')
    }
}



?>