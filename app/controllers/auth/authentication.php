<?php

class Authentication {

    private $users;
    private $usernameColumn;
    private $passwordColumn;

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
    }

    public function login($userName, $password) {
        // checking CSRF token
        if ($_POST['token'] != $_SESSION['token']) {
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
            return false;
        }
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
        $user[0][$this->passwordColumn] == $_SESSION['password']) {
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
            return false;
        }
    }
}