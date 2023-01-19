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
}