<?php

class ModelAdminModule{
    private Database $db;

    public function __construct(){
        $this->db = new Database();
    }
}