<?php
class ModelStudentClassTemplate {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getClassTemplate(array $data): array {
        $genderString = '';
        $modeString = '';
        $locationString = '';
        $orderString = ' ORDER BY ' . $data['sort_by'];

        if ($data['gender'] == 'male' || $data['gender'] == 'female') {
            $genderString = ' AND gender=:gender ';
        }

//        If the user is asking for online classes, then we should show tutoring classes with tag 'online' and 'both'
//        So we get the all the classes which are not equal to physical
        if ($data['mode'] == 'online' || $data['mode'] == 'physical') {
            $modeString = ' AND mode!=:mode ';
        }
        $userLocation = 'POINT(' . floatval($data['latitude']) . " " . floatval($data['longitude']) . ')';
        if ($data['mode'] != 'online') {
//            $userLocation = 'POINT(' . floatval($data['latitude']) . " " . floatval($data['longitude']) . ')';
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
                                AND medium!=:medium 
                                AND session_rate BETWEEN :price_low AND :price_high'
                                . $genderString
                                . $modeString
                                . $locationString
                                . $orderString
                                       );


        $this->db->bind('subject_id', $data['subject'], PDO::PARAM_INT);
        $this->db->bind('module_id', $data['module'], PDO::PARAM_INT);
        $this->db->bind('class_type', $data['class_type'], PDO::PARAM_STR);
        $this->db->bind('price_low', $data['min_price'], PDO::PARAM_INT);
        $this->db->bind('price_high', $data['max_price'], PDO::PARAM_INT);
        $this->db->bind('user_location1', $userLocation, PDO::PARAM_STR);
        $this->db->bind('srid1', 4326, PDO::PARAM_INT);


        if ($data['gender'] == 'male' || $data['gender'] == 'female') {
            $this->db->bind('gender', $data['gender'], PDO::PARAM_STR);
        }

        if ($data['mode'] != 'online') {
            $this->db->bind('user_location', $userLocation, PDO::PARAM_STR);
            $this->db->bind('srid', 4326, PDO::PARAM_INT);
            $this->db->bind('distance', $data['distance'] * 1000, PDO::PARAM_INT);
        }

        if ($data['mode'] == 'online' || $data['mode'] == 'physical') {
            $data['mode'] = $data['mode'] == 'online' ? 'physical' : 'online';
            $this->db->bind('mode', $data['mode'], PDO::PARAM_STR);
        }

        $data['medium'] = $data['medium'] == 'sinhala' ? 'english' : 'sinhala';
        $this->db->bind('medium', $data['medium'], PDO::PARAM_STR);

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
}