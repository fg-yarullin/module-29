<?php

class Model_Vk extends Model {
    private $clientId       = VK_OAUTH["clientId"]; // ID приложения
    private $clientSecret   = VK_OAUTH["clientSecret"]; // Защищённый ключ
    private $redirectUri    = VK_OAUTH["redirectUri"]; // Адрес, на который будет переадресован пользователь после прохождения авторизации
    // private $display        = VK_OAUTH["display"];
    private $response_type  = VK_OAUTH["response_type"];
    private $v              = VK_OAUTH["v"];
    private $scope          = VK_OAUTH["scope"];

    private $authInfo = [];

    public function __construct(array $params = []) {
        if (isset($params)) {
            // $this->clientId = $params["clientId"];
            // $this->clientSecret = $params["clientSecret"];
            // $this->redirectUri = $params["redirectUri"];
            // $this->response_type = $params["response_type"];
            // $this->v = $params["v"];
            // $this->scope = $params["scope"];
        }
    }

    public function setCode($code) {
    }

    // public function getParams() {
    //     return [
    //         "clientId"      => $this->clientId,
    //         "clientSecret"  => $this->clientSecret,
    //         "redirectUri"   => $this->redirectUri,
    //         "response_type" => $this->response_type,
    //         "v"             => $this->v,
    //         "scope"         => $this->scope,
    //     ];
    // }

    public function getRequest() {
  
        // Формируем ссылку для авторизации
        $params = array(
            'client_id'     => $this->clientId,
            'redirect_uri'  => $this->redirectUri,
            'response_type' => $this->response_type,
            'v'             => $this->v, // (обязательный параметр) версиb API https://vk.com/dev/versions
        
            // Права доступа приложения https://vk.com/dev/permissions
            // Если указать "offline", полученный access_token будет "вечным" (токен умрёт, если пользователь сменит свой пароль или удалит приложение).
            // Если не указать "offline", то полученный токен будет жить 12 часов.
            'scope'         => $this->scope,
        );
        
        // Выводим на экран ссылку для открытия окна диалога авторизации
        return 'http://oauth.vk.com/authorize?' . http_build_query( $params );
    }

    public function getVkAuthInfo() {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
                'code'          => $_GET['code'],
                'redirect_uri'  => $this->redirectUri
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
            $this->authInfo["token"] = $response->access_token; // Токен
            $this->authInfo["email"] = $response->email;
            $this->authInf["userId"] = $response->user_id; // ID авторизовавшегося пользователя
            return $this->authInfo;
            // Сохраняем токен в сессии
            // $_SESSION['token'] = $token;
        }
    }

    public function getVkUserInfo($userId) {
        if (isset($userId)) {
            $params = array(
                'user_id'       => $userId,
                'access_token'  => $this->token,
                'fields'        => "first_name",
                'v'             => $this->v,
            );
            $request = 'https://api.vk.com/method/users.get?' . http_build_query($params);
            $content = @file_get_contents($request);
            $response = json_decode($content);
            $firstName = $response->first_name;
            return $content;
        }
    }
}