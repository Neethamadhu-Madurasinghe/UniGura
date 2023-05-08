<?php

class ModelActivity {
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllActivitiesByUser(int $id): array {

//        Get all the class Id of the user
        $this->db->query('SELECT id FROM tutoring_class WHERE student_id=:student_id AND is_suspended=0');
        $this->db->bind('student_id', $id, PDO::PARAM_INT);
        $tutoringClasses = $this->db->resultAllAssoc();

//        Get all the days of all the class
        $allDays = [];
        foreach ($tutoringClasses as $tutoringClassKey => $tutoringClassValue) {
            $this->db->query('SELECT id FROM day WHERE class_id=:class_id AND is_hidden=0');
            $this->db->bind('class_id', $tutoringClassValue['id'], PDO::PARAM_INT);
            $days = $this->db->resultAllAssoc();

//            If the result list is not empty, add id to the list
            if (!empty($days)) {
                for ($i = 0; $i < count($days); $i++) {
                    $allDays = array_merge($allDays, array_values($days[$i]));
                }
            }
        }

        $allActivities = [];

        foreach ($allDays as $day) {
            $this->db->query('SELECT * FROM activity WHERE day_id=:day_id AND is_hidden=0');
            $this->db->bind('day_id', $day, PDO::PARAM_INT);
            $activities = $this->db->resultAllAssoc();

//            If the result list is not empty, add id to the list
            if (!empty($activities)) {
                $allActivities = array_merge($allActivities, $activities);
            }


        }
        return $allActivities;
    }

    public function setActivityDocument(int $id, string $documentName): bool {
        $this->db->query('UPDATE activity SET link=:link, is_completed=1 WHERE id=:id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind('link', $documentName, PDO::PARAM_STR);

        return $this->db->execute();
    }

    public function setActivityCompletion(int $id, int $isCompleted): bool {
        $this->db->query('UPDATE activity SET is_completed=:is_completed WHERE id=:id;');
        $this->db->bind('id', $id, PDO::PARAM_INT);
        $this->db->bind('is_completed', $isCompleted, PDO::PARAM_INT);

        return $this->db->execute();
    }
}