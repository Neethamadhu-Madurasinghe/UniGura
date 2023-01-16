<?php

class ModelTutorStudentCompleteProfile {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//    Used to set all the profile data of a student
    public function setStudentProfileDetails($data): bool {
        $this->db->query('INSERT INTO user SET
                 id = :id,    
                 first_name = :first_name,
                 last_name = :last_name,
                 phone_number = :phone_number,
                 letter_box_number = :letter_box_number,
                 street = :street,
                 city = :city,
                 gender = :gender,
                 profile_picture = :profile_picture,
                 mode = :mode,
                 location = ST_PointFromText(:location, :srid)');

        $location = 'POINT(' . floatval($data['latitude']) . " " . floatval($data['longitude']) . ')';

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('first_name', $data['first_name'], PDO::PARAM_STR);
        $this->db->bind('last_name', $data['last_name'], PDO::PARAM_STR);
        $this->db->bind('phone_number', $data['telephone_number'], PDO::PARAM_STR);
        $this->db->bind('letter_box_number', $data['letter_box_number'], PDO::PARAM_STR);
        $this->db->bind('street', $data['street'], PDO::PARAM_STR);
        $this->db->bind('city', $data['city'], PDO::PARAM_STR);
        $this->db->bind('gender', $data['gender'], PDO::PARAM_STR);
        $this->db->bind('profile_picture', $data['profile_picture'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['preferred_class_mode'], PDO::PARAM_STR);
        $this->db->bind('location', $location, PDO::PARAM_STR);
        $this->db->bind('srid', 4326, PDO::PARAM_INT);

        return $this->db->execute();
    }

//    Can be used to change the role
    public function setUserRole($id, $role): bool {
        $this->db->query('UPDATE auth SET role=:role WHERE id=:id');
        $this->db->bind('role', $role, PDO::PARAM_INT);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function findUserByTelephoneNumber(String $telephone_number): bool {
        $this->db->query('SELECT * FROM user WHERE phone_number=:telephone_number');
        $this->db->bind('telephone_number', $telephone_number, PDO::PARAM_STR);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }


}