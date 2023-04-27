<?php

class ModelTutorUpdateProfile
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function update($data)
    {

        $this->db->query('UPDATE user JOIN  tutor on user.id = tutor.user_id SET first_name = :first_name, last_name = :last_name,  phone_number = :phone_number ,address_line1 = :address_line1, address_line2 = :address_line2, city = :city , district = :district,  bank_account_owner = :bank_account_owner , bank_account_number = :bank_account_number , bank_name = :bank_name , bank_branch = :bank_branch , education_qualification = :education_qualification , university= :university  WHERE id = :id');

        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name',  $data['last_name']);
        $this->db->bind(':phone_number',  $data['phone_number']);
        $this->db->bind(':address_line1', $data['address_line1']);
        $this->db->bind(':address_line2', $data['address_line2']);
        $this->db->bind(':city',  $data['city']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':bank_account_owner', $data['bank_account_owner']);
        $this->db->bind(':bank_account_number', $data['bank_account_number']);
        $this->db->bind(':bank_name', $data['bank_name']);
        $this->db->bind(':bank_branch', $data['bank_branch']);
        $this->db->bind(':education_qualification', $data['education_qualification']);
        $this->db->bind(':university', $data['university']);
        $this->db->bind(':id', $data['id']);


        return $this->db->execute();
    }


    public function getTutorUserInfo($tutorID)
    {
        $this->db->query('SELECT * from user where id = :tutorID');
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultAllAssoc();
    }

    public function getTutorBankDetails($tutorID)
    {
        $this->db->query('select * from tutor where user_id = :tutorID');
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultAllAssoc();
    }

    public function getTutorEducationDetails($tutorID)
    {
        $this->db->query('select * from tutor where user_id = :tutorID');
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultOne();
    }

    public function getTimeSlots($tutorID){
        $this->db->query('select * from time_slot where tutor_id = :tutorID');
        $this->db->bind(':tutorID', $tutorID);

        return $this->db->resultAll();
    }

    public function setTutorProfilePicture(string $imagePath, int $id): bool {
        $this->db->query('UPDATE user SET profile_picture=:profile_picture WHERE id = :id;');
        $this->db->bind('profile_picture', $imagePath, PDO::PARAM_STR);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

}
