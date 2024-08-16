<?php
require_once __DIR__ . "/Controller.php";
require_once './classes/Main.php';
require_once __DIR__ . "/ApiController.php";

class AdminController extends \Controller
{
    public function __construct () {
        parent::__construct();
        $this->main = new Main();
        if (!$this->main->is_admin){
            die('Access denied');
        }
        $this->api = new ApiController();
    }
    
    public function adminpanel(){
        $html = file_get_contents('./loadhtml/admin/main.php');
        
        $token = 'token: "'.hash('sha256', crypt($this->main->my_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';
        
        $info_user = sprintf('
        infouser = {
            %s
        };
        
        ', $token);
        
        $html = str_replace('{{ USER.INFO }}', $info_user, $html);
        
        die($html);
    }    
    
    public function getrazdel(){ // Отобразить разделы
        $html = file_get_contents('./loadhtml/admin/razdely.php');
        
        $token = hash('sha256', crypt($this->main->my_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        $apirequest = $this->api->getgenre($token);
        $response = json_decode($apirequest);
        
        $genrelist = "";
        for($i=0;$i<=count($response)-1;$i++){
            $genrelist .= sprintf('
                <label class="switch ots5">
                  <input num="%s" value="%s" id=checkswitch type="radio" name=genre field=%s>
                  <span class="checksl">%s</span>
                </label>
            ', $response[$i]->idgenre, $response[$i]->idgenre, $response[$i]->namegenre, $response[$i]->namegenre);
        }
        $html = str_replace('{{ ADMIN.GENRE }}', $genrelist, $html); // Жанры
        
        
        die($html);
    }       
    public function getkontent(){ // Отобразить контент
        $html = file_get_contents('./loadhtml/admin/getkontent.php');
        die($html);
    }      
    public function getgenre(){ // Отобразить жанры
        $html = file_get_contents('./loadhtml/admin/getgenre.php');
        
        $token = hash('sha256', crypt($this->main->my_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        $apirequest = $this->api->getgenre($token);
        $response = json_decode($apirequest);
        
        $genrelist = "";
        for($i=0;$i<=count($response)-1;$i++){
            $genrelist .= sprintf('
                <label class="switch ots5">
                  <input num="%s" value="%s" id=checkswitch type="radio" name=genre field=%s>
                  <span class="checksl">%s</span>
                </label>
            ', $response[$i]->idgenre, $response[$i]->namegenre, $response[$i]->namegenre, $response[$i]->namegenre);
        }
        $html = str_replace('{{ ADMIN.GENRE }}', $genrelist, $html); // Жанры
        
        die($html);
    }    
    public function addanime(){ // Добавить анимэ
        $html = file_get_contents('./loadhtml/admin/addanime.php');        
        $token = hash('sha256', crypt($this->main->my_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        $apirequest = $this->api->getgenre($token);
        $response = json_decode($apirequest);
        
        $genrelist = "";
        for($i=0;$i<=count($response)-1;$i++){
            $genrelist .= sprintf('
                <label class="switch ots5">
                  <input num="%s" value="%s" id=checkswitch type="checkbox" name=genre field=%s>
                  <span class="checksl">%s</span>
                </label>
            ', $response[$i]->idgenre, $response[$i]->idgenre, $response[$i]->namegenre, $response[$i]->namegenre);
        }
        $html = str_replace('{{ ADMIN.GENRE }}', $genrelist, $html); // Жанры
        die($html);
    }
    public function addcont(){ // Отобразить добавление серий
        $html = file_get_contents('./loadhtml/admin/addcont.php');        
        
        
        $html = str_replace('{{ ADMIN.GENRE }}', '$genrelist', $html); // Жанры
        die($html);
    }
    
    public function addcont_select_episode($id,$s,$e){
        $html = file_get_contents('./loadhtml/admin/addcont_select_episode.php');    
        //$player = file_get_contents('http://SITE/frame/2/1/1');  
        
        
        $player = $this->api->frame_player($id,$s,$e);
            
        $html = str_replace('{{ SCRIPT.PLAYER }}', $player, $html); // 
        die($html);
        
    }
    
}
?>