<?php

class StudentChat extends Controller {
    private ModelStudentChat $studentChat;
    private ModelUser $user;

    public function __construct() {
        $this->studentChat = $this->model('ModelStudentChat');
        $this->user = $this->model('ModelUser');
    }

    public function studentChat(Request $request) {
        $data = [];
        $this->view('/student/chat', $request, $data);
    }

    public function getChatMessages(Request $request) {
        cors();
        $body = $request->getBody();
        $data = [];

//        print_r($body);

        if (!isset($body['user1']) || !isset($body['user2'])) {
            header("HTTP/1.0 400 Bad Request");
            return;
        }

//        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
//            header("HTTP/1.0 401 Unauthorized");
//            return;
//        }

//        Check if one user is a student while other one is a tutor
        if (!(
                ($this->user->isTutor($body['user1']) && $this->user->isStudent($body['user2'])) ||
                ($this->user->isTutor($body['user2']) && $this->user->isStudent($body['user1']))
            )
        ) {
            header("HTTP/1.0 406 Not Acceptable");
            return;
        }


//        Fetch the correct chat room id
        $chatRoomId = $this->studentChat->getChatRoomIdByUser($body['user1'], $body['user2']);
        if ($chatRoomId) {
            $data['chatroom'] = $chatRoomId;

//            Fetch actual messages
            $data['messages'] = $this->studentChat->fetchMessagesByChatRoomId($chatRoomId['id']);
            header("HTTP/1.0 200 Success");
            header('Content-type: application/json');
            echo json_encode($data);

        } else {
            header("HTTP/1.0 404 Not Found");
        }


    }
}