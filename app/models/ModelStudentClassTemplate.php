<?php
class ModelStudentClassTemplate {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getClassTemplate(array $data): array {
        $genderString = '';
        $locationString = '';
        $orderString = ' ORDER BY ' . $data['sort_by'];

        if ($data['gender'] == 'male' || $data['gender'] == 'female') {
            $genderString = ' AND gender=:gender ';
        }

        $userLocation = 'POINT(' . floatval($data['latitude']) . " " . floatval($data['longitude']) . ')';
        if ($data['mode'] == 'physical') {
            $locationString = ' AND ST_Distance_Sphere(location, ST_PointFromText(:user_location, :srid)) <= :distance ';
        }

        $this->db->query('SELECT 
                                id,
                                first_name, 
                                last_name,
                                city,
                                profile_picture,
                                gender,
                                user_id AS tutor_id,
                                description,
                                education_qualification,
                                session_rate,
                                class_type,
                                mode,
                                duration,
                                current_rating,
                                medium,
                                subject_name,
                                module_name,
                                ST_Distance_Sphere(location, ST_PointFromText(:user_location1, :srid1)) AS distance,
                                ST_X(location) AS longitude,
                                ST_Y(location) AS latitude FROM tutoring_class_tutor 
                                WHERE subject_id=:subject_id
                                AND module_id=:module_id
                                AND class_type=:class_type
                                AND medium=:medium 
                                AND session_rate <= :price
                                AND mode IN (:mode1, :mode2)'
                                . $genderString
                                . $locationString
                                . $orderString
                                       );

        $this->db->bind('subject_id', $data['subject'], PDO::PARAM_INT);
        $this->db->bind('module_id', $data['module'], PDO::PARAM_INT);
        $this->db->bind('class_type', $data['class_type'], PDO::PARAM_STR);
        $this->db->bind('price', $data['price'], PDO::PARAM_INT);
        $this->db->bind('medium', $data['medium'], PDO::PARAM_INT);
        $this->db->bind('user_location1', $userLocation, PDO::PARAM_STR);
        $this->db->bind('srid1', 4326, PDO::PARAM_INT);

        if ($data['gender'] == 'male' || $data['gender'] == 'female') {
            $this->db->bind('gender', $data['gender'], PDO::PARAM_STR);
        }

        if ($data['mode'] == 'physical') {
            $this->db->bind('user_location', $userLocation, PDO::PARAM_STR);
            $this->db->bind('srid', 4326, PDO::PARAM_INT);
            $this->db->bind('distance', $data['distance'] * 1000, PDO::PARAM_INT);
            $this->db->bind('mode1', 'physical', PDO::PARAM_STR);

        }else {
            $this->db->bind('mode1', 'online', PDO::PARAM_STR);

        }
        $this->db->bind('mode2', 'both', PDO::PARAM_STR);

        $rows = $this->db->resultAllAssoc();

//       Fetch additional information eg:- number of active students, number of completed classes, How many days
        foreach ($rows as $key => $value) {
//           Fetch completed class count
            $this->db->query('SELECT COUNT(id) AS completed_class_count FROM tutoring_class
                                          WHERE tutor_id=:tutor_id AND completion_status=1');
            $this->db->bind('tutor_id', $value['tutor_id'], PDO::PARAM_INT);
            $rows[$key]['completed_class_count'] = $this->db->resultOne()->completed_class_count;

//           Fetch uncompleted class count (Active students)
            $this->db->query('SELECT COUNT(id) AS uncompleted_class_count FROM tutoring_class
                                            WHERE tutor_id=:tutor_id AND completion_status=0');
            $this->db->bind('tutor_id', $value['tutor_id'], PDO::PARAM_INT);
            $rows[$key]['uncompleted_class_count'] = $this->db->resultOne()->uncompleted_class_count;

//          Fetch number of days
            $this->db->query('SELECT COUNT(id) AS day_count FROM day_template
                                            WHERE class_template_id=:class_template_id');
            $this->db->bind('class_template_id', $value['id'], PDO::PARAM_INT);
            $rows[$key]['day_count'] = $this->db->resultOne()->day_count;
        }

        return $rows;
    }

    public function getMaximumClassPrice() {
        $this->db->query('SELECT MAX(session_rate) AS max_price FROM `tutoring_class_template`');
        return $this->db->resultOne();
    }

    public function getClassTemplateById($id): object {
        $this->db->query('SELECT * FROM tutoring_class_tutor WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->resultOne();
    }

    public function doesTemplateExist($id): bool {
        $this->db->query('SELECT * FROM tutoring_class_tutor WHERE id=:id');
        $this->db->bind('id', $id, PDO::PARAM_INT);

        return $this->db->rowCount() > 0;
    }

    public function getNumberOfDayOfClass($id) {
        $this->db->query('SELECT COUNT(id) AS day_count FROM day_template
                                            WHERE class_template_id=:class_template_id');
        $this->db->bind('class_template_id', $id, PDO::PARAM_INT);

        return $this->db->resultOne()->day_count;
    }

    public function getClassTemplateByTutorId($id): array {
        $this->db->query('SELECT * FROM tutoring_class_tutor WHERE tutor_id=:tutor_id');
        $this->db->bind('tutor_id', $id, PDO::PARAM_INT);

        return $this->db->resultAllAssoc();
    }
}