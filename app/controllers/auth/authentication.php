<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\HtmlFormatter;

class Authentication {

    private $users;
    private $usernameColumn;
    private $passwordColumn;
    private $vk;
    private $log;

    public function __construct(
        DatabaseTable $users,
        $usernameColumn, $passwordColumn
    ) {
        if(session_id() == '') {
            session_start();
        }

        $this->users = $users;
        $this->usernameColumn = $usernameColumn;
        $this->passwordColumn = $passwordColumn;
        $this->vk = new Model_Vk();
        $this->log = new Logger('access_log');
    }

    public function login($userName, $password) {

        if ($_POST['token'] != $_SESSION['token']) {
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::ALERT));
            $this->log->alert('tokens do not match');
            return false;
        }

        $user = $this->users->find(
            $this->usernameColumn, strtolower($userName)
        );

        if (
            !empty($user) &&
            password_verify($password, $user[0][$this->passwordColumn])
        ) {
            session_regenerate_id(); /* If someone has different pages open in
            different tabs, or the website uses a technology called Ajax, they
            effectively get logged out of one tab when they open another */

            $_SESSION['username'] = $userName;
            $_SESSION['password'] = $user[0][$this->passwordColumn];
            $_SESSION['firstname'] = $user[0]['name'];
            return true;
        } else {
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
            $this->log->warning('Invalid username or password.');
            return false;
        }
                
        $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
        $this->log->warning('Invalid username or password.');
        return false;
    }

    public function isLoggedIn() {

        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find(
            $this->usernameColumn, 
            strtolower($_SESSION['username'])
        );

        if (!empty($user) &&  
        (isset($_SESSION['password']) && $user[0][$this->passwordColumn] == $_SESSION['password']
        || isset($_SESSION['vk_auth']) && $_SESSION['vk_auth'] == 'vk_auth')) {
            // var_dump($_SESSION); die();
            return true;

        } else {
            return false;
        }
    }

    public function getUser() {
        if ($this->isLoggedIn()) {
            return $this->users->find(
                $this->usernameColumn,
                strtolower($_SESSION['username'])
            )[0];
        } else {
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
            $this->log->warning('Invalid username');
            return false;
        }
    }

    public function getRole() {
        $user = $this->getUser();
        return $user['role'];
    }

    public function vkLogin($vk_auth, $vk_email) {
        if (isset($vk_auth) && $vk_auth && isset($vk_email)) {
            $user = $this->users->find(
                $this->usernameColumn, strtolower($vk_email)
            );
            // var_dump($user[0]); die();
            if (!empty($user[0]['name'])) {
                $_SESSION['firstname'] = $user[0]['name'];
                return true;
            }
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
            $this->log->warning('Invalid username or password.');
            return false;
        }

        $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
        $this->log->warning('Invalid username or password.');
        return false;
    }
}