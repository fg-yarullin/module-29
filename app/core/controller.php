<?php

class Controller {
    protected $model;
    protected $view;

    public function __construct($model) {
        $this->model = new $model();
        // if ($model != '') {
        //     $this->model = new $model();
        // } else {
        //     $this->model = new stdClass;
        // }
        $this->view = new View();
    }

    // default action
    // public function action_index() {}

    public function clicked() {
        $this->model->string = "Updated Data, thanks to MVC and PHP!";
    }
}