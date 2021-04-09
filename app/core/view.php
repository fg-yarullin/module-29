<?php

class View {
    private $controller;
    private $model;
    
    public function __constructor($controller, $model) {
        $this->controller = new $controller();
        $this->model = new $model();
    }

    public function output() {
        return "<p>" . $this->model->string . "<p>";
    }

    public function generate($content_view, $template_view, $data = null) {
       
        if (is_array($data)) {
            extract($data);
        } else {
            $title = $data;
        }

        $authentication = new Authentication(new DatabaseTable(get_connection(), 'user', 'id'), 'email', 'password');

        $isLoggedIn = !!$authentication->isLoggedIn() ? $authentication->isLoggedIn() : false;

        ob_start();
        
        include __DIR__ . '/../views/templates/' . $content_view;
        
        $output = ob_get_clean();

        include __DIR__ . '/../views/templates/' . $template_view;
    }

}