<?php

class ExampleAuth extends Controller {
    private mixed $userModel;

    public function __construct() {
        $this->userModel = $this->model('ModelExampleUsers');
    }

    function register(Request $request) {
        if ($request->isLoggedIn()) {
            redirect('/example/dashboard');
        }

        if ($request->isPost()) {
//            Input data
            $body = $request->getBody();
            $data = [
                'name' => trim($body['name']),
                'email' => trim($body['email']),
                'password' => trim($body['password']),
                'confirm_password' => trim($body['confirm_password']),

                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

//            Validate data
            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter a valid name';
            }

            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter a valid email';
            }elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'Email is already registered';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter a valid password';
            }elseif ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_error'] = 'Please confirm the password';
            }

//            Check is there is any error
            if (empty($data['name_error'])
                && empty($data['email_error'])
                && empty($data['password_error'])
                && empty($data['confirm_password_error'])) {
//                Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

//                Save data into database
                if ($this->userModel->register($data)) {
                    redirect('example/login');
                }else {
                    die('Something went wrong');
                }

            }else {
                $this->view('example/example_auth/register', $request, $data);
            }



        }else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',

                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            $this->view('example/example_auth/register', $request, $data);
        }


    }

    public function login(Request $request) {
        if ($request->isLoggedIn()) {
            redirect('/example/dashboard');
        }

        if ($request->isPost()) {
            $body = $request->getBody();

            $data = [
                'email' => trim($body['email']),
                'password' => trim($body['password']),

                'email_error' => '',
                'password_error' => ''
            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter a valid email';
            }elseif (!$this->userModel->findUserByEmail($data['email'])) {
                $data['email_error'] = 'User not found';
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Please entire a valid password';
            }elseif (empty($data['email_error'])) {
                $loggedUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedUser) {
                    $this->createUserSession($loggedUser);
                }else {
                    $data['password_error'] = 'Password is incorrect';
                }
            }
            $this->view('example/example_auth/login', $request, $data);

        }else {
            $data = [
                'email' => '',
                'password' => '',

                'email_error' => '',
                'password_error' => ''
            ];

            $this->view('example/example_auth/login', $request, $data);
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
//        TODO: REDIRECT USER TO LOGIN PAGE - USE redirect HELPER FUNCTION
    }

}
