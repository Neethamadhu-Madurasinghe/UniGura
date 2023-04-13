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

//    Get all the messages of a thread when the threadId is given
    public function getChatMessages(Request $request) {
        cors();
        $body = $request->getBody();
        $data = [];


        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        if (!isset($body['chatThreadId'])) {
            header("HTTP/1.0 400 Bad Request");
            return;
        }

//        Check if the user has involved in the requested chat thread
        $chatThread = $this->studentChat->getChatThreadById($body['chatThreadId']);
        if (!($chatThread['user_id_1'] == $request->getUserId() || $chatThread['user_id_2'] == $request->getUserId())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        $data['chatThread'] = $body['chatThreadId'];
        $data['userId'] = $request->getUserId();

//            Fetch actual messages
        $data['messages'] = $this->studentChat->fetchMessagesByChatRoomId($body['chatThreadId']);
        header("HTTP/1.0 200 Success");
        header('Content-type: application/json');
        echo json_encode($data);
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
        $chatData = $this->studentChat->getChatThreads($request->getUserId());
//        Fetch their profile pictures, names and last message
        $temp = [];
        foreach ($chatData as $chatThread) {
            $userId = 0;
            if ($chatThread['user_id_1'] == $request->getUserId()) {
                $userId = $chatThread['user_id_2'];
            }else {
                $userId = $chatThread['user_id_1'];
            }

            $fetchProfileRecord = $this->user->getProfilePictureAndName($userId);
            if (!$fetchProfileRecord['profile_picture']) {
                $fetchProfileRecord['profile_picture'] = "./public/img/common/profile.png";
            }

            $chatThread['profile_picture'] = $fetchProfileRecord['profile_picture'];
            $chatThread['name'] = $fetchProfileRecord['first_name'] . " " . $fetchProfileRecord['last_name'];
            $lastMessage = $this->studentChat->getLastChatMessage($chatThread['id']);

            if (isset($lastMessage['message'])) {
                $chatThread['last_message'] = $lastMessage['message'];
                $chatThread['last_message_created_at'] = $lastMessage['created_at'];
            }else {
                $chatThread['last_message'] = "";
                $chatThread['last_message_created_at'] = 0;
            }

            $temp[] = $chatThread;
        }

        $data = $temp;
        header("HTTP/1.0 200 Success");
        header('Content-type: application/json');
        echo json_encode($data);
    }
}