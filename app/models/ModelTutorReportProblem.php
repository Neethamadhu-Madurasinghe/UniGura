<?php 

class ModelTutorReportProblem{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }


    public function tutorReportProblem($data){
        $this->db->query('INSERT INTO student_report SET
            class_template_id = :id,
            description = :description'
            
        );
        
        $this->db->bind('class_template_id', $data['id'],PDO::PARAM_INT);
        $this->db->bind('description', $data['description'],PDO::PARAM_STR);


        return $this->db->execute();
    }

}



?>