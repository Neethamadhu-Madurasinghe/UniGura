<?php

class ModelAdminSubject
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSubjects(): array
    {
        $this->db->query('SELECT * FROM subject');

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function getModule($subject_id)
    {
        $this->db->query("SELECT * FROM module WHERE subject_id=$subject_id");

        $rows = $this->db->resultAll();

        if ($this->db->rowCount() >= 0) {
            return $rows;
        } else {
            return false;
        }
    }

    public function addSubject($subjectName)
    {
        try {
            $this->db->query('INSERT INTO `subject`(`name`, `is_hidden`) VALUES (:name,0)');
            $this->db->bind(':name', $subjectName, PDO::PARAM_STR);
            $this->db->execute();
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return 'Duplicate entry';
            }
        }
    }


    public function updateSubject($subject_id, $subjectName)
    {
        try {
            $this->db->query('UPDATE subject SET name = :subjectName WHERE id= :subject_id');
            $this->db->bind(':subjectName', $subjectName);
            $this->db->bind(':subject_id', $subject_id);
            $this->db->execute();
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return 'Duplicate entry';
            }
        }
    }


    public function updateSubjectHideShow($subject_id, $isHidden)
    {
        $this->db->query('UPDATE subject SET is_hidden = :isHidden WHERE id= :subject_id');
        $this->db->bind(':isHidden', $isHidden);
        $this->db->bind(':subject_id', $subject_id);
        $this->db->execute();
    }


    public function addModule($moduleName, $subjectId)
    {

        try {
            $this->db->query('INSERT INTO `module`(`name`, `subject_id`,`is_hidden`) VALUES (:name,:subject_id,0)');
            $this->db->bind(':name', $moduleName);
            $this->db->bind(':subject_id', $subjectId);
            $this->db->execute();
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return 'Duplicate entry';
            }
        }
    }


    public function updateModule($moduleName, $moduleId)
    {
        try {
            $this->db->query('UPDATE module SET name=:name WHERE id=:id');
            $this->db->bind(':name', $moduleName);
            $this->db->bind(':id', $moduleId);
            return $this->db->execute();
        } catch (PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return 'Duplicate entry';
            }
        }
    }


    public function updateModuleHideShow($moduleId, $isHidden)
    {

        $this->db->query('UPDATE `module` SET `is_hidden`=:is_hidden WHERE id=:id');
        $this->db->bind(':is_hidden', $isHidden, PDO::PARAM_INT);
        $this->db->bind(':id', $moduleId, PDO::PARAM_INT);

        return $this->db->execute();
    }
}
