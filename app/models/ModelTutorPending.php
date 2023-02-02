<?php

class ModelTutorPending {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getTutorName($id): mixed {
        $this->db->query('SELECT first_name FROM user WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $row = $this->db->resultOne();
        if (!$row) { return false; }
        if ($row->first_name === NULL ) { return false; }

        return $row->first_name;
    }

    public function setTutorBankDetails($data,$id): bool {
        $this->db->query('UPDATE tutor SET
                 bank_name = :bank_name,
                 bank_account_number = :account_number,
                 bank_branch = :branch,
                 bank_account_owner = :account_name WHERE user_id = :id');

        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind('bank_name', $data['bank'], PDO::PARAM_STR);
        $this->db->bind('account_number', $data['account_number'], PDO::PARAM_STR);
        $this->db->bind('account_name', $data['account_name'], PDO::PARAM_STR);
        $this->db->bind('branch', $data['branch'], PDO::PARAM_STR);


        return $this->db->execute();
    }

    public function setUserRole($id, $role): bool {
        $this->db->query('UPDATE auth SET role=:role WHERE id=:id');
        $this->db->bind('role', $role, PDO::PARAM_INT);
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->execute();
    }

    public function getTutorRole($id): mixed {
        $this->db->query('SELECT is_approved FROM tutor WHERE user_id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        $row = $this->db->resultOne();
        if (!$row) { return false; }
        if ($row->is_approved === NULL) { return false; }

        return $row->is_approved;
    }

}
?>