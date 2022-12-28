<?php

class ModelExampleUsers {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function register($data): bool {
        $this->db->query('INSERT INTO auth(name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind('name', $data['name'], PDO::PARAM_STR);
        $this->db->bind('email', $data['email'], PDO::PARAM_STR);
        $this->db->bind('password', $data['password'], PDO::PARAM_STR);

//      This function returns either true or false
        return $this->db->execute();
    }

    public function findUserByEmail($email): bool {
        $this->db->query('SELECT * FROM auth WHERE email=:email');
        $this->db->bind('email', $email, PDO::PARAM_STR);

        $this->db->resultOne();

//      Returns whether the row count is greater than 0y
        return $this->db->rowCount() > 0;
    }

//    Login the user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM auth WHERE email=:email');
        $this->db->bind('email', $email, PDO::PARAM_STR);

        $row = $this->db->resultOne();

        $hashedPassword = $row->password;
        if (password_verify($password, $hashedPassword)) {
            return $row;
        }else {
            return false;
        }
    }
}