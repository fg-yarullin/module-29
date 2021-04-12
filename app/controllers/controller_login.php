<?php

class Controller_Login extends Controller {
    // private $authentication;
    private $token = '';

    // public function __construct() {
    //     // $authentication = new Authentication;
    //     // $this->model = new stdClass();
    //     $usersTable = new DatabaseTable(get_connection(), 'user', 'id');
    //     $this->authentication = new Authentication($usersTable, 'email', 'password');
    // }

    public function setLoginFormData() {
        $vk = new Model_Vk();
        $this->generateToken(); // CSRF-token       
        return [
            "title" => 'Log In',
            "token" => $this->token,
            "vkOauth" => $vk->getRequest() // $this->vkouath()
        ];
    }

    function loginForm() {      
        $this->view->generate('/../auth/login_view.php', 
            'template_view.php',  $this->setLoginFormData());
    }

    public function processLogin() {

        $usersTable = new DatabaseTable(get_connection(), 'user', 'id');
        $auth = new Authentication($usersTable, 'email', 'password');
        // var_dump($this->authentication); exit();
        if ($auth->login($_POST['email'], $_POST['password'])) {
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }

            if (isset($_SESSION['vk_auth'])) {
                $_SESSION['vk_auth'] = false;
            }
            // $this->view->generate('/../auth/loginsuccess_view.php', 'template_view.php', $auth);
            header('location: /login/success');
    
        } else {
            $data = $this->setLoginFormData();
            $data['error'] = 'Invalid username or password.';
            $this->view->generate('/../auth/login_view.php',
                'template_view.php', $data);
        }
    }

    public function success() {
        $usersTable = new DatabaseTable(get_connection(), 'user', 'id');
        $auth = new Authentication($usersTable, 'email', 'password');
        if ($auth->isLoggedIn()) {
            $title = 'Login Successful';
            $this->view->generate('/../auth/loginsuccess_view.php',
                'template_view.php', $title);
        } else {
            $this->error();
        }
    }

    public function error() {
        $title = "You are not logged in";
        $this->view->generate('/../auth/error_view.php',
            'template_view.php', $title);
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy ();
        $title = 'Yo have been logged out';
        $this->view->generate('/../auth/logout_view.php',
            'template_view.php', $title);
    }

    public function generateToken() {
        $this->token = hash('gost-crypto', random_int(0,999999));
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION["token"] = $this->token;
    }

    public function vkOauth() {
        
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $vk = new Model_Vk();
        extract($vk->getVkAuthInfo());

        $_SESSION['vk_auth'] = true;
        $_SESSION['token'] = $token;
        $this->token = $token;
        $_SESSION['username'] = $email;

        $usersTable = new DatabaseTable(get_connection(), 'user', 'id');
        $authentication = new Authentication($usersTable, 'email', 'password');
        if ($authentication->vkLogin($_SESSION['vk_auth'], $email)) {
            header('location: /login/success');
        } else {
            $data = $this->setLoginFormData();
            $data['error'] = 'VK-auth: You have not registered yet.';
            header('location: /user/register');
        }
    }
}