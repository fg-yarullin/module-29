<?php

class Controller_Vkoauth extends Controller {

    public function action_index() {
        session_start();
        $params = $this->model->getParams();
        $request = 'http://oauth.vk.com/authorize?' . http_build_query( $params );
        
    }

    public function vkouath() {
        session_start(); // Токен храним в сессии
        // Параметры приложения
        $clientId     = '7819482'; // ID приложения
        $clientSecret = '5mMNTgCJaqoeJMfIS13s'; // Защищённый ключ
        $redirectUri  = 'https://oauth.vk.com/blank.html'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
        
        // Формируем ссылку для авторизации
        $params = array(
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'v'             => '5.126', // (обязательный параметр) версиb API https://vk.com/dev/versions
        
            // Права доступа приложения https://vk.com/dev/permissions
            // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
            // Если не указать "offline", то полученный токен будет жить 12 часов.
            'scope'         => 'photos,offline',
        );
        
        // Выводим на экран ссылку для открытия окна диалога авторизации
        $data = '<a href="http://oauth.vk.com/authorize?' . http_build_query( $params ) . '">Авторизация через ВКонтакте</a>';
        $this->view->generate('/../auth/vkoauth_view.php', 'template_view.php', $data);
    }

    public function getAccessToken() {
        $params = array(
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'code'          => $_GET['code'],
            'redirect_uri'  => $redirectUri
        );
     
        if (!$content = @file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params))) {
            $error = error_get_last();
            throw new Exception('HTTP request failed. Error: ' . $error['message']);
        }
     
        $response = json_decode($content);
     
        // Если при получении токена произошла ошибка
        if (isset($response->error)) {
            throw new Exception('При получении токена произошла ошибка. Error: ' . $response->error . '. Error description: ' . $response->error_description);
        }
     //А вот здесь выполняем код, если все прошло хорошо
        $token = $response->access_token; // Токен
        $expiresIn = $response->expires_in; // Время жизни токена
        $userId = $response->user_id; // ID авторизовавшегося пользователя
     
        // Сохраняем токен в сессии
        $_SESSION['token'] = $token;
    }
}