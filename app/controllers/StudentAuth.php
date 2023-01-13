<?php

class StudentAuth extends Controller {
    private mixed $userModel;
    private string $loginView = 'student/auth/login';
    private string $registerView = 'student/auth/register';

    public function __construct() {
        $this->userModel = $this->model('ModelStudentAuth');
    }

//   Handle Student register
    public function register(Request $request) {
//      If the user is logged in, then redirect user into dashboard
        if ($request->isLoggedIn()) {
//            Doo
//           TODO: Check user role and redirect to relevant dashboard
        }

//      If the request is a post request, then handle incoming data
        if ($request->isPost()) {
            $body = $request->getBody();
            $data = [
                'email' => $body['email'],
                'password' => $body['password'],
                'confirm_password' => $body['confirm-password'],
                'errors' => [
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ]
            ];

//            Validate data
            $data['errors']['email_error'] = $this->validateEmail($data['email'], TRUE);
            $data['errors']['password_error'] = $this->validatePassword($data['password'], $data['confirm_password']);

//            Check whether there is any error - if not, save data into database and redirect user into login screen
            if (empty($data['errors']['email_error'])
                && empty($data['errors']['password_error'])
                && empty($data['errors']['confirm_password_error'])) {
//                Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['confirm_password'] = $data['password'];

//                Save data into database
                if ($this->userModel->register($data)) {
                    redirect('student/login');
                }else {
                    die('Something went wrong');
                }

//          If there is an error with data, when keep the user in the same page
            }else {
                $this->view($this->registerView, $request, $data);
            }

//      If the request is a get request, show empty errors
        }else {
            $data = [
                'email' => '',
                'password' => '',
                'confirm_password' => '',

                'errors' => [
                    'email_error' => '',
                    'password_error' => '',
                    'confirm_password_error' => ''
                ]
            ];

            $this->view($this->registerView, $request, $data);
        }
    }

//   Handle login process
    public function login(Request $request) {
//        If user is logged in, then redirect to dashboard page
        if ($request->isLoggedIn()) {
//            TODO: check user role and send to relevant dashboard
        }

//        If the request is a post request, then handle the incoming data
        if ($request->isPost()) {

            $body = $request->getBody();
            $data = [
                'email' => $body['email'],
                'password' => $body['password'],

                'errors' => [
                    'email_error' => '',
                    'password_error' => ''
                ]
            ];

//           Validate data
            $data['errors']['email_error'] = $this->validateEmail($data['email'], FALSE);
            $data['errors']['password_error'] = $this->validatePassword($data['password'], $data['password']);

//            If data is valid, then check is the password matches with email
            if (empty($data['errors']['email_error']) && empty($data['errors']['password_error'])) {
                $loggedUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedUser) {
                    $this->createUserSession($loggedUser);
                }else {
                    $data['errors']['password_error'] = 'Password is incorrect';
                    $this->view($this->loginView, $request, $data);
                }

//           If data is not valid, then inform
            }else {
                $this->view($this->loginView, $request, $data);
            }

//            If the request is a get request, show no error
        }else {
            $data = [
                'email' => '',
                'password' => '',

                'errors' => [
                    'email_error' => '',
                    'password_error' => ''
                ]
            ];

            $this->view($this->loginView, $request, $data);
        }
    }

    public function createUserSession($user, $rememberUser = true) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        if ($rememberUser) {
            $_SESSION['LAST_ACTIVITY'] = time();
        }

        redirect('example/dashboard');
    }

    public function logOut() {
        session_unset();
        session_destroy();
        redirect('/example/login');
    }

    private function validatePassword(string $password, string $confirmPassword): String {
        if (empty($password)) {
            return 'Please enter a valid password';

        }elseif (strlen($password) < 8) {
            return 'Password should be minimum 8 characters long';

        }elseif ($password !== $confirmPassword) {
            return 'Please confirm the password';

        }else {
            return '';
        }
    }

    private function validateEmail(string $email, bool $isRegister): String {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Please enter a valid email';

        }elseif ($isRegister && $this->userModel->findUserByEmail($email)) {
            return 'Email is already registered';

        }else {
            return '';
        }
    }

}
