<?php
require_once __DIR__ . "/Controller.php";
require_once __DIR__ . "/ApiController.php";
require_once './classes/Main.php';

class MainController extends \Controller
{
    public $my_user_id;
    
    public function __construct () {
        parent::__construct();
        $this->main = new Main();
        $this->api = new ApiController();
        $this->my_user_id = $this->main->my_id;
        if (isset($this->my_user_id)){            
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            $this->main->info = json_decode($this->api->getprofile($token,$this->my_user_id))[0];
        }
    }
    
    
    public function mainpage(){
        //$this->myprofile(4);
        $html = file_get_contents('./loadhtml/main/main.php');
        

        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        $apirequest = $this->api->getgenre($token);
        $response = json_decode($apirequest);
        
        $genrelist = "";
        for($i=0;$i<=count($response)-1;$i++){
            $genrelist .= sprintf('
                <label class="switch ots3">
                  <input num="%s" value="%s" id=checkswitch type="checkbox" name=genre field=%s>
                  <span class="checksl">%s</span>
                </label>
            ', $response[$i]->idgenre, $response[$i]->idgenre, $response[$i]->namegenre, $response[$i]->namegenre);
        }
        
        
        $id_auth = '';
        $user_id = $this->my_user_id;
        if ($user_id != null){
            $id_auth = 'id: '.$user_id.',';
        }
        if ($this->main->is_admin == true){
            $is_admin = 'admin: 1,';
        } else {
            $is_admin = 'admin: 0,';
        }
        $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';
        
        
        $info_user = sprintf('
        infouser = {
            %s
            %s
            %s
        }
        
        ', $id_auth,$is_admin,$token);
        
        $sitehead = '
    <meta name="title" content="Смотреть Аниме онлайн бесплатно в хорошем 1080p 720p качестве" />        
    <meta name="description" content="Смотреть Аниме онлайн бесплатно. Лучшее аниме с русской озвучкой в хорошем качестве." />        
    <meta name="keywords" content="Смотреть Аниме онлайн бесплатно в хорошем 1080p 720p качестве" />';
        $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
        $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
        $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Смотреть Аниме бесплатно в хорошем 1080p 720p качестве', $html); // title
        $html = str_replace('{{ MAIN.HEAD }}', $sitehead.$this->get_allpage('head'), $html); // head
        $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenu'), $html); // topmenu
        $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
        
        //$html = str_replace('{{ ANIME.EPISODEINFO }}', $getcontents[$anime_random]->name, $html); // 
        //$html = str_replace('{{ ANIME.NAME }}', $getcontents[$anime_random]->name, $html); // 
        //$html = str_replace('{{ ANIME.DESC }}', $getcontents[$anime_random]->name, $html); // 
        
        $html = str_replace('{{ MAIN.GENRE }}', $genrelist, $html); // Жанры
       // $html = str_replace('{{ MAIN.ANIME.SORT }}', $animesortlist, $html); // контент
        $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // контент
        $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
        
        die($html);
    }    
        
    public function myprofile($id){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        
        $user_id = $this->my_user_id;
        
        $get_profile = json_decode($this->api->getprofile($token,$id));
        
        $friends_list = '';
        $friends_script = 'let friends_list = {';
        $fr_num = 0;
        foreach($get_profile['0']->friends as $friend_user){
            $border = '';
            if ($friend_user->subscribe > time()){
                $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$friend_user->src.');'.$friend_user->small_pos.'');
            }
            if (mb_strlen($friend_user->login) > 10){
                $fr_name = mb_substr($friend_user->login, 0, 7).'...';
            } else {
                $fr_name = $friend_user->login;
            }
            
            if (time() < $friend_user->lastact+300){
                $fronline = 'online';
            } elseif(time() < $friend_user->lastact+3600) {
                $fronline = 'Был в сети 5 минут назад';
            } else {
                $fronline = 'Был в сети '.date('d.m H:i', $friend_user->lastact);
            }
            
            $friends_script .= $fr_num.':{id: '.$friend_user->id.', avatar: "'.$friend_user->avatar.'", border: "'.$friend_user->src.'", border_pos: "'.$friend_user->small_pos.'", name: "'.$friend_user->login.'", activity: "'.$fronline.'"},';
            if ($fr_num < 5){
                $friends_list .= '<a href=../id'.$friend_user->id.' id=fr_block><div id="fr_sub"><div id="fr_ava" style="background: url(http://SITE/imgs/users/ava/'.$friend_user->avatar.');background-size: cover;">'.$border.'</div></div><div>'.$fr_name.'</div></a>';
            }
            $fr_num += 1;
        }
        $friends_script .= '};';
        
        if ($friends_list == ''){
            $friends_list = 'Нет друзей';
        }
        
        $lastact = $get_profile['0']->lastact;
        $rating = $get_profile['0']->rating;
        $rank = $this->api->getrank($rating);
        $date = $get_profile['0']->date;

        
        
        $nas_name_user = $get_profile['0']->name;
        $birthday = date('d.m.Y',$get_profile['0']->birth);
        $city = $get_profile['0']->city;
        
        if ($get_profile['0']->pr_name == 1 && $id != $user_id){
            $nas_name_user = '';
        } elseif($get_profile['0']->pr_name == 1 && $id == $user_id) {
            $nas_name_user = $get_profile['0']->name.' (Скрыто)';
        }
        if ($get_profile['0']->pr_date == 1 && $id != $user_id){
            $birthday = '';
        } elseif ($get_profile['0']->pr_date == 1 && $id == $user_id) {
            $birthday = date('d.m.Y',$get_profile['0']->birth).' (Скрыто)';
        }
        if ($get_profile['0']->pr_city == 1 && $id != $user_id){
            $city = '';
        } elseif ($get_profile['0']->pr_city == 1 && $id == $user_id) {
            $city = $get_profile['0']->city.' (Скрыто)';
        }
        
        
        if ($id == $this->my_user_id){ // Если мой профиль
            $id_user = $this->my_user_id;
            $name_user = $get_profile['0']->login;
            $btns = '<a href="editprofile" id=buttonred>Редактировать</a>';
            $type_fr = 'none';
        } else {
            $id_from = $this->my_user_id;
            $id_user = $id;
            $name_user = $get_profile['0']->login;
                        
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            
            $checkfriend = json_decode($this->api->checkfriend($token,$id_from,$id));
            
            if (isset($checkfriend) && $this->main->is_auth){
                if ($checkfriend->status == 'no'){
                        $btns = '<a class=addfriend id=buttonred>Добавить в друзья</a>';
                        $type_fr = 'not friend';
                } else {
                    if ($checkfriend->status == 'request'){

                        if ($checkfriend->from == $id_from){
                            $btns = '<a class=delfriend id=buttonred>Отменить заявку</a>';
                            $type_fr = 'my request';
                        } else {
                            $btns = '<a class=addfriend id=buttonred>Принять заявку</a><a class=delfriend id=buttonred>Отклонить заявку</a>';
                            $type_fr = 'request from user';
                        }
                    } else {
                        $btns = '<a class=delfriend id=buttonred>Удалить из друзей</a>';
                        $type_fr = 'friend';
                    }
                }
            } else {
                $btns = '';
                $type_fr = '';
                
            }
            if ($this->main->is_admin){
                $btns = '<a class=banuser id=buttonred>Забанить</a>'.$btns;
            }
            
        }
        
        $html = file_get_contents("./loadhtml/main/profile.php");
      
        
        if ($get_profile['0']->pr_profile == 1 && $id != $user_id){
            libxml_use_internal_errors(true);
            $dom=new DOMDocument;

            $dom->validateOnParse = false;

            $dom->loadHTML( $html );
            $div = $dom->getElementById('foot-block-text');
            $fragment = $div->ownerDocument->createDocumentFragment();
            $fragment->appendXML('Профиль закрыт');
            $clone = $div->cloneNode();
            $clone->appendChild($fragment);
            $div->parentNode->replaceChild($clone, $div);
            
            $div2 = $dom->getElementById('right-prof');

            if( $div2 && $div2->nodeType==XML_ELEMENT_NODE ){

                $div2->parentNode->removeChild( $div2 );
            }
            
            $html =  $dom->saveHTML();
        } elseif ($get_profile['0']->pr_profile == 1 && $id == $user_id) {
            libxml_use_internal_errors(true);
            $dom=new DOMDocument;

            $dom->validateOnParse = false;

            $dom->loadHTML( $html );
            $div = $dom->getElementById('head-block-text');
            $fragment = $div->ownerDocument->createDocumentFragment();
            $fragment->appendXML('Профиль (Закрыт)');
            $clone = $div->cloneNode();
            $clone->appendChild($fragment);
            $div->parentNode->replaceChild($clone, $div);
            
            
            $html =  $dom->saveHTML();
        }
        
        $border = '';
        
        $my_info = $this->main->info;
        
        $sub_icon = '';  
        
        if ($get_profile[0]->subscribe >= time()){
                $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->position.'');
            if ($get_profile[0]->typesubs == 1){
                $sub_icon = '<svg width="20" height="20" viewBox="0 0 113 117" fill="none" xmlns="http://www.w3.org/2000/svg" style="padding: 0 10px;"><path d="M53.7568 5.21382C54.9899 3.64602 57.3647 3.64602 58.5977 5.21382L67.8794 17.0192C68.6512 18.0004 69.9386 18.4187 71.1394 18.0784L85.5873 13.9834C87.5065 13.4395 89.4282 14.8357 89.5036 16.8286L90.0737 31.8351C90.1214 33.0824 90.9168 34.1776 92.0888 34.6081L106.184 39.7877C108.056 40.4755 108.79 42.7345 107.68 44.3914L99.321 56.867C98.6262 57.904 98.6262 59.2577 99.321 60.2947L107.68 72.7702C108.79 74.4271 108.056 76.686 106.184 77.3741L92.0888 82.5537C90.9168 82.9842 90.1214 84.0793 90.0737 85.3267L89.5036 100.333C89.4282 102.326 87.5065 103.722 85.5873 103.178L71.1394 99.0835C69.9386 98.7428 68.6512 99.1615 67.8794 100.143L58.5977 111.948C57.3647 113.516 54.9899 113.516 53.7568 111.948L44.4751 100.143C43.7036 99.1615 42.416 98.7428 41.2152 99.0835L26.767 103.178C24.8482 103.722 22.9265 102.326 22.8508 100.333L22.2806 85.3267C22.2332 84.0793 21.4375 82.9842 20.2659 82.5537L6.1701 77.3741C4.29812 76.686 3.56412 74.4271 4.6743 72.7702L13.0335 60.2947C13.7283 59.2577 13.7283 57.904 13.0335 56.867L4.6743 44.3914C3.56412 42.7345 4.29812 40.4755 6.1701 39.7877L20.2659 34.6081C21.4375 34.1776 22.2332 33.0824 22.2806 31.8351L22.8508 16.8286C22.9265 14.8357 24.8482 13.4395 26.767 13.9834L41.2152 18.0784C42.416 18.4187 43.7036 18.0004 44.4751 17.0192L53.7568 5.21382Z" stroke="red" stroke-width="7.69709"></path><path d="M40.7831 58.5809L51.0459 68.8437L71.5715 48.3181" stroke="red" stroke-width="7.69709" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>';  
            }
        }
        
        if ($id == $this->my_user_id){ // Если мой профиль
            if ($my_info->subscribe >= time()){
                $subscribe = 'активна до: '.date('d.m.Y H.i', $my_info->subscribe);
                if ($my_info->typesubs == 1){
                    $subscribe = 'Подписка: <a style=color:red>Премиум</a> '. $subscribe;
                } else {
                    $subscribe = 'Подписка: <a style=color:orange>Стандарт</a> '. $subscribe;
                }
            } else {
                $subscribe = 'Подписка: Неактивна';
            }
            $html = str_replace('{{ PROFILE.SUBSCRIBE }}', $subscribe, $html); 
        } else {
            $html = str_replace('{{ PROFILE.SUBSCRIBE }}', '', $html); 
        }
          
        $back_img = sprintf('<div id=imgback style="%s"></div>', 'background: url(http://SITE/imgs/users/banner/'.$get_profile['0']->banner.');background-size: cover;background-position: center;');
        
        $ava_img = sprintf('<div id=subs><div id=ava-prof style="%s">%s</div></div>', 'background: url(http://SITE/imgs/users/ava/'.$get_profile['0']->avatar.');background-size: cover;',$border);
        
        
        $id_auth = '';
        if ($user_id != null){
            $id_auth = 'id: '.$user_id.',';
        }
        
        if ($this->main->is_admin == true){
            $is_admin = 'admin: 1,';
        } else {
            $is_admin = 'admin: 0,';
        }
        $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';

        $info_user = sprintf('
        let infouser = {
            %s
            idprof: %s,
            type_friend: "%s",
            %s
            %s
        };
        %s
        ', $id_auth,$id, $type_fr,$is_admin,$token, $friends_script);
        
        if (time() < $lastact+300){
            $online = 'online';
        } elseif(time() < $lastact+3600) {
            $online = 'Был в сети 5 минут назад';
        } else {
            $online = 'Был в сети '.date('d.m H:i', $lastact);
        }
        
        $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
        $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
        $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
        $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Профиль', $html); // title
        $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
        $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
        $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
        
        $html = str_replace('{{ FRIENDS.LIST }}', $friends_list, $html); // Список друзей
        $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
        $html = str_replace('{{ PROFILE.IMAGE.BACK }}', $back_img, $html); // Задняя картинка профиля
        $html = str_replace('{{ PROFILE.IMAGE.AVATAR }}', $ava_img, $html); // Аватар профиля
        $html = str_replace('{{ PROFILE.NAME }}', $name_user.$sub_icon, $html); // Ник профиля
        $html = str_replace('{{ PROFILE.INFONAME }}', $name_user, $html); // Ник профиля
        $html = str_replace('{{ PROFILE.NAMEUSER }}', $nas_name_user, $html); // Имя профиля
        $html = str_replace('{{ PROFILE.BIRTHDAY }}', $birthday, $html); // Дата рождения
        $html = str_replace('{{ PROFILE.RATING }}', $rating, $html); // Рейтинг
        $html = str_replace('{{ PROFILE.RANK }}', $rank, $html); // Рейтинг
        $html = str_replace('{{ PROFILE.CITY }}', $city, $html); // Город
        $html = str_replace('{{ PROFILE.DATEREG }}', date('d.m.Y', $date), $html); // Дата регистрации
        $html = str_replace('{{ PROFILE.ONLINE }}', $online, $html); // Последняя активность
        $html = str_replace('{{ PROFILE.LASTONLINE }}', date('d.m.Y H:i', $lastact), $html); // Последняя активность
        $html = str_replace('{{ PROFILE.BTNS }}', $btns, $html); // Последняя активность
        $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
        die($html);
        
        
        
        echo 'is_auth - '.$this->main->is_auth;
        echo 'id - '.$this->my_user_id;
        echo 'is_admin'.$this->main->is_admin;
        echo 'login'.$this->main->mylogin;
    }
    
    
    public function select_episode($id_anime, $timemovie = 0){	
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        $getcontents = json_decode($this->api->getepisodes($token,$id_anime,0),true);
        $link_anime = $id_anime;
        $content_get = $getcontents['cont'];
        $id_anime = $getcontents['idanime'];
        
        if (isset($content_get['s']) && $content_get['s'] == 0){
            die('');
        } 
        
        $html_content = '';
        $anime_series = '';
        
        $continue_watch = array();
        $continue_watch['season'] = 1;
        $continue_watch['episode'] = 1;

        foreach ($content_get as $content){
            $season = $content['season'];
            
            foreach ($content['items'] as $items){
                $episode = $items['episode'];
                $name_ep = $items['name'];
                $time = $items['time'];
                $duration = $items['duration'];
                $perc = $time * 100 / $duration;
                
                
                $anime_series .= "
                    <label class='switch ots1'><a href='./$link_anime/s".$season."_e".$episode."'>
                      
                        <div style='background: black;min-width: 150px;height: 50px;border-radius: 15px;align-items: center;justify-content: center;overflow: hidden;'>
                            <div style='display: flex;justify-content: center;'>
                                <div style='position: absolute;align-items: center;height: 50px;display: flex;color:white;'>
                                $episode Серия
                                </div>
                            </div>
                            <div style='background: red;width: $perc%;height: 50px;'></div>
                        </div>
                        </a>
                    </label>
                ";
                
                if ($time != 0 && $duration != 100){
                    $continue_watch['season'] = $season;
                    if ($perc > 85){
                        $continue_watch['episode'] = $episode+1;
                    } else {
                        $continue_watch['episode'] = $episode;
                    }
                }
            }
            
            
            if ($season == 0){
                
                $player = $this->api->frame_player($id_anime,$season,$episode,$timemovie);
                $anime_series = '  

    <script src="https://cdn.jsdelivr.net/npm/venom-player@latest"></script>
                <div id=watchbackgroundplayer>
                    <div id=backgroundplayer>

                    </div>
          <a id=copyright>Правообладателям</a>
                </div>
                <div id=comms-block>
                    <div id=cooms-count>Комментарии</div>
                    <div>Написать комментарий</div>
                    <div id=comms-form><div><input type="text" hidden id=reply_id_comm value=""><div id=inputtext placeholder="Напишите комментарий" contenteditable="true"></div></div><div><div id=sendcom><svg width="24" height="24" viewBox="0 0 124 106" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M119.055 52.785L4.97217 100.82L26.3628 52.785L4.97217 4.74994L119.055 52.785Z" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M25.9875 52.785H119.056" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </div></div></div>
                    <div id=comms-list>

                    </div>
                </div>


                '.$player.'
    <script src="../js/dec/comments_dec.js"></script>
    <script>
    $(function(){
        $("#popularblock").css({"width":"auto","height":"auto","margin-left":"auto"});
    
    
        sendstatsf();
    });
    setInterval(() => sendstatsf(), 7000);
    
    function sendstatsf(){   

        if (curtime+30 > dur){
            curtime = dur;
        }
            $.ajax({
                url: "http://"+window.location.host+"/api/stats", 
                method: "POST",
                dataType: "html",
                data: {path: location.pathname,
                         time: curtime,
                         dur: dur,
                        token: infouser.token},
                success: function(data){ 
                }
            });  
    }
    function typec(curtime){

    }
    </script>
                
                ';
                
                $html_content = "
                <div class=ots_up3>
                    $anime_series
                </div>";
            } else {
                $html_content .= "<div id=season>$season сезон</div>
                <div id=polosarazdel></div>
                <div id=popular-genre>
                $anime_series
                </div>";
                $anime_series = '';
            }
        }
        
        
        if ($this->api->getepisode($token,$id_anime,$continue_watch['season'],$continue_watch['episode']) != null){
            $cont_watch = "s".$continue_watch['season']."_e".($continue_watch['episode']);
        } else {
            if ($this->api->getepisode($token,$id_anime,$continue_watch['season']+1,'1') != null){
                $cont_watch = "s".($continue_watch['season']+1)."_e1";
            } else {
                $cont_watch = 's1_e1';
            }
        }
        
        

        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        $get_info_anime = $this->api->getinfoanime($token,$id_anime);
        $json_info_anime = json_decode($get_info_anime);
        if ($get_info_anime == 'err'){
            header('Location: ./');
            exit;
        }
        
        $html = file_get_contents('./loadhtml/main/episodes.php');
        
        
        $gen_json = $json_info_anime[0]->genre;
        
        $genresinfo = '<div>Жанры: </div>';
        $genresinfosite = '';
        foreach($gen_json as $gens){
            $genresinfo .= '<div>'.$gens->namegenre.'</div>';   
            $genresinfosite .= $gens->namegenre.', ';
        }
        
        if ($season == 0){
            $genresinfo1 = '';
            $genresinfosite = '';
            foreach($gen_json as $gens){
                $genresinfo1 .= '<span class=fnt_w>'.$gens->namegenre.'</span>';   
                $genresinfo1 .= ' ';   
                $genresinfosite .= $gens->namegenre.', ';
            }
            $genresinfo = '';
            $episode_info = "<span class='clr_orange fnt_16 fnt_w'><svg width='28' height='28' viewBox='0 0 28 28' fill='orange' xmlns='http://www.w3.org/2000/svg'>
<path d='M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z' stroke='orange' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/>
</svg>".$json_info_anime[0]->rating."</span> ".$genresinfo1;
        
        } else {
            $episode_info = "<span class='clr_orange fnt_16 fnt_w'><svg width='28' height='28' viewBox='0 0 28 28' fill='orange' xmlns='http://www.w3.org/2000/svg'>
<path d='M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z' stroke='orange' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/>
</svg>".$json_info_anime[0]->rating."</span> "."Сезон <span class='clr_red fnt_w'>".$season."</span> - Серия <span class='clr_red fnt_w'>".$episode."</span> - ".$name_ep;
        
        }

        $id_auth = '';
        $user_id = $this->my_user_id;
        if ($user_id != null){
            $id_auth = 'id: '.$user_id.',';
        }
        if ($this->main->is_admin == true){
            $is_admin = 'admin: 1,';
        } else {
            $is_admin = 'admin: 0,';
        }

        $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';
        
        $anime_id_info = "id_anime: $id_anime,";
        
        $info_user = sprintf('
        infouser = {
            %s
            %s
            %s
            %s
        }
        
        ', $id_auth,$is_admin,$token,$anime_id_info);

        
        if ($json_info_anime[0]->infav == 'true'){
            $infav = 'checkedbtn';
        }  else {
            $infav = '';
        }
        
        

        $sitehead = '
    <meta name="title" content="Смотреть аниме '.$json_info_anime[0]->name.' онлайн бесплатно в хорошем 1080p 720p качестве" />        
    <meta name="description" content="Смотреть аниме '.$json_info_anime[0]->name.' онлайн бесплатно. Лучшее аниме с русской озвучкой в хорошем качестве." />        
    <meta name="keywords" content="Смотреть, Аниме, '.$json_info_anime[0]->name.', онлайн, бесплатно, '.$genresinfosite.'в хорошем качестве" />';
        $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
        $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
        $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - ' . $json_info_anime[0]->name . ' - смотреть в хорошем качестве онлайн', $html); // title
        $html = str_replace('{{ MAIN.HEAD }}', $sitehead.$this->get_allpage('head'), $html); // head
        $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
        $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
        
        $html = str_replace('{{ MAIN.SEASONS.SERIES }}', $html_content, $html); // Серии и сезоны
        
        $html = str_replace('{{ ANIME.CONTINUE }}', $cont_watch, $html); // Продолжить просмотр
        
        $html = str_replace('{{ ANIME.NAME }}', $json_info_anime[0]->name.' ('.$json_info_anime[0]->year.')', $html); // Имя аниме
        $html = str_replace('{{ ANIME.CHECKED }}', $infav, $html); // отметка в избранном
        $html = str_replace('{{ ANIME.BANNER }}', $json_info_anime[0]->banner, $html); // Баннер
        $html = str_replace('{{ ANIME.ORIGNAME }}', $json_info_anime[0]->origname, $html); // Ориг название
        $html = str_replace('{{ ANIME.GENRES }}', $genresinfo, $html); // Жанры
        $html = str_replace('{{ ANIME.WATCHYAER }}', 'Возрастной рейтинг: '.$json_info_anime[0]->watchyear.'+', $html); // возрастной рейтинг
        $html = str_replace('{{ ANIME.EPISODEINFO }}', $episode_info, $html); // Информация о последнем эпизоде
        $html = str_replace('{{ ANIME.DESC }}', $json_info_anime[0]->description, $html); //Описание аниме
        $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
            $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
        die($html);
        
    }
    
    public function watch_player($id_anime, $season, $episode, $wtf = 0){
        if ($season == 0){
            header('Location: ./');
            exit;
        }
        $html = file_get_contents("./loadhtml/main/watch.php");
        
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        
        $getcontents = json_decode($this->api->getepisodes($token,$id_anime,0),true);
        $link_anime = $id_anime;
        $id_anime = $getcontents['idanime'];

        $player = $this->api->frame_player($id_anime,$season,$episode,$wtf);
        
        
        if (($this->api->getepisode($token,$id_anime,$season,$episode-1)) != null){
            $prev_ep = "<a href='./s".$season."_e".($episode-1)."' id='button'>Предыдущая серия</a>";
        } else {
            $prev_se = json_decode($this->api->getepisodes($token,$link_anime,0,$season-1));
            if (isset($prev_se->cont)){
            $prev_se = $prev_se->cont;
            }
            if ($prev_se != null){
                    foreach($prev_se as $paramName => $value){
                        foreach($value as $paramName1 => $value)
                            $prev_ep = "<a href='./s".$paramName."_e".$paramName1."' id='button'>Предыдущая серия</a>";
                    }
            } else {
                $prev_ep = '<a style=opacity:0;cursor:default; id="button">Предыдущая серия</a>';
            }
        }
        if ($this->api->getepisode($token,$id_anime,$season,$episode+1) != null){
            $next_ep = "<a href='./s".$season."_e".($episode+1)."' id='button'>Следующая серия</a>";
        } else {
            if ($this->api->getepisode($token,$id_anime,$season+1,'1') != null){
                $next_ep = "<a href='./s".($season+1)."_e1' id='button'>Следующая серия</a>";
            } else {
                $next_ep = '<a style=opacity:0;cursor:default; id="button">Следующая серия</a>';
            }
        }
        
        
        $list_episodes = $prev_ep."<a href='./' id='button'>Список серий</a>".$next_ep;
        
        $id_auth = '';
        $user_id = $this->my_user_id;
        if ($user_id != null){
            $id_auth = 'id: '.$user_id.',';
        }
        if ($this->main->is_admin == true){
            $is_admin = 'admin: 1,';
        } else {
            $is_admin = 'admin: 0,';
        }
        $animedata = json_decode($this->api->getepisode($token,$id_anime,$season,$episode));
        
        if (!$animedata){
            header('Location: ./');
            exit;
        }
        
        $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';
        
        $info_user = sprintf('
        infouser = {
            %s
            %s
            %s
        }
        
        ', $id_auth,$is_admin,$token);
        
    $sitehead = '
    <meta name="title" content="Смотреть аниме '.$animedata->animename.' онлайн бесплатно в хорошем 1080p 720p качестве" />        
    <meta name="description" content="Смотреть аниме '.$animedata->animename.' онлайн бесплатно. Лучшее аниме с русской озвучкой в хорошем качестве." />        
    <meta name="keywords" content="Смотреть, Аниме, '.$animedata->animename.', онлайн, бесплатно, в хорошем качестве, '.$season.' сезон, '.$episode.' серия" />';
        $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
        $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
        $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title').' - '.$animedata->animename.' - смотреть в хорошем качестве онлайн', $html); // title
        $html = str_replace('{{ MAIN.HEAD }}', $sitehead.$this->get_allpage('head'), $html); // head
        $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
        $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
            
        $html = str_replace('{{ MAIN.PLAYER }}', $player, $html); 
        $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
        $html = str_replace('{{ MAIN.SELECT.EPISODES }}', $list_episodes, $html); // Список серий
        $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
        $html = str_replace('{{ ANI.ID }}', $id_anime, $html); 
        $html = str_replace('{{ ANI.SEASON }}', $season, $html); 
        $html = str_replace('{{ ANI.EPISODE }}', $episode, $html);
        die($html);
    }


    
    public function editprofile(){
        if ($this->my_user_id){ // 
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));

            $date = $get_profile['0']->date;
            $lastact = $get_profile['0']->lastact;
            $nas_name_user = $get_profile['0']->name;
            $birthday = date('Y-m-d',$get_profile['0']->birth);
            $city = $get_profile['0']->city;
            
            $id_user = $this->my_user_id;
            $name_user = $get_profile['0']->login;
            $btns = '';

            $html = file_get_contents("./loadhtml/main/editprofile.php");



        $back_img = sprintf('<div id=imgback style="%s"></div>', 'background: url(http://SITE/imgs/users/banner/'.$get_profile['0']->banner.');background-size: cover;background-position: center;');
            
        $border = '';
        if ($get_profile[0]->subscribe >= time()){
            $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->position.'');
        
        }
        $ava_img = sprintf('<div id=subs><div id=ava-prof style="%s">%s</div></div>', 'background: url(http://SITE/imgs/users/ava/'.$get_profile['0']->avatar.');background-size: cover;',$border);
   
        $profile_banner = $get_profile['0']->banner;
        $profile_avatar = $get_profile['0']->avatar;
            if ($profile_avatar != 'default.jpg'){
                $del_ava = '<div id=delimageprofile style="margin-left: 5%;"><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>';
            } else {
                $del_ava = '';
            }
            
            if ($profile_banner != 'default.png'){
                $del_ban = '<div id=delimageprofile style="margin-left: 5%;"><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>';
            } else {
                $del_ban = '';
            }
            
            $border_list = '';
            if ($get_profile['0']->subscribe > time()){
                $borderslist = json_decode($this->api->getborders($token));

                $border_list = '
                                    <div class="unfoot-block-text">
                                        <div id="userborders">
                                            <div id="userborders_text">Рамки</div>
                                            <div id="userborders_list">
                                                <input hidden name=border type=text value="">';
                foreach ($borderslist as $borderlist){
                    $border_list .= '<div id=userborders_list_object num='.$borderlist->idbor.' s="'.$borderlist->position.'" style="background: url(http://SITE/imgs/users/borders/'.$borderlist->src.');"></div>';
                }
                $border_list .= '
                                            </div>
                                        </div>
                                    </div>';
            }
            
            $id_auth = '';
            $user_id = $this->my_user_id;
            if ($user_id != null){
                $id_auth = 'id: '.$user_id.',';
            }
            if ($this->main->is_admin == true){
                $is_admin = 'admin: 1,';
            } else {
                $is_admin = 'admin: 0,';
            }
            
            $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';


            $info_user = sprintf('
            infouser = {
                %s
                %s
                %s
            };

            ', $id_auth,$is_admin,$token);

        

            $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
            $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
            $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Настройки профиля', $html); // title
            $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
            $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
            $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
            
            $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
            $html = str_replace('{{ PROFILE.IMAGE.BACK }}', $back_img, $html); // Задняя картинка профиля
            $html = str_replace('{{ PROFILE.IMAGE.AVATAR }}', $ava_img, $html); // Аватар профиля
            $html = str_replace('{{ PROFILE.BANNER }}', $profile_banner, $html); // Задняя картинка профиля  input
            $html = str_replace('{{ PROFILE.AVATAR }}', $profile_avatar, $html); // Аватар профиля input
            $html = str_replace('{{ PROFILE.DELAVATAR }}', $del_ava, $html); // Аватар профиля удалить
            $html = str_replace('{{ PROFILE.DELBANNER }}', $del_ban, $html); // БАННЕр профиля удалить
            $html = str_replace('{{ PROFILE.ID }}', $id_user, $html); // id профиля
            $html = str_replace('{{ PROFILE.NAME }}', $name_user, $html); // Ник профиля
            $html = str_replace('{{ PROFILE.NAMEUSER }}', $nas_name_user, $html); // Имя профиля
            $html = str_replace('{{ PROFILE.BIRTHDAY }}', $birthday, $html); // Дата рождения
            $html = str_replace('{{ PROFILE.CITY }}', $city, $html); // Город
            $html = str_replace('{{ PROFILE.DATEREG }}', date('d.m.Y', $date), $html); // Дата регистрации
            $html = str_replace('{{ PROFILE.LASTONLINE }}', date('d.m.Y h:i', $lastact), $html); // Последняя активность
            $html = str_replace('{{ PROFILE.BTNS }}', $btns, $html); // 
            $html = str_replace('{{ PROFILE.BORDERS_LIST }}', $border_list, $html); // Список рамок
            $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
            die($html);
        }
    }
    
    
    public function privacy(){ // Приватность профиля
        if ($this->my_user_id){ // 
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            
            
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));
            
            if ($get_profile['0']->pr_name == '1'){
                $s_valn = '';
                $h_valn = 'selected';
            } else {
                $s_valn = 'selected';
                $h_valn = '';
            }
            if ($get_profile['0']->pr_date == '1'){
                $s_vald = '';
                $h_vald = 'selected';
            } else {
                $s_vald = 'selected';
                $h_vald = '';
            }
            if ($get_profile['0']->pr_city == '1'){
                $s_valc = '';
                $h_valc = 'selected';
            } else {
                $s_valc = 'selected';
                $h_valc = '';
            }
            if ($get_profile['0']->pr_profile == '1'){
                $s_valp = '';
                $h_valp = 'selected';
            } else {
                $s_valp = 'selected';
                $h_valp = '';
            }

            $show_name = '<select name="showname" id="selectfield">
                            <option '.$s_valn.' value="show">Показывать</option>
                            <option '.$h_valn.' value="hide">Скрыть</option>
                        </select>';
            $show_date = '<select name="showdate" id="selectfield">
                            <option '.$s_vald.' value="show">Показывать</option>
                            <option '.$h_vald.' value="hide">Скрыть</option>
                        </select>';
            $show_city = '<select name="showcity" id="selectfield">
                            <option '.$s_valc.' value="show">Показывать</option>
                            <option '.$h_valc.' value="hide">Скрыть</option>
                        </select>';
            $show_profile = '<select name="showprofile" id="selectfield">
                            <option '.$s_valp.' value="show">Открытый</option>
                            <option '.$h_valp.' value="hide">Закрытый</option>
                        </select>';
            
            $id_user = $this->my_user_id;
            $name_user = $get_profile['0']->login;
            $btns = '';

            $html = file_get_contents("./loadhtml/main/privacy.php");



        $back_img = sprintf('<div id=imgback style="%s"></div>', 'background: url(http://SITE/imgs/users/banner/'.$get_profile['0']->banner.');background-size: cover;background-position: center;');
                    
        $border = '';
        if ($get_profile[0]->subscribe >= time()){
            $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->position.'');
        
        }
        $ava_img = sprintf('<div id=subs><div id=ava-prof style="%s">%s</div></div>', 'background: url(http://SITE/imgs/users/ava/'.$get_profile['0']->avatar.');background-size: cover;',$border);
   
            
            $id_auth = '';
            $user_id = $this->my_user_id;
            if ($user_id != null){
                $id_auth = 'id: '.$user_id.',';
            }
            if ($this->main->is_admin == true){
                $is_admin = 'admin: 1,';
            } else {
                $is_admin = 'admin: 0,';
            }

            $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';


            $info_user = sprintf('
            infouser = {
                %s
                %s
                %s
            };

            ', $id_auth,$is_admin,$token);

        

            $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
            $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
            $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Настройки профиля', $html); // title
            $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
            $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
            $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
            
            $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
            $html = str_replace('{{ PROFILE.IMAGE.BACK }}', $back_img, $html); // Задняя картинка профиля
            $html = str_replace('{{ PROFILE.IMAGE.AVATAR }}', $ava_img, $html); // Аватар профиля
            $html = str_replace('{{ PROFILE.ID }}', $id_user, $html); // id профиля
            $html = str_replace('{{ PROFILE.NAME }}', $name_user, $html); // Ник профиля
            
            $html = str_replace('{{ PRIVACY.NAME }}', $show_name, $html); // Имя приватность
            $html = str_replace('{{ PRIVACY.DATE }}', $show_date, $html); // дата приватность
            $html = str_replace('{{ PRIVACY.CITY }}', $show_city, $html); // город приватность
            $html = str_replace('{{ PRIVACY.PROFILE }}', $show_profile, $html); // профиль приватность
            
            
            $html = str_replace('{{ PROFILE.BTNS }}', $btns, $html); 
            $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
            die($html);
        }
    }
    
    public function subscribe(){ // Подписка
        if ($this->my_user_id){ // 
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            
            
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));
                        
            $id_user = $this->my_user_id;
            $name_user = $get_profile['0']->login;
            $btns = '';
            $money_user = $get_profile['0']->money;
            
            $subscribe = 'Неактивна';
            $subend = 'Неактивна';
            $price_standart = array('50', '120', '390');
            $price_premium = array('100', '250', '800');
            $sub_change = '';
            
            $bloch_sub_change = '<div class="unfoot-block-text">
                                    <div>Управление подпиской</div>
                                    <div style="display: flex;">
                                        <a class="subbtn" changesub="%s" id=buttonred>Перевести на %s</a>
                                    </div>
                                </div>';
            $block_subscribe = '<div class="unfoot-block-text">
                                    <div>%s</div>
                                    <div typesub=%s style="display: flex;flex-wrap: wrap;">
                                        <a class="subbtn" period=1 id=buttonred><div>30 дней</div><div>%s руб.</div></a>
                                        <a class="subbtn" period=2 id=buttonred><div>90 дней</div><div>%s руб.</div></a>
                                        <a class="subbtn" period=3 id=buttonred><div>365 дней</div><div>%s руб.</div></a>
                                    </div>
                                </div>';
            if ($get_profile['0']->subscribe>time()){
                $subscribe = 'Стандарт';
                $subscribe_block_send = sprintf($block_subscribe, 'Продлить Стандарт', 'standart', $price_standart[0],$price_standart[1],$price_standart[2]);
                $sub_change = sprintf($bloch_sub_change, 'premium', 'Премиум');
                if ($get_profile['0']->typesubs == 1){
                    $subscribe = 'Премиум';
                    $subscribe_block_send = sprintf($block_subscribe, 'Продлить Премиум', 'premium', $price_premium[0],$price_premium[1],$price_premium[2]);
                    $sub_change = sprintf($bloch_sub_change, 'premium', 'Стандарт');
                }
                
                $subend = date('d.m.Y H:i',$get_profile['0']->subscribe);
            } else {
                $standard_sub = sprintf($block_subscribe, 'Купить Стандарт', 'standart', $price_standart[0],$price_standart[1],$price_standart[2]);
                $premium_sub = sprintf($block_subscribe, 'Купить Премиум', 'premium', $price_premium[0],$price_premium[1],$price_premium[2]);
                $subscribe_block_send = $standard_sub.$premium_sub;
            }
            
            
            $html = file_get_contents("./loadhtml/main/subscribe.php");



        $back_img = sprintf('<div id=imgback style="%s"></div>', 'background: url(http://SITE/imgs/users/banner/'.$get_profile['0']->banner.');background-size: cover;background-position: center;');
                    
        $border = '';
        if ($get_profile[0]->subscribe >= time()){
            $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->position.'');
        
        }
        $ava_img = sprintf('<div id=subs><div id=ava-prof style="%s">%s</div></div>', 'background: url(http://SITE/imgs/users/ava/'.$get_profile['0']->avatar.');background-size: cover;',$border);
   
            
            $id_auth = '';
            $user_id = $this->my_user_id;
            if ($user_id != null){
                $id_auth = 'id: '.$user_id.',';
            }
            if ($this->main->is_admin == true){
                $is_admin = 'admin: 1,';
            } else {
                $is_admin = 'admin: 0,';
            }

            $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';


            $info_user = sprintf('
            infouser = {
                %s
                %s
                %s
            };

            ', $id_auth,$is_admin,$token);

        

            $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
            $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
            $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Настройки профиля', $html); // title
            $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
            $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
            $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
            
            $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
            $html = str_replace('{{ PROFILE.IMAGE.BACK }}', $back_img, $html); // Задняя картинка профиля
            $html = str_replace('{{ PROFILE.IMAGE.AVATAR }}', $ava_img, $html); // Аватар профиля
            $html = str_replace('{{ PROFILE.ID }}', $id_user, $html); // id профиля
            $html = str_replace('{{ PROFILE.NAME }}', $name_user, $html); // Ник профиля
            
            $html = str_replace('{{ PROFILE.MONEY }}', $money_user, $html); // Баланс
            $html = str_replace('{{ PROFILE.SUBSCRIBE }}', $subscribe, $html); // 
            $html = str_replace('{{ PROFILE.SUBEND }}', $subend, $html); // 
            $html = str_replace('{{ SUBSCRIBE.TYPEBUY }}', $subscribe_block_send, $html); // 
            $html = str_replace('{{ SUBSCRIBE.CHANGE }}', $sub_change, $html); // 
            
            
            
            
            $html = str_replace('{{ PROFILE.BTNS }}', $btns, $html); 
            $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
            die($html);
        }
    }
    public function support($numquestion = 0){ // Подписка
        if ($this->my_user_id){ // 
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            
            
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));
                        
            $id_user = $this->my_user_id;
            
            $html = file_get_contents("./loadhtml/main/support.php");



        $back_img = sprintf('<div id=imgback style="%s"></div>', 'background: url(http://SITE/imgs/users/banner/'.$get_profile['0']->banner.');background-size: cover;background-position: center;');
                    
        $border = '';
        if ($get_profile[0]->subscribe >= time()){
            $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->position.'');
        
        }
        $ava_img = sprintf('<div id=subs><div id=ava-prof style="%s">%s</div></div>', 'background: url(http://SITE/imgs/users/ava/'.$get_profile['0']->avatar.');background-size: cover;',$border);
   
            
            $id_auth = '';
            $user_id = $this->my_user_id;
            if ($user_id != null){
                $id_auth = 'id: '.$user_id.',';
            }
            if ($this->main->is_admin == true){
                $is_admin = 'admin: 1,';
            } else {
                $is_admin = 'admin: 0,';
            }

            $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';


            $info_user = sprintf('
            infouser = {
                %s
                %s
                %s
            };

            ', $id_auth,$is_admin,$token);
            
            $namepage = 'Задать вопрос';
            if ($numquestion != '0'){
                $namepage = 'Обращение №: '.$numquestion;
                $get_dialog = json_decode($this->api->getsupport_dialog($numquestion,$user_id));
                if (!isset($get_dialog[0]->closed)){
                    header("Location: ../support");
                    die();
                }
                if ($get_dialog[0]->closed == 1){
                    $sup_status = 'Закрыта';
                } else {
                    $sup_status = 'Открыта';
                }
                $sup_messages = '';
                if (isset($get_dialog[0]->iduser)){
                    foreach($get_dialog as $gd){
                        if ($gd->iduser == 0){
                            $gdavatar = 'agent.jpg';
                            $gdlogin = 'Агент поддержки';
                            $background_clr = '#FFE0DD';
                            $border_user = '';
                        } else {
                            $gdavatar = $gd->avatar;
                            $gdlogin = $gd->login;
                            $background_clr = '#FBFFEF';
                            $border_user = '';
                            if ($gd->subscribe > time()){
                                $border = $gd->src;
                                $border_pos = $gd->small_pos;
                                $border_user = sprintf('<div id="border_user" style="background: url(http://SITE/imgs/users/borders/%s);%s"></div>', $border, $border_pos);
                            }
                        }
                        $sup_messages .= sprintf('<div style="background:%s;" id="sup_dialog_block">
                                            <div id="sup_name_user">
                                                <div style="background:url(http://SITE/imgs/users/ava/%s);" id="sup_name_avatar">%s</div>
                                                <div id="sup_name_name">%s</div>
                                                <div id="sup_name_date">%s</div>
                                            </div>
                                            <div id="sup_message">
                                                %s
                                            </div>
                                        </div>',$background_clr, $gdavatar, $border_user, $gdlogin, date('d.m H:i',$gd->date), $gd->msg);
                    }
                }
                $sup_page = sprintf('<div>Тема обращения: %s</div>
                                <div>Описание обращения: %s</div>
                                <div>Статус заявки: %s</div>
                                <input hidden name=hash value=%s>
                                
                                <div id="sup_dialog">
                                    %s
                                </div>
                                <div style="display: flex;">
                                    <div>
                                        <div name="msg_sup" id="inputtext" placeholder="Отправить сообщение" contenteditable="true"></div>
                                    </div>
                                    <a class="sendquestion" style="padding:0;" id="buttonred">Отправить</a>
                                </div>', $get_dialog[0]->nametheme, $get_dialog[0]->question,$sup_status, $numquestion, $sup_messages);
            } else {
                $sup_page = '<div class="unfoot-block-text">
                                    <div>Раздел</div>
                                    <div>
                                        <select name="section" id="selectfield">
                                            <option selected="" value="0">Другое</option>
                                            <option value="1">Проблема с аккаунтом</option>
                                            <option value="2">Проблема с сайтом</option>
                                            <option value="3">Улучшение проекта</option>
                                            <option value="4">Вопрос на миллион</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="unfoot-block-text">
                                    <div>Тема</div>
                                    <div>
                                        <input placeholder="Опишите вопрос в двух словах" name="theme_support" id="inprofile" type="text" value="">
                                    </div>
                                </div>
                                <div class="unfoot-block-text">
                                    <div>Подробное описание</div>
                                    <div>
                                        <textarea name="msg_support" id="inprofile" style="height: 95px; max-width: 288px; width: 275px; max-height: 200px;"></textarea>
                                    </div>
                                </div>
                                <div class="unfoot-block-text">
                                    <div id="saveblockbtn">
                                        <a class="sendquestion" id="buttonred">Задать вопрос</a>
                                        <div><div id="textsaved">Отправлено</div></div>
                                    </div>
                                </div>';
            }

            $get_sup = json_decode($this->api->getsupport($id_user));
            if ($numquestion == 0){
                $class_check = 'class="checkedlink"';
            } else {
                $class_check = '';
            }
            $quests = '<div><a style="display:flex;align-items:center;" '.$class_check.' id=settingslink href=/support><div><svg style="position:inherit;" width="20" height="20" viewBox="0 0 113 113" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M35.9899 56.2152H56.8608M56.8608 56.2152H77.7317M56.8608 56.2152V35.3443M56.8608 56.2152V77.0861" stroke="white" stroke-width="7.82658" stroke-linecap="round" stroke-linejoin="round"></path>
<path d="M56.8608 108.392C85.6772 108.392 109.038 85.0316 109.038 56.2152C109.038 27.3985 85.6772 4.03797 56.8608 4.03797C28.0441 4.03797 4.68356 27.3985 4.68356 56.2152C4.68356 85.0316 28.0441 108.392 56.8608 108.392Z" stroke="white" stroke-width="7.82658" stroke-linecap="round" stroke-linejoin="round"></path>
</svg></div><div>Новое обращение</div>
</a></div>';
            foreach($get_sup as $sup){
                $hash_sup = md5($sup->id . 'MweN4');
                if (mb_strlen($sup->nametheme)>20){
                    $qstr = mb_substr($sup->nametheme, 0, 17).'...';
                } else{
                    $qstr = $sup->nametheme;
                }
                $class_check_que = '';
                if ($numquestion == $hash_sup){
                    $class_check_que = 'class="checkedlink"';
                }
                $quests .= sprintf('<div><a %s id=settingslink href=/support/%s>%s</a></div>', $class_check_que, $hash_sup, $qstr);
            }
        
            $name_user = $get_profile['0']->login;
            $btns = '';

            $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
            $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
            $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Поддержка', $html); // title
            $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
            $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
            $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
            
            $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
            $html = str_replace('{{ PROFILE.IMAGE.BACK }}', $back_img, $html); // Задняя картинка профиля
            $html = str_replace('{{ PROFILE.IMAGE.AVATAR }}', $ava_img, $html); // Аватар профиля
            $html = str_replace('{{ PROFILE.ID }}', $id_user, $html); // id профиля
            $html = str_replace('{{ PROFILE.NAME }}', $name_user, $html); // Ник профиля
            
            $html = str_replace('{{ SUPPORT.QUETIONS }}', $quests, $html); // Список обращений
            $html = str_replace('{{ SUPPORT.NAMEPAGE }}', $namepage, $html); // Список обращений
            $html = str_replace('{{ SUPPORT.PAGE }}', $sup_page, $html); // Список обращений
            
            $html = str_replace('{{ PROFILE.BTNS }}', $btns, $html); 
            $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
            die($html);
        }
    }
    public function social($soclink = 0){ // Привязка соц сетей
        if ($this->my_user_id){ // 
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            
            
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));
                        
            $id_user = $this->my_user_id;
            
            $html = file_get_contents("./loadhtml/main/social.php");



        $back_img = sprintf('<div id=imgback style="%s"></div>', 'background: url(http://SITE/imgs/users/banner/'.$get_profile['0']->banner.');background-size: cover;background-position: center;');
                    
        $border = '';
        if ($get_profile[0]->subscribe >= time()){
            $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->position.'');
        
        }
        $ava_img = sprintf('<div id=subs><div id=ava-prof style="%s">%s</div></div>', 'background: url(http://SITE/imgs/users/ava/'.$get_profile['0']->avatar.');background-size: cover;',$border);
   
            
            $id_auth = '';
            $user_id = $this->my_user_id;
            if ($user_id != null){
                $id_auth = 'id: '.$user_id.',';
            }
            if ($this->main->is_admin == true){
                $is_admin = 'admin: 1,';
            } else {
                $is_admin = 'admin: 0,';
            }

            $token = 'token: "'.hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445')).'",';


            $info_user = sprintf('
            infouser = {
                %s
                %s
                %s
            };

            ', $id_auth,$is_admin,$token);
            
            $get_sup = json_decode($this->api->get_social_notice($id_user));
            
            $vk = '<a id=buttonred>Привязать аккаунт вк</a>';
            $tg = '<a id=buttonred>Привязать аккаунт telegram</a>';
            if (count($get_sup)>0){
                if ($get_sup[0]->vk != 0){
                    $vk = '<a class=push_vk id=buttonred>Включить</a>';
                    if ($get_sup[0]->vkstatus != 0)
                    $vk = '<a class=push_vk id=button>Отключить</a>';
                    }
                if ($get_sup[0]->tg != 0){
                    $tg = '<a class=push_tg id=buttonred>Включить</a>';
                    if ($get_sup[0]->tgstatus != 0)
                    $tg = '<a class=push_tg id=button>Отключить</a>';
                }
            }
            
        
            $name_user = $get_profile['0']->login;
            $btns = '';

            $html = str_replace('{{ MAIN.DOWNSCRIPT }}', $this->get_allpage('downscript'), $html); // downscript
            $html = str_replace('{{ MAIN.DOWNSITE }}', $this->get_allpage('downsite'), $html); // downsite
            $html = str_replace('{{ MAIN.TITLE }}', $this->get_allpage('title') . ' - Настройки профиля', $html); // title
            $html = str_replace('{{ MAIN.HEAD }}', $this->get_allpage('head'), $html); // head
            $html = str_replace('{{ MAIN.TOPMENU }}', $this->get_allpage('topmenupages'), $html); // topmenu
            $html = str_replace('{{ USER.PROFILE }}', $info_user, $html); // профиль
            
            $html = str_replace('{{ MAIN.AUTH.PROFILE }}', $this->get_auth_prof(), $html); // профиль
            $html = str_replace('{{ PROFILE.IMAGE.BACK }}', $back_img, $html); // Задняя картинка профиля
            $html = str_replace('{{ PROFILE.IMAGE.AVATAR }}', $ava_img, $html); // Аватар профиля
            $html = str_replace('{{ PROFILE.ID }}', $id_user, $html); // id профиля
            $html = str_replace('{{ PROFILE.NAME }}', $name_user, $html); // Ник профиля
            
            
            $html = str_replace('{{ SOCIAL.VK }}', $vk, $html); //
            $html = str_replace('{{ SOCIAL.TG }}', $tg, $html); //
            
            
            $html = str_replace('{{ PROFILE.BTNS }}', $btns, $html); 
            $html = str_replace('{{ SCRIPT.PROFILE }}', $this->get_prof_script(), $html); 
            die($html);
        }
    }
    
    
    public function get_auth_prof(){
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));            
                if ($this->main->is_auth){
                    if ($get_profile['0']->subscribe > time()){
                        $border = sprintf('<div id=border_user style="%s"></div>', 'background: url(http://SITE/imgs/users/borders/'.$get_profile['0']->src.');'.$get_profile['0']->small_pos.'');
                    } else {
                        $border = '';
                    }
                    $auth_prof = sprintf("<div class=iconprofile><ul><li><div id=menu-profile><div><div id=subs><div id=ava-prof style='background: url(http://SITE/imgs/users/ava/%s);background-size: cover;'>%s</div></div></div></div><div id=menu-show-profile><a href='../id%s'>Профиль</a>%s<a href='../editprofile'>Настройки</a><a href='../support'>Поддержка</a><a href='../exit'>Выйти</a></div></li></ul></div><div id=menu_mobile_icon><svg width='114' height='91' viewBox='0 0 114 91' fill='none' xmlns='http://www.w3.org/2000/svg'>
<path d='M5.25317 5.03797H109.076' stroke='white' stroke-width='8.6519' stroke-linecap='round' stroke-linejoin='round'/>
<path d='M5.25317 45.4135H109.076' stroke='white' stroke-width='8.6519' stroke-linecap='round' stroke-linejoin='round'/>
<path d='M5.25317 85.789H109.076' stroke='white' stroke-width='8.6519' stroke-linecap='round' stroke-linejoin='round'/>
</svg>
</div><div id=menublock_mobile style=display:none;><nav><ul><li><a class='menumobileclose' href='../' id=mainpage>Главная</a></li><li><a class='menumobileclose' href='../#series' id=seriespage>Серии</a></li><li><a class='menumobileclose' href='../#fullmovie' id=fullmoviepage>Полнометражные</a></li>
                <li><a class='menumobileclose' href='../#favorite' id=favoritepage>Мой список</a></li></ul><ul><li><a class='menumobileclose' href='../id%s' id=mainpage>Профиль</a></li><li><a class='menumobileclose' href='../editprofile' id=seriespage>Настройки</a></li><li><a class='menumobileclose' href='../support' id=fullmoviepage>Поддержка</a></li><li><a class='menumobileclose' href='../exit' id=fullmoviepage>Выход</a></li></ul></nav></div>", $get_profile['0']->avatar,$border, $this->my_user_id,($this->main->is_admin == 1) ? '<a href=../adminpanel>Админка</a>' : '',$this->my_user_id);
                } else {
                    $auth_prof = "<a id=buttonred href='../authvk/'><div>Войти</div></a><div id=menu_mobile_icon><svg width='114' height='91' viewBox='0 0 114 91' fill='none' xmlns='http://www.w3.org/2000/svg'>
<path d='M5.25317 5.03797H109.076' stroke='white' stroke-width='8.6519' stroke-linecap='round' stroke-linejoin='round'/>
<path d='M5.25317 45.4135H109.076' stroke='white' stroke-width='8.6519' stroke-linecap='round' stroke-linejoin='round'/>
<path d='M5.25317 85.789H109.076' stroke='white' stroke-width='8.6519' stroke-linecap='round' stroke-linejoin='round'/>
</svg>
</div><div id=menublock_mobile style=display:none;><nav><ul><li><a class='menumobileclose' href='../' id=mainpage>Главная</a></li><li><a class='menumobileclose' href='../#series' id=seriespage>Серии</a></li><li><a class='menumobileclose' href='../#fullmovie' id=fullmoviepage>Полнометражные</a></li>
                <li><a class='menumobileclose' href='../#favorite' id=favoritepage>Мой список</a></li></ul></nav></div>";
                }
            return $auth_prof;
    }
    public function get_auth_notice(){
            $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
            $get_profile = json_decode($this->api->getprofile($token,$this->my_user_id));            
                if ($this->main->is_auth){
                    $auth_prof = sprintf("<div><ul><li><div id=menu-notice><svg width='114' height='125' viewBox='0 0 114 125' fill='none' xmlns='http://www.w3.org/2000/svg'>
<path d='M91.8608 42.0337C91.8608 32.2218 88.2069 22.8118 81.702 15.8738C75.1976 8.93571 66.3759 5.03797 57.1772 5.03797C47.9786 5.03797 39.1567 8.93571 32.6523 15.8738C26.1478 22.8118 22.4937 32.2218 22.4937 42.0337C22.4937 85.1957 5.15192 97.5274 5.15192 97.5274H109.203C109.203 97.5274 91.8608 85.1957 91.8608 42.0337Z' stroke='white' stroke-width='8.67089' stroke-linecap='round' stroke-linejoin='round'/>
<path d='M67.1776 114.869C66.1614 116.621 64.7029 118.076 62.9474 119.086C61.1924 120.097 59.2027 120.63 57.1772 120.63C55.1517 120.63 53.162 120.097 51.407 119.086C49.652 118.076 48.193 116.621 47.1768 114.869' stroke='white' stroke-width='8.67089' stroke-linecap='round' stroke-linejoin='round'/>
</svg><div id=menu-notice-count></div>
</div><div id=menu-show-notice>Нет уведомлений!</div></li></ul></div>");
                } else {
                    $auth_prof = "";
                }
            return $auth_prof;
    }
    public function get_search(){
            $search = sprintf("
            <div>
                <ul>
                    <li>
                        <div id=menu-search>
                            <svg width='116' height='116' viewBox='0 0 116 116' fill='none' xmlns='http://www.w3.org/2000/svg'>
<path d='M84.1899 84.0759L110.203 110.089' stroke='white' stroke-width='11.1483' stroke-linecap='round' stroke-linejoin='round'/>
<path d='M6.15192 50.6311C6.15192 75.2591 26.1169 95.2242 50.745 95.2242C63.0802 95.2242 74.2464 90.2157 82.3192 82.1213C90.3645 74.0551 95.3382 62.9239 95.3382 50.6311C95.3382 26.003 75.3731 6.03797 50.745 6.03797C26.1169 6.03797 6.15192 26.003 6.15192 50.6311Z' stroke='white' stroke-width='11.1483' stroke-linecap='round' stroke-linejoin='round'/>
</svg>
                        </div>
            <div id=menu-show-search>
                <input placeholder='Поиск' id=inp_search>
                <div id=ressearch>Не найдено!</div>
                </div>
                    </li>
                </ul>
            </div>");
               
            return $search;
    }
    
    
    public function get_prof_script(){
        $sc = file_get_contents('./js/dec/getprof_dec.js');
        return $sc;
    }
    
    private function get_allpage($type){
        if ($type == 'title'){
            $getthis = 'AnimeStart';
            return $getthis;
        }
        if ($type == 'topmenu'){
            $getthis = '        
<div id=topblock>
    <div id=logo>
        AnimeStart
    </div>
    <div id=menublock>
        <nav>
            <ul>
                <li><span class=menuchecked id=mainpage><a href="../" id=mainpage>Главная</a><div id=spanchecked></div></span></li>
                <li><span class="menuchecked hidecheck" id=seriespage><a href=#series  id=seriespage>
Серии</a><div id=spanchecked></div></span></li>
                <li><span class="menuchecked hidecheck" id=fullmoviepage><a href=#fullmovie id=fullmoviepage>
Полнометражные</a><div id=spanchecked></div></span></li>
                <li><span class="menuchecked hidecheck" id=favoritepage><a href=#favorite id=favoritepage>
Мой список</a><div id=spanchecked></div></span></li>
            </ul>
        </nav>
    </div>
    <div id=toprightblock>
                    '.$this->get_search().'
                    '.$this->get_auth_notice().'
                    '.$this->get_auth_prof().'
                </div>
            </div>';
            return $getthis;
        }
        if ($type == 'topmenupages'){
            $getthis = '        
<div id=topblock>
    <div id=logo>
        AnimeStart
    </div>
    <div id=menublock>
        <nav>
            <ul>
                <li><span class="menuchecked hidecheck" id=mainpage><a href="../" id=mainpage>Главная</a><div id=spanchecked></div></span></li>
                <li><span class="menuchecked hidecheck" id=seriespage><a href="../#series" id=seriespage>Серии</a><div id=spanchecked></div></span></li>
                <li><span class="menuchecked hidecheck" id=fullmoviepage><a href="../#fullmovie" id=fullmoviepage>Полнометражные</a><div id=spanchecked></div></span></li>
                <li><span class="menuchecked hidecheck" id=favoritepage><a href="../#favorite" id=favoritepage>Мой список</a><div id=spanchecked></div></span></li>
            </ul>
        </nav>
    </div>
    <div id=toprightblock>
        '.$this->get_search().'
        '.$this->get_auth_notice().'
        '.$this->get_auth_prof().'
    </div>
</div>';    
            return $getthis;
        }
        if ($type == 'head'){
            $getthis = '
    <link rel="shortcut icon" href="../imgs/favicon.ico">
    <link href="../css/chat.css" type="text/css" rel="stylesheet"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui, user-scalable=no" />';
            return $getthis;
        }
        if ($type == 'upsite'){
            $getthis = '';
            return $getthis;
        }
        if ($type == 'downscript'){
            $getthis = '
<script src="../js/dec/chat_dec.js"></script>';
            return $getthis;
        }
        if ($type == 'downsite'){
            $getthis = file_get_contents('./loadhtml/chat.php');
            $popmess = '<div id="popmess">
                            <div id="textmess">
                                <div class=closepop id=closepop><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></div><div id=namepop></div>
                                <div id=popmesstext></div>
                            </div>
                            <div id=popbackgr></div>
                        </div>
                        <div id="hint">
                        </div>';
            $getthis .=$popmess;
            return $getthis;
        }
        
    }   
    
}
?>