<?php

class Controller_Logout extends Controller {

    function action_index() {
        // session delete
        $this->view->generate('/../main_view.php', 'template_view.php');
    }
}