<?php

class Chat extends Controller {
    private ModelChat $chat;
    private ModelUser $user;
    private ModelStudentNotification $notification;

    public function __construct() {
        $this->chat = $this->model('ModelChat');
        $this->user = $this->model('ModelUser');
        $this->notification = $this->model('ModelStudentNotification');
    }

    public function studentChatView(Request $request) {
        if (!$request->isLoggedIn() || !$request->isStudent()) {
            redirectBasedOnUserRole($request);
            return;
        }
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
        $chatThread = $this->chat->getChatThreadById($body['chatThreadId']);
        if (!($chatThread['user_id_1'] == $request->getUserId() || $chatThread['user_id_2'] == $request->getUserId())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

        $data['chatThread'] = $body['chatThreadId'];
        $data['userId'] = $request->getUserId();

//        Mark all the messages of that thread as seen
        $this->chat->markThreadAsSeen($request->getUserId(), $body['chatThreadId']);

//            Fetch actual messages
        $data['messages'] = $this->chat->fetchMessagesByChatRoomId($body['chatThreadId']);
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
        $chatData = $this->chat->getChatThreads($request->getUserId());
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
            $chatThread['unseen_messages'] = $this->chat->getNumberOfUnseenMessages($request->getUserId(), $chatThread['id']);
            $lastMessage = $this->chat->getLastChatMessage($chatThread['id']);

            if (isset($lastMessage['message'])) {
                $chatThread['last_message'] = $lastMessage['message'];
                $chatThread['last_message_created_at'] = $lastMessage['created_at'];
            }else {
                $chatThread['last_message'] = "";
                $chatThread['last_message_created_at'] = 0;
            }

            $temp[] = $chatThread;
        }

        $data['id'] = $request->getUserId();
        $data['threads'] = $temp;
        header("HTTP/1.0 200 Success");
        header('Content-type: application/json');
        echo json_encode($data);
    }

//    Save a new message
    public function saveMessage(Request $request) {

        if ($request->isPost()) {
//          Unauthorized error code
            if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

//          Get the payload
            $body = json_decode(file_get_contents('php://input'), true);
            $body['student_id'] = $request->getUserId();


            if (!(isset($body['message']) && isset($body['thread_id']))) {
                header("HTTP/1.0 400 Bad Request");
            }

//           Find the receiver using threadId
            $thread = $this->chat->getChatThreadById($body['thread_id']);
            $receiver = 0;

            if ($thread['user_id_1'] === $request->getUserId()) {
                $receiver = $thread['user_id_2'];

            }else {
                $receiver = $thread['user_id_1'];
            }


//          If all the checks are passed, then make the request
            echo $body['thread_id'];
            if ($this->chat->saveMessage($body['thread_id'], $body['message'], $request->getUserId(), $receiver)) {
                header("HTTP/1.0 200 Success");
                return;
            }

            header("HTTP/1.0 500 Internal Server Error");

        } else {
//          This route has no get requests
            header("HTTP/1.0 404 Not found");
        }
    }

//    Get number of all unseen messages for a user
    public function getUnseenMessages(Request $request) {
        cors();
        $data = [];

        if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
            header("HTTP/1.0 401 Unauthorized");
            return;
        }

//        Fetch message count
        $data['unseen_messages'] = $this->chat->getNumberOfUnseenMessages($request->getUserId());
        header("HTTP/1.0 200 Success");
        header('Content-type: application/json');
        echo json_encode($data);
    }

//    Send a single message to user - this will create a new chat thread is it does not exist
    public function sendSingleMessage(Request $request) {
        cors();

        if ($request->isPost()) {
//          Unauthorized error code
            if (!$request->isLoggedIn() || !($request->isStudent() || $request->isTutor())) {
                header("HTTP/1.0 401 Unauthorized");
                return;
            }

//          Get the payload
            $body = json_decode(file_get_contents('php://input'), true);
            $body['sender'] = $request->getUserId();


            if (!(isset($body['message']) && isset($body['sender'])) && strlen($body["message"]) > 0) {
                header("HTTP/1.0 400 Bad Request");
            }

//            Check if a chat thread already exists
            $chatThread = $this->chat->getChatThreadIdByUser($body['sender'], $body['receiver']);

            $status = false;
            if (isset($chatThread['id'])) {
//                Add new message to the thread
                $status = $this->chat->saveMessage(
                    $chatThread['id'],
                    $body['message'],
                    $body['sender'],
                    $body['receiver']
                );

            }else {
//                Create a new chat thread and save the message
                $this->chat->createNewChatThread($body['sender'], $body['receiver']);
                $chatThread = $this->chat->getChatThreadIdByUser($body['sender'], $body['receiver']);
                $status = $this->chat->saveMessage(
                    $chatThread['id'],
                    $body['message'],
                    $body['sender'],
                    $body['receiver']
                );
            }

//            Determine the redirect link
            $redirectLink = "";
            if($request->isStudent()) {
                $redirectLink = "/student/chat";
            } else {
//                TODO: Redirect to tutor's chat
            }
            if ($status) {
//                Make a notification on senders side
                $this->notification->createNotification(
                    $body['sender'],
                    "Message has been sent",
                    $redirectLink,
                    "Click here to go chat further"
                );
                header("HTTP/1.0 200 Success");
                return;
            }

            header("HTTP/1.0 500 Internal Server Error");

        } else {
//          This route has no get requests
            header("HTTP/1.0 404 Not found");
        }
    }

    public function testRoute($request) {

    }
}