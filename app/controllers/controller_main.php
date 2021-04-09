<?php
class Controller_Main extends Controller {
    function action_index() {
        // echo '<br>I am Controller_Main<br>';
        $this->view->generate('../main_view.php', 'template_view.php');
        // echo $this->view();
    }
}