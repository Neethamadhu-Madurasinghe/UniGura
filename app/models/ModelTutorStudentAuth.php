<?php

class ModelTutorStudentAuth {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registerStudent($data): bool {
        $this->db->query('INSERT INTO auth(email, password, role) VALUES (:email, :password, :role)');
        $this->db->bind('email', $data['email'], PDO::PARAM_STR);
        $this->db->bind('password', $data['password'], PDO::PARAM_STR);
        $this->db->bind('role', 6, PDO::PARAM_INT);

//      This function returns either true or false
        return $this->db->execute();
    }

    public function registerTutor($data): bool {
        $this->db->query('INSERT INTO auth(email, password, role) VALUES (:email, :password, :role)');
        $this->db->bind('email', $data['email'], PDO::PARAM_STR);
        $this->db->bind('password', $data['password'], PDO::PARAM_STR);
        $this->db->bind('role', 5, PDO::PARAM_INT);

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

//    Set an email verification code for a given user id - also set timestamp to current time
    public function setVerificationCode(int $id, string $code) {
        $this->db->query('UPDATE auth set code=:code, time=NOW() WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind('code', $code, PDO::PARAM_STR);

        $this->db->execute();
    }

//    Tells whether the given code is a valid code for a given id
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

    //    Tells whether the given code is a valid code for a given id
    public function isCodeValidByEmail(string $email, string $code): bool {
        $this->db->query('SELECT * FROM auth WHERE 
                       email=:email AND 
                       code=:code AND 
                       time>=DATE_SUB(NOW(), INTERVAL 1 HOUR)');

        $this->db->bind('email', $email, PDO::PARAM_STR);
        $this->db->bind('code', $code, PDO::PARAM_STR);

        $row = $this->db->resultOne();

//       If there is no record for given email then return false
        if (!$row) {
            return false;
        } else { return true; }

    }

//    Mark a user as a email verfied user
    public function markVerify($id) {
        $this->db->query('UPDATE auth SET is_validated=1 WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $this->db->execute();
    }

//    Get the verification code of a given user
    public function isVerificationNull($id) {
        $this->db->query('SELECT (code) FROM auth WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $row = $this->db->resultOne();
        return $row->code == null;
    }

//    Change the password of the user
    public function changePassword(String $password, int $id): bool {
        $this->db->query('UPDATE auth SET password=:password WHERE id=:id');
        $this->db->bind('password', $password, PDO::PARAM_STR);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }
}