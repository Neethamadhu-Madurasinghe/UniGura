<?php

class ModelTutorUpdateProfile{
    private Database $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function update($first_name,$last_name,$phone_number,$letter_box_number,$street,$city,$gender,$profile_picture,$mode){
        $stmt = $this->db->query('update user set first_name = :first_name, last_name = :last_name, phone_number = :phone_number, letter_box_number = :letter_box_number, street = :street, city = :city, gender = :gender, profile_picture = :profile_picture');


        $this->db->bind(':first_name', $first_name);
        $this->db->bind(':last_name', $last_name);
        $this->db->bind(':phone_number', $phone_number);
        $this->db->bind(':letter_box_number', $letter_box_number);
        $this->db->bind(':street', $street);
        $this->db->bind(':city', $city);
        $this->db->bind(':gender', $gender);
        $this->db->bind(':profile_picture', $profile_picture);


        return $this->db->execute();
        
    }

}




?>