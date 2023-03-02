<?php

class ModelTutorStudentAuth {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registerStudent($data): bool {
        $this->db->query('INSERT INTO auth(email, password, role, code) VALUES (:email, :password, :role, :code)');
        $this->db->bind('email', $data['email'], PDO::PARAM_STR);
        $this->db->bind('password', $data['password'], PDO::PARAM_STR);
        $this->db->bind('role', 6, PDO::PARAM_INT);
        $this->db->bind('code', $data['code'], PDO::PARAM_STR);

//      This function returns either true or false
        return $this->db->execute();
    }

    public function registerTutor($data): bool {
        $this->db->query('INSERT INTO auth(email, password, role, code) VALUES (:email, :password, :role, :code)');
        $this->db->bind('email', $data['email'], PDO::PARAM_STR);
        $this->db->bind('password', $data['password'], PDO::PARAM_STR);
        $this->db->bind('role', 5, PDO::PARAM_INT);
        $this->db->bind('code', $data['code'], PDO::PARAM_STR);

//      This function returns either true or false
        return $this->db->execute();
    }

    public function findUserByEmail($email): bool {
        $this->db->query('SELECT * FROM auth WHERE email=:email');
        $this->db->bind('email', $email, PDO::PARAM_STR);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0
        return $this->db->rowCount() > 0;
    }

//    Login the user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM auth WHERE email=:email');
        $this->db->bind('email', $email, PDO::PARAM_STR);

        $row = $this->db->resultOne();
        
//       If there is no record for given email then return false
        if (!$row) { return false; }

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        }else {
            return false;
        }
    }

    //    Retrieves the profile picture of a user then the id is given
    public function getUserProfilePicture($id): mixed {
        $this->db->query('SELECT profile_picture FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $row = $this->db->resultOne();
        if (!$row) { return false; }
        if ($row->profile_picture === NULL || $row->profile_picture === '') { return false; }

        return $row->profile_picture;
    }

    public function isCodeValid($id, $data): bool {
        $this->db->query('SELECT * FROM auth WHERE 
                       id=:id AND 
                       code=:code AND 
                       time>=DATE_SUB(NOW(), INTERVAL 1 HOUR)');

        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind('code', $data['code'], PDO::PARAM_STR);

        $row = $this->db->resultOne();

//       If there is no record for given email then return false
        if (!$row) {
            return false;
        } else { return true; }

    }

    public function markVerify($id) {
        $this->db->query('UPDATE auth SET is_validated=1 WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $this->db->execute();
    }
}