<?php

class AdminProfileModel
{
    private mixed $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
