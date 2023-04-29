<?php

require_once ROOT . '/lib/phpmailer/src/Exception.php';
require_once ROOT . '/lib/phpmailer/src/PHPMailer.php';
require_once ROOT . '/lib/phpmailer/src/SMTP.php';


class TutorStudentAuth extends Controller {
    private ModelTutorStudentAuth $tutorStudentAuthModel;
    private ModelUser $userModel;
    private string $loginView = 'common/auth/login';

    public function __construct() {
        $this->tutorStudentAuthModel = $this->model('ModelTutorStudentAuth');
        $this->userModel = $this->model('ModelUser');
    }

//   Handle Student register
    public function tutorStudentRegister(Request $request) {
        if ($request->isLoggedIn()) {
//            TODO: check user role and send to relevant dashboard
            redirectBasedOnUserRole($request);
        }


//       Check whether the request from tutor registration page or student registration page
        if ($request->getPath() == 'student/register') {
            $registerView = 'student/auth/register';
        }else {
            $registerView = 'tutor/auth/register';
        }

//      If the user is logged in, then redirect user into dashboard
        if ($request->isLoggedIn()) {
           redirectBasedOnUserRole($request);
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
                    'password_error' => ''
                ]
            ];

//            Validate data
            $data['errors']['email_error'] = $this->validateEmail($data['email'], TRUE);
            $data['errors']['password_error'] = validatePassword($data['password'], $data['confirm_password']);

//            Check whether there is any error - if not, save data into database and redirect user into login screen
            if (empty($data['errors']['email_error']) && empty($data['errors']['password_error'])) {
//                Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $data['confirm_password'] = $data['password'];

//                Save data into database
//                If current request is from student/register then save the data as a student, tutor otherwise
                if ($request->getPath() == 'student/register') {
                    if ($this->tutorStudentAuthModel->registerStudent($data)) {
                        redirect('/login');
                    }else {
                        header("HTTP/1.0 500 Internal Server Error");
                        die('Something went wrong');
                    }

                }else {
                    if ($this->tutorStudentAuthModel->registerTutor($data)) {
                        redirect('/login');
                    }else {
                        header("HTTP/1.0 500 Internal Server Error");
                        die('Something went wrong');
                    }
                }


//          If there is an error with data, when keep the user in the same page
            }else {
                $data['password'] = '';
                $data['confirm-password'] = '';
//               If password validation failed and email is already in use, then show the password error first
                if (
                    $data['errors']['password_error'] &&
                    $data['errors']['email_error'] === 'Email is already registered'
                ) {
                    $data['errors']['email_error'] = '';
                }
                $this->view($registerView, $request, $data);
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

            $this->view($registerView, $request, $data);
        }
    }

    public function verifyEmail(Request $request) {
        if (!$request->isLoggedIn()) {
            redirect('/login');
        }

        if ($request->isVerified()) {
            redirectBasedOnUserRole($request);
        }


        if ($request->isPost()) {

            $data = [
                'error' => ''

            ];

            $body = $request->getBody();
            if (strlen($body['code']) != 6) {
                $data['error'] = 'Please enter the code we sent to your email address';
            }

//             Is code invalid ?
            if ($data['error'] === '' && !$this->tutorStudentAuthModel->isCodeValid($request->getUserId(), $body)) {
                $data['error'] = 'Code is invalid or expired. Please try resending the code';

            } elseif ($data['error'] === '') {

                $this->tutorStudentAuthModel->markVerify($request->getUserId());
                $_SESSION['is_verified'] = 1;
            }

//            IF there is a code, then check whether its valid
            if ($data['error'] == '') {
                redirectBasedOnUserRole($request);

            }else {
                $this->view('common/auth/verifyEmail', $request, $data);
            }


        }else {
            $data = [
                'error' => ''
            ];

            $body = $request->getBody();

//            Check if this is the first time user is accessing the page
            if ($this->tutorStudentAuthModel->isVerificationNull($request->getUserId())) {
                $code = generateCode();
                if (sendCodeAsEmail($request, $code)) {
                    $this->tutorStudentAuthModel->setVerificationCode($request->getUserId(), $code);
                }

            }

//            Check if user has click the Resend code
            if (isset($body['resend']) && $body['resend'] == true) {
                $code = generateCode();
                if (sendCodeAsEmail($request, $code)) {
                    $this->tutorStudentAuthModel->setVerificationCode($request->getUserId(), $code);
                }

            }



            $this->view('common/auth/verifyEmail', $request, $data);
        }

    }


//   Handle login process
    public function login(Request $request) {
//        If user is logged in, then redirect to dashboard page
        if ($request->isLoggedIn()) {

            redirectBasedOnUserRole($request);
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
            $data['errors']['password_error'] = validatePassword($data['password'], $data['password']);

//            If data is valid, then check is the password matches with email
            if (empty($data['errors']['email_error']) && empty($data['errors']['password_error'])) {
                $loggedUser = $this->tutorStudentAuthModel->login($data['email'], $data['password']);
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
        $_SESSION['user_role'] = $user->role;
        $_SESSION['is_verified'] = $user->is_validated;

//        Fetch the user's profile picture if user is student or tutor
        if ( $user->role == 1 || $user->role == 2) {
            $profilePicture = $this->tutorStudentAuthModel->getUserProfilePicture($user->id);
            if (!$profilePicture) {
                $profilePicture = '/public/img/common/profile.png';
            }
            $_SESSION['user_picture'] = $profilePicture;
        }


        if ($rememberUser) {
            $_SESSION['LAST_ACTIVITY'] = time();
        }

        if ($_SESSION['is_verified'] == 0) {
            redirect('/verify-email');
        }elseif ($user->role === 0) {
            redirect('admin/dashboard');
        }elseif ($user->role === 1) {
            redirect('tutor/dashboard');
        }elseif ($user->role === 2) {
            redirect('student/dashboard');
        }elseif ($user->role === 3) {
            redirect('tutor/validate-email');
        }elseif ($user->role === 4) {
            redirect('student/validate-email');
        }elseif ($user->role === 5) {
            redirect('tutor/complete-profile');
        }elseif ($user->role === 6) {
            redirect('student/complete-profile');
        }
        elseif ($user->role === 7) {
            redirect('/tutor/pending');
        }
        elseif ($user->role === 8) {
            redirect('/tutor/aproved');
        }
        elseif ($user->role === 9) {
            redirect('/tutor/complete-bank-detials');
        }
        elseif ($user->role === 10) {
            redirect('/tutor/tutor-time-slot-input');
        }

    }

    public function logOut() {
        session_unset();
        session_destroy();
        redirect('/login');
    }

    private function validateEmail(string $email, bool $isRegister): String {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Please enter a valid email';

        }elseif ($isRegister && $this->tutorStudentAuthModel->findUserByEmail($email)) {
            return 'Email is already registered';

        }else {
            return '';
        }
    }


    public function resetPassword(Request $request) {
        if ($request->isLoggedIn()) {
            redirectBasedOnUserRole($request);
            return;
        }


//      if the route is entering email page
        if ($request->getPath() == 'reset-password/initiate') {
 //        Delete any session data remaining
            session_unset();
            session_destroy();
            session_start();
//            Post request
            if ($request->isPost()) {
                $body = $request->getBody();

                $data = [
                    'email' => $body['email'],
                    'errors' => [
                        'email_error' => $this->validateEmail($body['email'], false)
                    ]
                ];

//                Check if email exists
                $user = $this->userModel->getUserByEmail($data['email']);
                if (!isset($user['id'])) {
                    $data['errors']['email_error'] = "Email does not exist";
                }

                if (empty($data['errors']['email_error'])) {
//                  If no errors present, then send OTP
                    $code = generateCode();
                    if (sendCodeAsEmail($request, $code, $data['email'])) {
                        $this->tutorStudentAuthModel->setVerificationCode($user['id'], $code);
                    }

//                    Store then given user email in the session
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['id'] = $user['id'];
                    redirect('/reset-password/verify');

                }else {
                    $this->view('common/auth/resetPasswordInitiate', $request, $data);
                }


//            Get request
            } else {
                $data = [
                    'email' => '',
                    'errors' => [
                        'email_error' => ''
                    ]
                ];

                $this->view('common/auth/resetPasswordInitiate', $request, $data);
            }
        }

//        If the route is entering code page
        if ($request->getPath() == 'reset-password/verify') {
//            Check the session for see if the email is set
            if (!isset($_SESSION['email'])) {
                redirect('/logout');
            }

//            Post request
            if ($request->isPost()) {
                $body = $request->getBody();

                $data = [
                    'code' => '',
                    'errors' => [
                        'code_error' => ''
                    ]
                ];

//               Validate OTP code
                if (strlen($body['code']) != 6) {
                    $data['errors']['code_error'] = "Please enter a valid OTP";
                }

                if (empty($data['errors']['code_error']) && !$this->tutorStudentAuthModel->isCodeValidByEmail($_SESSION['email'], $body['code'])) {
                    $data['errors']['code_error'] = "Incorrect OTP";
                }

                if (empty($data['errors']['code_error'])) {
                    $_SESSION['is_verified'] = true;
                    redirect('/reset-password/reset');

                }else {
                    $this->view('common/auth/resetPasswordVerify', $request, $data);
                }


//            Get request
            } else {
                $data = [
                    'code' => '',
                    'errors' => [
                        'code_error' => ''
                    ]
                ];

                $this->view('common/auth/resetPasswordVerify', $request, $data);
            }
        }

//        IF the route is entering new password page
        if ($request->getPath() == 'reset-password/reset') {
//            Check the session for see if the email is set
            if (!isset($_SESSION['email']) || !isset($_SESSION['id'])) {
                redirect('/logout');
            }

            if (!isset($_SESSION['is_verified'])) {
                redirect('/logout');
            }

//            Post request
            if ($request->isPost()) {
                $body = $request->getBody();

                $data = [
                    'password' => $body['password'],
                    'confirm_password' => $body['confirm-password'],

                    'errors' => [
                        'password_error' => '',
                        'confirm_password_error' => ''
                    ]
                ];

                $data['errors']['password_error'] = validatePassword($data['password'], $data['confirm_password']);

                if (empty($data['errors']['password_error'])) {
//                    If there is no error, then save the new password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $this->tutorStudentAuthModel->changePassword($data['password'], $_SESSION['id']);
                    redirect('/login');

                }else {
                    $this->view('common/auth/resetPasswordReset', $request, $data);
                }


//            Get request
            } else {
                $data = [
                    'password' => '',
                    'confirm_password' => '',

                    'errors' => [
                        'password_error' => '',
                        'confirm_password_error' => ''
                    ]
                ];

                $this->view('common/auth/resetPasswordReset', $request, $data);
            }
        }
    }

}
