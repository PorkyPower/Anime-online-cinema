<?php
require_once __DIR__ . "/Controller.php";

    session_start();
class AuthController extends \Controller
{

    public function __construct () {

        parent::__construct();
    }

    public function AUTH_VK(){
        header('Location: '.$this->href());
        exit;
    }
    public function GET_DATA_VK($code){
        echo $code; 
    }

 
    const CLIENT_ID = ''; // ID приложения
    const CLIENT_SECRET = ''; // Защищённый ключ
    const REDIRECT_URL = 'http://SITE/authvk.php'; // Адрес, на который будет переадресован пользователь после прохождения авторизации
 
    public function href(){
        session_start();
        $params = array(
            'client_id'     => self::CLIENT_ID,
            'redirect_uri'  => self::REDIRECT_URL,
            'response_type' => 'code',
            'v'             => '5.131', // Версия API, которую вы используете https://vk.com/dev/versions
            'scope'         => '', // Если указать "offline", полученный access_token будет "вечным"
        );
        
        return 'http://oauth.vk.com/authorize?' . http_build_query($params);
    }
 
    private function getToken(){
        $params = array(
            'client_id'     => self::CLIENT_ID,
            'client_secret' => self::CLIENT_SECRET,
            'code'          => $_GET['code'],
            'redirect_uri'  => self::REDIRECT_URL
        );
        
        $content = file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params));
        
        $response = json_decode($content);        
        
        if (!$response){
            header('Location: '.$this->href());
            exit;
        }
        
        $token = $response->access_token;
        $userId = $response->user_id;
        
        
 
        return [$token, $userId];
    }
 
    public function getData(){
 
        $array = self::getToken();
        $token = $array[0];
        $userId = $array[1];
        // Формируем запрос
        $params = array(
            'v' => '5.131',
            'access_token' => $token,
            'user_ids' => $userId,
            'fields' => 'about' // Список опциональных полей https://vk.com/dev/objects/user
        );
 
        $content = file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($params));
        $response = json_decode($content);
        
        $id = $response->response[0]->id;
        $firstName = $response->response[0]->first_name;
        $lastName = $response->response[0]->last_name;
 
        $this->allowMessagesFromGroup($token);
        $this->auth($id,$firstName);
        
        return [$id, $firstName, $lastName];
    }
    private function allowMessagesFromGroup($token){
 
        // Формируем запрос
        $params = array(
            'v' => '5.199',
            'access_token' => $token,
            'group_id' => '223665693'
        );
 
        $content = file_get_contents('https://api.vk.com/method/messages.allowMessagesFromGroup?' . http_build_query($params));
        $response = json_decode($content);
        
        
        return 'ok';
    }
    
    
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) {
            return $_SESSION["is_auth"];
        }
        else {
            return false;
        }
    }
    
    public function auth($id, $name) {
        
        $userdatas = $this->Query("SELECT `id`,`is_admin`,`login` FROM `users` WHERE `vk`='$id'", []);
        foreach ($userdatas as $userdata){}
        if (isset($userdata['id'])){
        $myid = $userdata['id'];
        $is_admin = $userdata['is_admin'];
        $mylogin = $userdata['login'];
        $is_ban = $userdata['ban'];
        } else {
            $is_admin = false;
            $time = time();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userdatas2 = $this->Query("SELECT `id` FROM `users`", []);
            $co = count($userdatas2)+1;
            $login = 'AnimeGanUser'.$co;
            $this->Query("INSERT INTO `users` (vk,login,name,ip,date,lastact) VALUES('$id','$login','$name','$ip','$time','$time')", []);           
            $getregusers = $this->Query("SELECT `id` FROM `users` WHERE `vk`='$id'", []);
            foreach ($getregusers as $getreguser){}
            $myid = $getreguser['id'];  
            $mylogin = $login;  
            $this->Query("INSERT INTO `user_notice` (iduser,type,msg,attch,saw,date) VALUES('$myid','0','Добро пожаловать на сайт','0','0','$time')", []);    
            $this->Query("INSERT INTO `user_notice_social` (`iduser`,`vk`) VALUES ('$myid','$id')",[]); 
        }
        
        $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
        $_SESSION["is_admin"] = $is_admin; //Права админа
        $_SESSION["id"] = $myid; //Записываем в сессию id пользователя
        $_SESSION["login"] = $mylogin; //Записываем в сессию login пользователя
        header('Location: /id'.$myid);
        exit;
    }
    
    public function getMyId() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["id"]; //Возвращаем id, который записан в сессию
        }
    }
    public function getBan() {
        if ($this->isAuth()) { //Если пользователь авторизован
            $my_id = $_SESSION["id"];
            $userdatas = $this->Query("SELECT `ban` FROM `users` WHERE `id`='$my_id'", []);
            return $userdatas[0]['ban'];
        }
    }
    public function getMyRules() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["is_admin"]; // Возвращаем права
        }
    }
    public function getMyLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; // Возвращаем login
        }
    }
    
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
        header('Location: /');
    }
        

}
