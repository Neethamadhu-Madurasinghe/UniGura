<?php

class ModelTutorUpdateProfile{
    private Database $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function update($first_name,$last_name,$letter_box_number,$phone_number,$street,$city,$tutorID){
        $this->db->query('update user set first_name = :first_name, last_name = :last_name, letter_box_number = :letter_box_number, phone_number = :phone_number,  street = :street, city = :city,id = :tutorID');


        $this->db->bind(':first_name', $first_name);
        $this->db->bind(':last_name', $last_name);
        $this->db->bind(':letter_box_number', $letter_box_number);
        $this->db->bind(':phone_number', $phone_number);
        $this->db->bind(':street', $street);
        $this->db->bind(':city', $city);
        $this->db->bind(':tutorID', $tutorID);



        return $this->db->execute();
        
    }

    public function getTutorUserInfo($tutorID){
        $this->db->query('select * from user where id = :tutorID');
        $this->db->bind(':tutorID' ,$tutorID);

        return $this->db->resultOne();
    }

    public function getTutorBankDetails($tutorID){
        $this->db->query('select * from tutor where user_id = :tutorID');
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultOne();
    }

    // public function getTutorEducationDetails($tutorID){
    //     $this->db->query('select * from tutor where user_id = :tutorID');
    //     $this->db->bind(':tutorID', $tutorID);

    //        return $this->db->resultOne();

    // }

    // public function getTimeSlots($tutorID){
    //     $this->db->query('select * from time_slot where tutor_id = :tutorID');
    //     $this->db->bind(':tutorID', $tutorID);

    //     return $this->db->resultOne();
    // }
    
}




?>