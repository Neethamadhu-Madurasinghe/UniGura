<?php
class FindTutor extends Controller {
    private ModelStudentModule $moduleModel;
    private ModelStudent $studentModel;
    private ModelStudentClassTemplate $classTemplateModel;

    public function __construct() {
        $this->moduleModel = $this->model('ModelStudentModule');
        $this->studentModel = $this->model('ModelStudent');
        $this->classTemplateModel = $this->model('ModelStudentClassTemplate');
    }

    public function getModule(Request $request) {
//        Cors support
        cors();

        if (true) {
            $body = $request->getBody();
            $data = [
                'modules' => []
            ];

            if (isset($body['subject_id'])) {
                $data['modules'] = $this->moduleModel->getModule($body['subject_id']);
            }

            header('Content-type: application/json');
            echo json_encode($data);

        }else {
//            TODO: Fix the auth problem
        }
    }

    public function findTutoringClass(Request $request) {
//        Cors support
        cors();

        $body = $request->getBody();
        $data = [
            'class_templates' => []
        ];

//        Validate data
        if (
            isset($body['subject']) ||
            isset($body['module']) ||
            isset($body['day']) ||
            isset($body['time']) ||
            isset($body['class_type']) ||
            isset($body['medium']) ||
            isset($body['gender']) ||
            isset($body['price']) ||
            isset($body['mode']) ||
            isset($body['location']) ||
            isset($body['latitude']) ||
            isset($body['longitude']) ||
            isset($body['sort_by'])
        ) {
//            Normalize the price range
            switch ($body['price']) {
                case '1000':
                    $body['min_price'] = 0;
                    $body['max_price'] = 1000;
                    break;

                case '1000-2000':
                    $body['min_price'] = 1000;
                    $body['max_price'] = 1500;
                    break;

                case '2000-3000':
                    $body['min_price'] = 2000;
                    $body['max_price'] = 3000;
                    break;

                case '3000':
                    $body['min_price'] = 3000;
                    $body['max_price'] = 30000;
                    break;

                default:
                    $body['min_price'] = 0;
                    $body['max_price'] = 30000;
                    break;
            }

//            Check if the user is asking for use his default location
            if ($body['mode'] != 'online' && $body['location'] == 'default') {
                $userLocation = $this->studentModel->getStudentLocation($request->getUserId());
                if ($userLocation->longitude == 0 || $userLocation->latitude == 0) {
//                    TODO: send invalid repond code !!
                    return;
                }
                $body['longitude'] = $userLocation->longitude;
                $body['latitude'] = $userLocation->latitude;
            }

//            Specify the sorting method
            switch ($body['sort_by']) {
                case 'price-high':
                    $body['sort_by'] = 'session_rate DESC';
                    break;

                case 'price-low':
                    $body['sort_by'] = 'session_rate ASC';
                    break;

                default:
                    $body['sort_by'] = 'current_rating DESC';
                    break;
            }


//          Get all the matching data filtered using All the filters except time slots
            $data['class_templates'] = $this->classTemplateModel->getClassTemplate($body);

//          Filter the records according to number of free slot each tutor has
            $data['class_templates'] = $this->filterTutoringClassTemplateByNumberOfFreeSlots($data['class_templates']);

//          Filter the records according to the number of Consecutive free slots tutor has -
//          above filter reduces the work of this filter
            $data['class_templates'] = $this->filterTutoringClassTemplateByConsecutiveFreeSlots(
                                                $data['class_templates'],
                                                $body['day']
                                              );

//          Filter based on time asked by user


            header('Content-type: application/json');
//            print_r($data);
            echo json_encode($data['class_templates']);
            return;


        }else {
//            TODO: send invalid respond code !!
        }


        header('Content-type: application/json');
        echo json_encode($body);


    }

//    Filters classes based on session duration and the number of free slots the tutor has
    private function filterTutoringClassTemplateByNumberOfFreeSlots(array $tutoringClassTemplates): array {
        $filteredArray = [];
        foreach ($tutoringClassTemplates as $tutoringClassTemplate) {
            if ($this->studentModel->isTutorFree(
                $tutoringClassTemplate['tutor_id'],
                $tutoringClassTemplate['duration']/2
                )
            ) {
                $filteredArray[] = $tutoringClassTemplate;
            }
        }

        return $filteredArray;
    }

//    Takes all the time slots of each tutor of input array based on the day given (if day = all then
//    this function fetches timeslots for every day of the week, and checks whether
//    that tutor has enough Consecutive timeslots To fit the specified tutoring class
//    If true, that tutoring class result will be sent in the returning array
    private function filterTutoringClassTemplateByConsecutiveFreeSlots(
                                                                array $tutoringClassTemplates,
                                                                string $day
                                                                        ): array {
        $filteredArray = [];

        foreach ($tutoringClassTemplates as $tutoringClassTemplate) {
//          A tutor has 56 time slots. (7x8). Make an array of 7 sub arrays from the resulting array
            $timeSlots = array_chunk(
                $this->studentModel->getTimeSlotStatesByTutorId($tutoringClassTemplate['tutor_id'], $day),
                8
            );

//          Convert each subarray representing a day into a string
            $timeSlots = array_map('arrayToString', $timeSlots);

//          Use string matching algorithm on each day
            foreach ($timeSlots as $day) {
                if (strpos($day, str_repeat('1', $tutoringClassTemplate['duration']/2))) {
                    $filteredArray[] = $tutoringClassTemplate;
                    break;
                }
            }
        }

        return $filteredArray;
    }
}


/**
 *  Helper function to map an Array of Array into a string
 *  Array(
 *      [1] => Array([state] => 1),
 *      [2] => Array([state] => 2),
 *      [3] => Array([state] => 1),
 * )
 *
 * into "121"
 */

function arrayToString(array $timeSlotStateArray): string {
    return implode("", array_map(function ($entry) {
        return $entry['state'];
    }, $timeSlotStateArray));
}

