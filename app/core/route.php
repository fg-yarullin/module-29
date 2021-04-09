<?php

/**
 * Класс-маршрутизатор для определения запрашиваемой страницы.
 * > цепляет классы контроллера и моделей;
 * > создает экземпляры контроллеров и вызывает действия этих контроллеров
 */

 class Route {

    private $usersTable;
    private $authentication;

    public function __construct() {
        $this->usersTable = new DatabaseTable(get_connection(), 'user', 'id');
        $this->authentication = new Authentication($this->usersTable, 'email', 'password');
    }

    static function run() {
        // контроллер и действия по умолчанию
        // $controller = 'Main';
        // $action = 'index';

        // получаем запрос и метод запроса
        // $route = ltrim($_SERVER['REQUEST_URI'], '/') != '' ? ltrim($_SERVER['REQUEST_URI'], '/') : 'home';
        $route = trim($_SERVER['REQUEST_URI'], '/');
        
        $method = $_SERVER['REQUEST_METHOD'];

        $routes = getRoutes(); // маршруты описаны в файле "/app/app_routes.php"

        // получаем контроллер и действие из $routes
        if (isset($routes[$route][$method]['controller']) && isset($routes[$route]['model'])) {
            $controller_name = $routes[$route][$method]['controller'];
            $action_name = $routes[$route][$method]['action'];
            $model_name = $routes[$route]['model'];
        } else {
            // var_dump($route);
            // var_dump($method);
            
            Route::ErrorPage404();
        }

        // var_dump($route);
        // var_dump($controller_name);
        // var_dump($action_name); 

        // создаем контроллер
        $controller = new $controller_name($model_name);
        $action = $action_name;
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            // var_dump($route);
            // var_dump($controller_name);
            // var_dump($action_name);
            Route::ErrorPage404();
        }
    }

    public static function ErrorPage404() {
        // $host = 'http://' . $_SERVER['HTTP_HOST'];
        http_response_code(404);
        include __DIR__ . '/../views/404_view.php';
        die();
    }
}