<?php

class StudentChat extends Controller {
    private ModelStudentChat $studentChat;
    private ModelUser $user;

    public function __construct() {
        $this->studentChat = $this->model('ModelStudentChat');
        $this->user = $this->model('ModelUser');
    }

    public function chatView(Request $request) {
        $data = [];
        $this->view('/student/chat', $request, $data);
    }

    public function getChatMessages(Request $request) {
        cors();
        $body = $request->getBody();
        $data = [];


        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if (!isset($body['userid'])) {
            header("HTTP/1.0 400 Bad Request");
            return;
        }


//        Check if one user is a student while other one is a tutor
        if (!(
                ($this->user->isTutor($body['userid']) && $request->getUserId()) ||
                ($request->getUserId() && $this->user->isStudent($body['userid']))
            )
        ) {
            header("HTTP/1.0 406 Not Acceptable");
            return;
        }


//        Fetch the correct chat room id
        $chatRoomId = $this->studentChat->getChatRoomIdByUser($body['userid'], $request->getUserId());
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

//    Get all the chats a user is involved in
    public function getAllChatThreads(Request $request) {
        cors();
        $data = [];

        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

//        Fetch chats
        $chatData = $this->studentChat->getChatRooms($request->getUserId());
//        Fetch their profile pictures

        $temp = [];
        foreach ($chatData as $chatThread) {
            $userId = 0;
            if ($chatThread['user_id_1'] == $request->getUserId()) {
                $userId = $chatThread['user_id_2'];
            }else {
                $userId = $chatThread['user_id_1'];
            }

            $fetchProfileRecord = $this->user->getProfilePicture($userId);
            if (!$fetchProfileRecord['profile_picture']) {
                $fetchProfileRecord['profile_picture'] = "./public/img/common/profile.png";
            }

            $chatThread["profile_picture"] = $fetchProfileRecord['profile_picture'];
            $temp[] = $chatThread;
        }

        $data = $temp;
        header("HTTP/1.0 200 Success");
        header('Content-type: application/json');
        echo json_encode($data);
    }
}