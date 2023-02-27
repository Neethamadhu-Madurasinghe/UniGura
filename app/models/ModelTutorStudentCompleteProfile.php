<?php

class ModelTutorStudentCompleteProfile {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

//    Used to set all the profile data of a student
    public function setTutorStudentProfileDetails($data): bool {
        $this->db->query('INSERT INTO user SET
                 id = :id,
                 first_name = :first_name,
                 last_name = :last_name,
                 phone_number = :phone_number,
                 address_line1 = :address_line_one,
                 address_line2 = :address_line_two,
                 city = :city,
                 district = :district,
                 gender = :gender,
                 profile_picture = :profile_picture,
                 mode = :mode,
                 location = ST_PointFromText(:location, :srid)');

        $location = 'POINT(' . floatval($data['latitude']) . " " . floatval($data['longitude']) . ')';

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('first_name', $data['first_name'], PDO::PARAM_STR);
        $this->db->bind('last_name', $data['last_name'], PDO::PARAM_STR);
        $this->db->bind('phone_number', $data['telephone_number'], PDO::PARAM_STR);
        $this->db->bind('address_line_one', $data['address_line_1'], PDO::PARAM_STR);
        $this->db->bind('address_line_two', $data['address_line_2'], PDO::PARAM_STR);
        $this->db->bind('city', $data['city'], PDO::PARAM_STR);
        $this->db->bind('district', $data['district'], PDO::PARAM_STR);
        $this->db->bind('gender', $data['gender'], PDO::PARAM_STR);
        $this->db->bind('profile_picture', $data['profile_picture'], PDO::PARAM_STR);
        $this->db->bind('mode', $data['preferred_class_mode'], PDO::PARAM_STR);
        $this->db->bind('location', $location, PDO::PARAM_STR);
        $this->db->bind('srid', 4326, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function setStudentExamYear($data): bool {
        $this->db->query('INSERT INTO student(user_id, year_of_exam) VALUES (:id, :year_of_exam)');
        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('year_of_exam', $data['year_of_exam'], PDO::PARAM_INT);

        return $this->db->execute();
    }

//    Sets tutor specific data when completing the profile
    public function setTutorProfileDetails($data): bool {
        $this->db->query('INSERT INTO tutor SET
                 user_id = :id,
                 description = :description,
                 university = :university,
                 education_qualification = :education_qualification,
                 id_copy = :id_copy,
                 university_entrance_letter = :university_entrance_letter,
                 advanced_level_result = :advanced_level_result');

        $this->db->bind('id', $data['id'], PDO::PARAM_INT);
        $this->db->bind('description', $data['description'], PDO::PARAM_STR);
        $this->db->bind('university', $data['university'], PDO::PARAM_STR);
        $this->db->bind('education_qualification', $data['education_qualification'], PDO::PARAM_STR);
        $this->db->bind('id_copy', $data['id_copy'], PDO::PARAM_STR);
        $this->db->bind('university_entrance_letter', $data['university_entrance_letter'], PDO::PARAM_STR);
        $this->db->bind('advanced_level_result', $data['advanced_level_result'], PDO::PARAM_STR);

        return $this->db->execute();
    }

//    Can be used to change the role
    public function setUserRole($id, $role): bool {
        $this->db->query('UPDATE auth SET role=:role WHERE id=:id');
        $this->db->bind('role', $role, PDO::PARAM_INT);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function findUserByTelephoneNumber(String $telephoneNumber): bool {
        $this->db->query('SELECT * FROM user WHERE phone_number=:telephone_number');
        $this->db->bind('telephone_number', $telephoneNumber, PDO::PARAM_STR);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }


}