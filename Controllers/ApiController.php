<?php
require_once __DIR__ . "/Controller.php";
require_once './classes/Main.php';

class ApiController extends \Controller
{    
    public $my_user_id;
    
    public function __construct () {
        parent::__construct();
        $this->main = new Main();
        $this->my_user_id = $this->main->my_id;
        
        if ($this->main->is_banned){
            die('Аккаунт забанен<a href="../exit" style="color:red">Выйти</a>');
        }
        
        if ($this->PROTECT()){
            header("Location: ../captcha.php");
            die();
        }     
        
    }
    
    
    
    public function getfullcontent($last_s_e = 0,$tokenget){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        $getcontents = $this->Query("SELECT `id`,`prev`,`banner`,`name`,`description`,`origname`,JSON_QUERY(genre, '$') AS genres,`year`,`rating`,`watchyear`,`trailer`,`teaser`,`link`,`type`,`status` FROM `anime` WHERE 1 ORDER BY `id` DESC", []);
        
        
        $arrayjson = array();
        
        
        for($i=0;$i<=count($getcontents)-1;$i++){
                $arrayjson[$i]['id'] = $getcontents[$i]['id'];
                $arrayjson[$i]['banner'] = $getcontents[$i]['banner'];
                $arrayjson[$i]['prev'] = $getcontents[$i]['prev'];
                $arrayjson[$i]['name'] = $getcontents[$i]['name'];
                $arrayjson[$i]['description'] = $getcontents[$i]['description'];
                $arrayjson[$i]['origname'] = $getcontents[$i]['origname'];
                
                $arrayjson[$i]['genre'] = json_decode($getcontents[$i]['genres'],true);
                
                $arrayjson[$i]['year'] = $getcontents[$i]['year'];
                $arrayjson[$i]['rating'] = $getcontents[$i]['rating'];
                $arrayjson[$i]['watchyear'] = $getcontents[$i]['watchyear'];
                $arrayjson[$i]['trailer'] = $getcontents[$i]['trailer'];
                $arrayjson[$i]['teaser'] = $getcontents[$i]['teaser'];
                $arrayjson[$i]['link'] = $getcontents[$i]['link'];
                $arrayjson[$i]['type'] = $getcontents[$i]['type'];
                $arrayjson[$i]['status'] = $getcontents[$i]['status'];
                if ($last_s_e == 1){
                    $getlast = $this->Query("SELECT * FROM episodes WHERE `id_anime` = ".$getcontents[$i]['id']." ORDER BY `season` DESC, `episode` DESC LIMIT 1;", []);
                    if (count($getlast)>0){
                        $arrayjson[$i]['ep'] = $getlast[0]['episode'];
                        $arrayjson[$i]['se'] = $getlast[0]['season'];
                    } else {
                        $arrayjson[$i]['ep'] = '0';
                        $arrayjson[$i]['se'] = '0';
                    }

                } 
                
                $get_fav = json_decode($this->my_favorite_id($token,$getcontents[$i]['id'],$this->my_user_id),true);
                if (isset($get_fav)){
                    $arrayjson[$i]['in_fav'] = $get_fav['in_fav'];
                }
                $get_view = json_decode($this->my_view_id($token,$getcontents[$i]['id'],$this->my_user_id),true);
                if (isset($get_view)){
                    $arrayjson[$i]['in_view'] = $get_view['in_view'];
                }
            
        }
        $jsondata = json_encode($arrayjson);
        return $jsondata;
    }   
    public function delanmecontent(){
        $jsondata = json_decode($_POST['sendadddata'], true);    
        $tokenget = $jsondata['token'];   
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id = $jsondata['id'] ;
        $getcontents = $this->Query("DELETE FROM `anime` WHERE `id`='$id'", []);
    }
    public function saveanmecontent(){
        $jsondata = json_decode($_POST['sendadddata'], true);
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id = $jsondata['id'] ;
        $prev = $jsondata['prev'] ;
        $banner = $jsondata['banner'] ;
        $name = $jsondata['name'] ;
        $description = $jsondata['description'];
        $origname = $jsondata['origname'];
        $genre = json_encode($jsondata['genre'],JSON_UNESCAPED_UNICODE);
        $year = $jsondata['year'];
        $watchyear = $jsondata['watchyear'];
        $link = $jsondata['link'];
        $type = $jsondata['type'];
        $status = $jsondata['status'];
        
        $getcontents = $this->Query("UPDATE `anime` SET `prev`='$prev', `banner`='$banner', `name`='$name', `description`='$description', `origname`='$origname', `genre`='$genre', `year`='$year', `watchyear`='$watchyear', `link`='$link', `type`='$type', `status`='$status' WHERE `id`='$id'", []);

        
    }
    public function addanmecontent(){
        $jsondata = json_decode($_POST['sendadddata'], true);
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $prev = $jsondata['prev'] ;
        $banner = $jsondata['banner'] ;
        $name = $jsondata['name'] ;
        $description = $jsondata['description'];
        $origname = $jsondata['origname'];
        $genre = json_encode($jsondata['genre'],JSON_UNESCAPED_UNICODE);
        $year = $jsondata['year'];
        $watchyear = $jsondata['watchyear'];
        $link = $jsondata['link'];
        $type = $jsondata['type'];
        $status = $jsondata['status'];
        
        $getcontents = $this->Query("INSERT INTO `anime`(`prev`, `banner`, `name`, `description`, `origname`, `genre`, `year`, `watchyear`, `link`, `type`, `status`) VALUES ('$prev','$banner','$name','$description','$origname','$genre','$year','$watchyear','$link','$type','$status')", []);
    }
    
    
    public function addgenre(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        if (isset($_POST['namegenre'])) { $namegenre=trim(stripslashes(htmlspecialchars($_POST['namegenre'])));}
        $getcontents = $this->Query("INSERT INTO `genre` (`namegenre`) VALUES ('$namegenre')", []);
    }    
    public function delgenre(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        if (isset($_POST['idgenre'])) { $idgenre=trim(stripslashes(htmlspecialchars($_POST['idgenre'])));}
        $getcontents = $this->Query("DELETE FROM `genre` WHERE `idgenre`='$idgenre'", []);
    }   
    public function savegenre(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        if (isset($_POST['idgenre'])) { $idgenre=trim(stripslashes(htmlspecialchars($_POST['idgenre'])));}
        if (isset($_POST['namegenre'])) { $namegenre=trim(stripslashes(htmlspecialchars($_POST['namegenre'])));}
        $getcontents = $this->Query("UPDATE `genre` SET `namegenre`='$namegenre' WHERE `idgenre`='$idgenre'", []);
    }
    public function getgenre($tokenget){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $getcontents = $this->Query("SELECT * FROM `genre` ORDER BY `genre`.`namegenre` ASC", []);
        $jsondata = json_encode($getcontents);
        return $jsondata;
    }
    
    public function getcontent(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        if (isset($_POST['genres']) AND $_POST['genres'] != NULL){
            $genres = explode(' ', $_POST['genres']);
            $query_genres = '';
            foreach ($genres as $genre){
                $query_genres .= " JSON_SEARCH(an.genre, 'one', '$genre') IS NOT NULL AND";
            }
        } else {
            $query_genres = '';
        }
        if (isset($_POST['counry']) AND $_POST['counry'] != NULL){
            if ($_POST['counry'] == '1 2'){
                $query_country = '';
            } else {
                if ($_POST['counry'] == '1'){
                    $query_country = ' an.country=1 AND';
                }
                if ($_POST['counry'] == '2'){
                    $query_country = ' an.country=2 AND';
                }
            }
        } else {
            $query_country = '';
        }
        
        $type = $_POST['type'];
        $lastsort = $_POST['lastsort'];
        
        $sortanimeorder = '';
        if ($lastsort == 'last'){
            $sortanimeorder = 'ORDER BY an.`id` DESC';
        }
        if ($lastsort == 'rating'){
            $sortanimeorder = 'ORDER BY an.`rating` DESC';
        }
        if ($lastsort == 'year'){
            $sortanimeorder = 'ORDER BY an.`year` DESC';
        }
        
        
        $years = explode(' ', $_POST['year']);
        
        $query_years = "an.`year` >= ".$years['0']." AND an.`year` <= ".$years['1'];
        
        $rating = explode(' ', $_POST['rating']);
        
        $query_rating = "an.`rating` >= ".$rating['0']." AND an.`rating` <= ".$rating['1'];
        
        
            if (isset($this->my_user_id)){
                $user_id = $this->my_user_id;
            } else {
                $user_id = 0;
            }
        
        $getcontents = $this->Query("SELECT an.`id`,an.`link`,an.`name`,an.`prev`,an.`year`,an.`rating`,an.`genre`,IF(mw.divi, 'true','false') as myview,IF(fv.idfav, 'true','false') as favorite FROM `anime` as an LEFT JOIN myview as mw ON mw.idanime=an.id AND mw.iduser=$user_id LEFT JOIN favorite as fv ON fv.idanime=an.id AND fv.iduser=$user_id WHERE $query_country $query_genres $query_years AND $query_rating AND an.`status`=1 AND an.`type`=$type $sortanimeorder", []);
        
        $arrayjson = array();
        
        for($i=0;$i<=count($getcontents)-1;$i++){
            $arrayjson[$i]['id'] = $getcontents[$i]['id'];
            $arrayjson[$i]['prev'] = $getcontents[$i]['prev'];
            $arrayjson[$i]['name'] = $getcontents[$i]['name'];
            $arrayjson[$i]['link'] = $getcontents[$i]['link'];

            $arrayjson[$i]['genre'] = json_decode($getcontents[$i]['genre'],true);

            $arrayjson[$i]['year'] = $getcontents[$i]['year'];
            $arrayjson[$i]['rating'] = $getcontents[$i]['rating'];
            $arrayjson[$i]['myview'] = $getcontents[$i]['myview'];
            $arrayjson[$i]['favorite'] = $getcontents[$i]['favorite'];
            
        }
        $jsondata = json_encode($arrayjson);
        return $jsondata;

    }
    
    public function getepisodes($tokenget,$id_anime,$last = 0, $idseasonlast='s',$adminhide = 0){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $get_id = $this->Query("SELECT id FROM anime WHERE link='$id_anime'",[]);
        $id_anime = $get_id[0]['id'];
        
        if ($adminhide == 1){
            $hide = '';
        } else {
            $hide = 'AND hide=0';
        }
        
        $get_last = '';
        if (isset($last) AND $last==1){
            $get_last = "WHERE `id_anime` = $id_anime $hide ORDER BY `season` DESC, `episode` DESC";
        } else {
            $get_last = "WHERE `id_anime` = $id_anime $hide ORDER BY `season` ASC, `episode` ASC";
        }
        if ($idseasonlast == '0'){
            return;
        }
        if ($idseasonlast != 's'){
            $get_last = "WHERE `id_anime` = $id_anime AND `season`=$idseasonlast $hide ORDER BY `season` DESC, `episode` DESC LIMIT 1";
        }
        
        $getcontents = $this->Query("SELECT * FROM `episodes` $get_last", []);
        $getmyhis = $this->Query("SELECT id_anime,episodes.season,episodes.episode,time,duration,fullmovie FROM `episodes`,`history_view` WHERE `id_anime` = $id_anime AND id_anime=idanime AND history_view.iduser = $this->my_user_id AND episodes.season=history_view.season AND episodes.episode=history_view.episode ORDER BY episodes.`season` ASC, episodes.`episode` ASC;", []);
        
      
        if (!isset($getcontents) || count($getcontents)<1){
            $sort_cont = [];
            return json_encode(array('cont' => $sort_cont, 'idanime' => $id_anime));
        }
        
        if (count($getcontents) <= 0){
            $sort_cont = ["s" => 0,
                         "e" => 0,];
            die(json_encode($sort_cont));
        }
        if ($last == 1){
            $sort_cont = ["s" => $getcontents[0]['season'],
                         "e" => $getcontents[0]['episode'],];
        } else {
            if ($idseasonlast == 's') {
                $episodes = array();
                $at = array();
                $ep_data = array();

                for($i=0;$i<count($getcontents);$i++){
                    if (isset($episodes['season']) && $episodes['season'] == $getcontents[$i]['season']){
                    } else{
                        $episodes['fullmovie'] = $getcontents[$i]['fullmovie'];
                        $episodes['season'] = $getcontents[$i]['season'];
                        $episodes['items'] = [];
                        $at[] = $episodes;

                    }
                }

                for($i=0;$i<count($getcontents);$i++){
                    for($f=0;$f<count($at);$f++){
                        if ($getcontents[$i]['season'] == $at[$f]['season']){
                            $ep_data['episode'] =           $getcontents[$i]['episode'];
                            $ep_data['name'] =              $getcontents[$i]['name'];
                            $ep_data['link'] =              $getcontents[$i]['link'];
                            $ep_data['sections'] =          $getcontents[$i]['sections']; 
                            
                            $ep_data['time'] =          0;
                            $ep_data['duration'] =      100;

                            for($j=0;$j<count($getmyhis);$j++){
                                if ($getmyhis[$j]['season'] == $at[$f]['season'] && $getmyhis[$j]['episode'] == $getcontents[$i]['episode']){
                                        $ep_data['time'] =          $getmyhis[$j]['time'];
                                        $ep_data['duration'] =      $getmyhis[$j]['duration'];
                                }
                                
                            }
                            
                            $at[$f]['items'][] = $ep_data;
                            
                            
                        }
                    }

                }
                return json_encode(array('cont' => $at, 'idanime' => $id_anime));
            } else {
                $sort_cont = [];
                for ($i=0;$i<count($getcontents); $i++){
                    $sort_cont[$getcontents[$i]['season']][$getcontents[$i]['episode']]['name'] = $getcontents[$i]['name'];
                    $sort_cont[$getcontents[$i]['season']][$getcontents[$i]['episode']]['link'] = $getcontents[$i]['link'];
                }
            }
        }
        return json_encode(array('cont' => $sort_cont, 'idanime' => $id_anime));
    }
    
    public function getinfoanime($tokenget,$id_anime){        
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        if ($this->my_user_id != null){
            $id_user = $this->my_user_id;
        } else {
            $id_user = 0;
        }
        
        $getcontents = $this->Query("SELECT banner,name,description,origname,JSON_QUERY(genre, '$') AS genre,year,rating,watchyear,IF(favorite.idfav, 'true','false') as infav FROM `anime` LEFT JOIN favorite ON favorite.idanime = anime.id AND favorite.iduser = $id_user WHERE `id`=$id_anime", []);
        if (count($getcontents) > 0){
            $getcontents[0]['genre'] = json_decode($getcontents[0]['genre'],true);
            return json_encode($getcontents);
        } else {
            header("Location: ../404.html");
            die();
        }
        
        
    }
    public function getepisode($tokenget,$id_anime, $season, $episode, $hide=0){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        if ($hide == 1){
            $wherehide = '';
        } else {
            $wherehide = 'AND hide=0';
        }
        
        $getcontents = $this->Query("SELECT episodes.id,id_anime,season,episode,anime.name as animename,episodes.name,episodes.link,JSON_QUERY(sections, '$') AS sections,poster, hide FROM `episodes`,`anime` WHERE id_anime=anime.id AND `id_anime` = $id_anime AND `season` = $season AND `episode` = $episode $wherehide", []);
        
        if (count($getcontents)<1){
            return;
        }
        
        $arrayjson = array();
        $arrayjson['id'] = $getcontents[0]['id'];
        $arrayjson['id_anime'] = $getcontents[0]['id_anime'];
        $arrayjson['animename'] = $getcontents[0]['animename'];
        $arrayjson['season'] = $getcontents[0]['season'];
        $arrayjson['episode'] = $getcontents[0]['episode'];
        $arrayjson['name'] = $getcontents[0]['name'];
        $arrayjson['poster'] = $getcontents[0]['poster'];
        $arrayjson['hide'] = $getcontents[0]['hide'];
        $arrayjson['link'] = $getcontents[0]['link'];
        
        $filename = $getcontents[0]['link'];
        $filename = str_replace('http://SITE/sys/upload/files/', '', $filename);
        $filename = str_replace('/master.m3u8', '', $filename);
        
        $arrayjson['filename'] = $filename;

        $arrayjson['sections'] = json_decode($getcontents[0]['sections'],true);

        
        return json_encode($arrayjson);
    }
    
    public function addepisode(){
        $jsondata = json_decode($_POST['sendadddata'], true);  
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $idanime = $jsondata['idanime'] ;
        $link = $jsondata['link'] ;
        $episode = $jsondata['episode'] ;
        $season = $jsondata['season'];
        $nameep = $jsondata['nameep'];
        $poster = $jsondata['poster'];
        $hide = $jsondata['hide'];
        $sections = json_encode($jsondata['sections']);
        $getepisode = $this->Query("SELECT season,episode,anime.name FROM `episodes` LEFT JOIN anime on episodes.id_anime=anime.id WHERE `id_anime`=$idanime AND `season`=$season AND `episode`=$episode",[]);
        
        if ($getepisode){
            $this->Query("UPDATE `episodes` SET id_anime='$idanime', season='$season', episode='$episode', name='$nameep', link='$link', poster='$poster', hide='$hide', sections='$sections' WHERE id_anime='$idanime' AND season='$season' AND episode='$episode'",[]);
            if ($hide == 0){
                
                $get_notice_users = $this->Query("SELECT vk,tg FROM `user_follow_anime` as uf LEFT JOIN `user_notice_social` as un on un.iduser=uf.iduser and uf.idanime = '$idanime' WHERE vkstatus != 0 OR tgstatus != 0",[]);
                
                $an_name = $getepisode[0]['name'];
                $values_rcon = '';
                for ($i=0;$i<count($get_notice_users); $i++){
                    $vkuser = $get_notice_users[$i]['vk'];
                    $tguser = $get_notice_users[$i]['tg'];
                    if (count($get_notice_users)-1 == $i){
                        $values_rcon .= "('Вышла новая серия $an_name $season сезон $episode серия
                        http://yandex.ru/','$vkuser','$tguser')";
                    } else {
                        $values_rcon .= "('Вышла новая серия $an_name $season сезон $episode серия
                        http://yandex.ru/','$vkuser','$tguser'),";
                    }
                }
                
                $this->Query("INSERT INTO `user_notice_social_cron` (`msg`,`vk`,`tg`) VALUES $values_rcon",[]);
                
            }
        } else {
            $this->Query("INSERT INTO `episodes`(`id_anime`, `season`, `episode`, `name`, `link`,`poster`,`hide`) VALUES ('$idanime','$season','$episode','$nameep','$link','$poster','1')", []);
        }
        
    }
    
    public function getborders($tokenget){     
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $getdata = $this->Query("SELECT * from `borders`", []);
        
        return json_encode($getdata);
        
    }
    public function getprofile($tokenget,$iduser){     
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $getcontents = $this->Query("SELECT money,small_pos,users.id,avatar,banner,login,users.name,birth,users.city,users.date,lastact,is_admin,subscribe,typesubs,src,position, user_privacy.name as pr_name,user_privacy.date as pr_date, user_privacy.city as pr_city, user_privacy.profile as pr_profile FROM `users` left JOIN borders ON borders.idbor=users.border LEFT JOIN user_privacy ON users.id=user_privacy.iduser WHERE users.`id` = $iduser", []);
        
        $getfriends = $this->Query("SELECT lastact,subscribe,id,avatar,login,IF(friends.idfr, 'true','false') as friend,src,small_pos FROM `users` RIGHT JOIN friends on friends.idsend = users.id AND friends.idto = $iduser OR friends.idto = users.id AND friends.idsend = $iduser LEFT JOIN borders ON borders.idbor=users.border WHERE friends.type = 1 AND friends.idsend = $iduser or friends.type = 1 and friends.idto = $iduser;", []);
        
        
        $getrating = $this->Query("SELECT SUM(uservalue) as rating FROM `comments_rating`,`comments` WHERE comments.id = comments_rating.toidcomm AND comments.iduser = $iduser", []);
        
        if ($getrating){
            if ($getrating[0]['rating'] == null){
                $getcontents[0]['rating'] = 0;
            } else {
                $getcontents[0]['rating'] = $getrating[0]['rating'];
            }
        }
        $getcontents[0]['friends'] = $getfriends;
        
        return json_encode($getcontents);
    }
    public function saveprofile(){   
        $jsondata = json_decode($_POST['sendadddata'], true); 
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        $getusers = $this->Query("SELECT * FROM `users` WHERE `id` = $id_user", []);
        
        if (isset($jsondata['showname']) && $jsondata['showname'] != null){
            if ($jsondata['showname'] == 'hide'){
                $h_name = 1;
            } else {
                $h_name = 0;
            }
            if ($jsondata['showdate'] == 'hide'){
                $h_date = 1;
            } else {
                $h_date = 0;
            }
            if ($jsondata['showcity'] == 'hide'){
                $h_city = 1;
            } else {
                $h_city = 0;
            }
            if ($jsondata['showprofile'] == 'hide'){
                $h_profile = 1;
            } else {
                $h_profile = 0;
            }
            $get_priv = $this->Query("SELECT * FROM `user_privacy` WHERE `iduser` = $id_user", []);
            if (count($get_priv)>0){ // Если существует
                $this->Query("UPDATE `user_privacy` SET `name`='$h_name',`date`='$h_date',`city`='$h_city',`profile`='$h_profile' WHERE `iduser`='$id_user'", []);
            } else {
                $this->Query("INSERT INTO `user_privacy` (`iduser`,`name`,`date`,`city`,`profile`) VALUES ($id_user,$h_name,$h_date,$h_city,$h_profile)",[]);
            }
            die(json_encode(array('success'=>'ok')));
        }
        
        
        $nickname = $jsondata['nickname'] != null ? htmlspecialchars($jsondata['nickname']) : $getusers['0']['login'];
        
        if (mb_strlen($nickname)<3 || mb_strlen($nickname)>20){
            die(json_encode(array('error'=>'Ник должен содержать от 3 до 20 символов.')));
        }
        if (!preg_match("/^[a-z0-9_]+$/i", $nickname))
        {
            die(json_encode(array('error'=>'Ник имеет запрещенные символы. Разрешены только английские буквы и цифры.')));
        }
        
        $get_usernick = $this->Query("SELECT * FROM `users` WHERE `login` = '$nickname'", []);
        if (count($get_usernick)>0 && $nickname != $getusers['0']['login']){
            die(json_encode(array('error'=>'Ник уже занят другим пользователем.')));
        }
        
        $nameuser = $jsondata['nameuser'] != null ? htmlspecialchars($jsondata['nameuser']) : '';
        $birthday = $jsondata['birthday'] != null ? htmlspecialchars($jsondata['birthday']) : $getusers['0']['birth'];
        $birthday = strtotime($birthday);
        $city = $jsondata['city'] != null ? htmlspecialchars($jsondata['city']) : '';
        $border = $jsondata['border'] != null ? htmlspecialchars($jsondata['border']) : $getusers['0']['border'];
        
        if (mb_strlen($nameuser)>30){
            die(json_encode(array('error'=>'Имя должно содержать до 30 символов.')));
        }
        if (mb_strlen($city)>40){
            die(json_encode(array('error'=>'Город должен содержать до 40 символов.')));
        }
        
        if ($jsondata['avatar'] != null){
            if ($id_user.'.png' == $jsondata['avatar']){
                $avatar = $getusers['0']['avatar'];
            } else {
                if (rename ('/var/www/html/imgs/users/temp/'.$jsondata['avatar'], '/var/www/html/imgs/users/ava/'.$id_user.'.png')) {
                    $avatar = $id_user.'.png';
                }
            }
        } else {
            $avatar = 'default.jpg';
            
        }
        if ($jsondata['banner'] != null){
            if ($id_user.'.png' == $jsondata['banner']){
                $banner = $getusers['0']['banner'];
            } else {
                if (rename ('/var/www/html/imgs/users/temp/'.$jsondata['banner'], '/var/www/html/imgs/users/banner/'.$id_user.'.png')) {
                    $banner = $id_user.'.png';
                } 
            }
        } else {
            $banner = 'default.png';
        }
        
        
        $this->Query("UPDATE `users` SET `avatar`='$avatar',`banner`='$banner',`login`='$nickname',`name`='$nameuser',`birth`='$birthday',`city`='$city',`border`='$border'  WHERE `id`='$id_user'", []);

        die(json_encode(array('success'=>'ok')));

    }
    
    public function recanime($tokenget){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $getcontents = $this->Query("SELECT * FROM `rec_anime`,`anime` WHERE `rec_anime`.`id_anime` = `anime`.`id`", []);
        
        $arrayjson = array();
        
        
        for($i=0;$i<=count($getcontents)-1;$i++){
                $arrayjson[$i]['id'] = $getcontents[$i]['id'];
                $arrayjson[$i]['link'] = $getcontents[$i]['link'];
                $arrayjson[$i]['banner'] = $getcontents[$i]['banner'];
                $arrayjson[$i]['prev'] = $getcontents[$i]['prev'];
                $arrayjson[$i]['name'] = $getcontents[$i]['name'];
                $arrayjson[$i]['description'] = $getcontents[$i]['description'];
                $arrayjson[$i]['rating'] = $getcontents[$i]['rating'];
                $arrayjson[$i]['origname'] = $getcontents[$i]['origname'];
                $getlast = $this->Query("SELECT * FROM episodes WHERE `id_anime` = ".$getcontents[$i]['id']." AND hide=0 ORDER BY `season` DESC, `episode` DESC LIMIT 1;", []);
                $arrayjson[$i]['ep'] = $getlast[0]['episode'];
                $arrayjson[$i]['se'] = $getlast[0]['season'];
                $arrayjson[$i]['nameep'] = $getlast[0]['name'];
            
                $get_fav = json_decode($this->my_favorite_id($token,$getcontents[$i]['id'],$this->my_user_id),true);
                if (isset($get_fav)){
                    $arrayjson[$i]['in_fav'] = $get_fav['in_fav'];
                }
                $get_view = json_decode($this->my_view_id($token,$getcontents[$i]['id'],$this->my_user_id),true);
                if (isset($get_view)){
                    $arrayjson[$i]['in_view'] = $get_view['in_view'];
                }
                

        }
        $jsondata = json_encode($arrayjson);
        return $jsondata;
        
        
    }
    public function my_favorite(){          
        $getmyfav = $this->Query("SELECT * FROM `favorite`,`anime` WHERE `favorite`.`idanime` = `anime`.`id` AND `favorite`.`iduser` = ".$this->my_user_id."", []);
        var_dump($getmyfav);
    }    
    public function my_favorite_id($tokenget,$id,$userid){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $userid;        
        $getmyfav = $this->Query("SELECT * FROM `favorite`,`anime` WHERE `favorite`.`idanime` = $id AND `favorite`.`iduser` = ".$id_user." AND `anime`.`id` = `favorite`.`idanime`", []);
        if (count($getmyfav)<1){
            $fav = ['in_fav'=>'no'];
            return json_encode($fav);
        }
        if ($getmyfav[0] != null){
            $fav = ['in_fav'=>'yes'];
        } else {
            $fav = ['in_fav'=>'no'];
        }
        return json_encode($fav);
    }
    public function my_view_id($tokenget,$id,$userid){       
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $userid;        
        $getmyview = $this->Query("SELECT * FROM `myview`,`anime` WHERE `myview`.`idanime` = $id AND `myview`.`iduser` = ".$id_user." AND `anime`.`id` = `myview`.`idanime`", []);
        if (count($getmyview)<1){
            $view = ['in_view'=>'no'];
            return json_encode($view);
        }
        if ($getmyview[0] != null){
            $view = ['in_view'=>'yes'];
        } else {
            $view = ['in_view'=>'no'];
        }
        return json_encode($view);
    }
    public function act_fav($tokenget, $act, $idanime){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        if ($act == 0){
            $this->Query("DELETE FROM `favorite` WHERE `idanime`='$idanime' AND `iduser` = '$id_user'", []);
        } elseif ($act == 1){
            $getmyfav = $this->Query("SELECT * FROM `favorite` WHERE `idanime` = $idanime AND `iduser` = $id_user", []);
            if (count($getmyfav)>0){
                return;
            }
            
            $this->Query("INSERT INTO `favorite`(`idanime`, `iduser`) VALUES ('$idanime','$id_user')", []);
        }
    }
    public function act_view($tokenget, $act, $idanime){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        
        $id_user = $this->my_user_id;
        if ($act == 0){
            $this->Query("DELETE FROM `myview` WHERE `idanime`='$idanime' AND `iduser` = '$id_user'", []);
        } elseif ($act == 1){
            $getmyview = $this->Query("SELECT * FROM `myview` WHERE `idanime` = $idanime AND `iduser` = $id_user", []);
            if (count($getmyview)>0){
                return;
            }
            $this->Query("INSERT INTO `myview`(`idanime`, `iduser`) VALUES ('$idanime','$id_user')", []);
        }
    }
    public function test(){
        $dd = file_get_contents('./loadhtml/comments.php');
        
        
        
        die($dd);
    }
    public function stats(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        $id_user = $this->my_user_id;
        $time = $_POST['time'];
        $dur = $_POST['dur'];
        $date = time();
        
        $path = $_POST['path'];
        $os = strpos($path,'/');
        $ts = strpos($path,'/',1);
        $op = strpos($path,'_');
        $alls = mb_strlen($path);
        $idanime = substr($path, $os+1,$ts-($os+1));
        $season = substr($path, $ts+2, $op-($ts+2));
        $ep = substr($path, $op+2, $alls-($op+2));
        
        
        if ($op == null){
            $idanime = str_replace('/','',$path);
            $season = 0;
            $ep = 0;
        }
        
        $get_id = $this->Query("SELECT id FROM anime WHERE link='$idanime'",[]);
        $idanime = $get_id[0]['id'];
        
        $geid = $this->Query("SELECT * FROM `history_view` WHERE idanime='$idanime' AND season='$season' AND episode='$ep' AND iduser='$id_user'", []);
        $getview = $this->Query("SELECT * FROM `myview` WHERE idanime='$idanime' AND iduser='$id_user'", []);
        if (count($geid) < 1 ){
            $this->Query("INSERT INTO `history_view` (idanime,season,episode,time,duration,iduser,date) VALUES ('$idanime','$season','$ep','$time','$dur','$id_user','$date')", []);
        } else {
            $this->Query("UPDATE `history_view` SET `time`='$time', `duration`='$dur', `date`=$date WHERE `iduser`='$id_user' AND `idanime`='$idanime' AND `season`='$season' AND `episode`='$ep'", []);
        }
        if (count($getview) < 1 ){
            $this->Query("INSERT INTO `myview` (idanime,iduser) VALUES ('$idanime','$id_user')", []);
        }
        
    }
    public function my_list($tokenget){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }

        $id_user = $this->my_user_id;
        $get_his = $this->Query("SELECT anime.id,anime.link,history_view.season,history_view.episode,history_view.time,history_view.duration,anime.name,episodes.poster FROM `history_view`,`anime`,episodes WHERE episodes.id_anime=history_view.idanime AND episodes.season=history_view.season AND episodes.episode=history_view.episode AND history_view.idanime = anime.id AND iduser = $id_user ORDER BY history_view.date DESC", []);
        
        $getmylist = $this->Query("SELECT an.`id`,an.`link`,an.`name`,an.`prev`,an.`year`,an.`rating`,an.`genre`,IF(mw.divi, 'true','false') as myview,IF(fv.idfav, 'true','false') as favorite FROM `anime` as an LEFT JOIN myview as mw ON mw.idanime=an.id AND mw.iduser=$id_user LEFT JOIN favorite as fv ON fv.idanime=an.id AND fv.iduser=$id_user WHERE mw.iduser = $id_user OR fv.iduser = $id_user", []);
        
        
        
        $mylist = array();
        $mylist[0]['type'] = 'list';
        $mylist[0]['data'] = $getmylist;
        $mylist[1]['type'] = 'hi';
        $mylist[1]['data'] = $get_his;
        return json_encode($mylist);
    }
    public function sendreqtofr($tokenget,$tofr){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        if ($tofr == $id_user){
            return;
        }
        $getfr = $this->Query("SELECT * FROM `friends` WHERE idsend=$id_user AND idto=$tofr OR idsend=$tofr AND idto=$id_user", []);
        if (count($getfr) < 1){
            $time = time();
            $this->Query("INSERT INTO `friends` (idsend,idto) VALUES ('$id_user','$tofr')", []);
            $this->Query("INSERT INTO `user_notice` (iduser,type,msg,attch,saw,date) VALUES ('$tofr','1','хочет добавить Вас в друзья','$id_user','0','$time')", []);
        } else {
            if ($getfr[0]['idto'] == $id_user) {
                $this->Query("UPDATE `friends` SET `type`='1' WHERE `idsend`='$tofr' AND `idto`='$id_user'", []);
            }
        }
    }
    
    public function getmyhistory($idanime,$season,$episode){
        $get_his = $this->Query("SELECT * FROM `history_view`,`anime` WHERE history_view.idanime = anime.id AND idanime=$idanime AND season=$season AND episode=$episode AND iduser = $this->my_user_id ORDER BY idhis DESC LIMIT 1", []);
        return json_encode($get_his);
    }
    
    public function checkfriend($tokenget,$who,$tofr){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        $getfr = $this->Query("SELECT * FROM `friends` WHERE idsend=$who AND idto=$tofr OR idsend=$tofr AND idto=$who", []);
        
        if (count($getfr) < 1){
            $result = [
                'status' => 'no'
            ];
        } else {
            switch($getfr[0]['type']){
                case 0:
                    $type = 'request';
                    break;
                case 1:
                    $type = 'friend';
                    break;
            }
            $result = [
                'status'    => $type,
                'from'      => $getfr[0]['idsend'],
                'to'        => $getfr[0]['idto']
            ];
            
        }
        return json_encode($result);
        
    }
    public function delfriend($tokenget,$idfr){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        $getstatusfr = $this->checkfriend($token,$id_user,$idfr);
        $getstatusfr = json_decode($getstatusfr);
        if ($getstatusfr->status == 'friend' || $getstatusfr->status == 'request'){
            $this->Query("DELETE FROM `friends` WHERE idsend=$idfr AND idto=$id_user OR idsend=$id_user AND idto=$idfr", []);
            $this->Query("DELETE FROM `user_notice` WHERE attch=$idfr AND iduser=$id_user OR attch=$id_user AND iduser=$idfr", []);
        }
    }
    
    public function loadchat($tokenget){
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        $get_user = $this->Query("SELECT login,subscribe,typesubs FROM `users` WHERE `id`='$id_user';",[]);
        $get_msg = $this->Query("SELECT chat.id,userid,txtmsg,datemsg,login,attch,typeattch,delmsg,subscribe,typesubs FROM `chat`,`users` WHERE `chat`.`userid`=`users`.`id` ORDER BY id DESC LIMIT 0, 15;",[]);
        $get_st = $this->Query("SELECT * FROM `stickers`",[]);
        
        for ($i=0;$i<count($get_msg);$i++){
            $get_msg[$i]['subscribe'] = $get_msg[$i]['subscribe'] > time() ? '1' : '0';
        }
        for ($i=0;$i<count($get_user);$i++){
            $get_user[$i]['subscribe'] = $get_user[$i]['subscribe'] > time() ? '1' : '0';
        }
        
        $mylist = array();
        $mylist[0]['type'] = 'chat';
        $mylist[0]['data'] = $get_msg;
        $mylist[1]['type'] = 'stickers';
        $mylist[1]['data'] = $get_st;
        $mylist[2]['type'] = 'userinfo';
        $mylist[2]['data'] = $get_user;
        return json_encode($mylist);
    }
    public function sendmsg(){   
        $tokenget = $_POST['token'];     
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        $text = $_POST['textmsg'];
        $typeattch = $_POST['attch'];
        $attch = null;
        if ($typeattch != 0){
            
            $get_us = $this->Query("SELECT subscribe FROM users WHERE id='$id_user'",[]);
            if ($get_us[0]['subscribe'] > time()){
                $attch = 'sticker';
            } else {
                return;
            }
        } else {
            if ($text == NULL){
                return;
            }
        }

        $time = time();
        $this->Query("INSERT INTO `chat` (`userid`,`txtmsg`,`datemsg`,`attch`,`typeattch`) VALUES ('$id_user','$text','$time','$attch','$typeattch')",[]);
    }    
    public function delchatid(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        if ($this->main->is_admin == false)
        {
            return;
        }
        $idmsg = (int)$_POST['idmsg'];
        $this->Query("UPDATE `chat` SET `delmsg`='1' WHERE `id`='$idmsg'",[]);
    }
    
    public function getcomms(){
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $path = $_POST['path'];
        $os = strpos($path,'/');
        $ts = strpos($path,'/',1);
        $op = strpos($path,'_');
        $alls = mb_strlen($path);
        $idanime = substr($path, $os+1,$ts-($os+1));
        $season = substr($path, $ts+2, $op-($ts+2));
        $episode = substr($path, $op+2, $alls-($op+2));
        
        if ($op == null){
            $idanime = str_replace('/','',$path);
            $season = 0;
            $episode = 0;
        }
        
        $get_id = $this->Query("SELECT id FROM anime WHERE link='$idanime'",[]);
        $idanime = $get_id[0]['id'];
        
        $getcomms = $this->Query("SELECT comments.id,text,iduser,comments.date,reply_id,reply_to_id,login,avatar,(SELECT SUM(uservalue) as rating FROM `comments_rating`,`comments` WHERE comments.id = comments_rating.toidcomm AND comments.iduser = users.id) as rating,subscribe,typesubs,src,small_pos FROM `comments`,users LEFT JOIN borders ON borders.idbor=border WHERE comments.iduser=users.id AND`idanime`=$idanime AND `season`=$season AND `episode`=$episode",[]);
        $getrating = $this->Query("SELECT SUM(uservalue) as rating, toidcomm FROM `comments_rating` WHERE idanime = $idanime AND season = $season AND episode = $episode GROUP BY toidcomm",[]);
        
        $arrayjson = array();
        $reply_comm = array();
        $reply_item_comm = array();
        $mylist = array();
        
        for($i=0;$i<count($getcomms);$i++){
            $mylist['count'] = $i+1;
            if ($getcomms[$i]['reply_id'] != 0){
                $reply_comm['id'] =             (int)$getcomms[$i]['id'];
                $reply_comm['rating'] = 0;
                for($f=0;$f<count($getrating);$f++){
                    if ($getrating[$f]['toidcomm'] == (int)$getcomms[$i]['id']){
                        $reply_comm['rating'] = $getrating[$f]['rating'];
                    }
                }
                if ($getcomms[$i]['rating'] == null){
                    $reply_comm['rank'] =       $this->getrank(0);
                } else {
                    $reply_comm['rank'] =       $this->getrank($getcomms[$i]['rating']);
                }
                $reply_comm['rank'] =           $this->getrank($getcomms[$i]['rating']);
                $reply_comm['reply_id'] =       (int)$getcomms[$i]['reply_id'];
                $reply_comm['reply_to_id'] =    (int)$getcomms[$i]['reply_to_id'];
                $reply_comm['text'] =           $getcomms[$i]['text'];
                $reply_comm['iduser'] =         (int)$getcomms[$i]['iduser'];
                if ($getcomms[$i]['subscribe'] >= time()){
                    if ($getcomms[$i]['typesubs'] == 1){
                        $reply_comm['subs'] =   '2';
                    } else {
                        $reply_comm['subs'] =   '1';
                    }
                        $reply_comm['border'] =   $getcomms[$i]['src'];
                        $reply_comm['border_pos'] =   $getcomms[$i]['small_pos'];
                } else {
                        $reply_comm['subs'] =   '0';
                        $reply_comm['border'] =   '0';
                        $reply_comm['border_pos'] =   '0';
                }
                $reply_comm['name'] =       $getcomms[$i]['login'];

                $reply_comm['avatar_user'] =    $getcomms[$i]['avatar'];
                $reply_comm['date'] =           (int)$getcomms[$i]['date'];
                $reply_item_comm[] =            $reply_comm;
            } else {
                $arrayjson['id'] =              $getcomms[$i]['id'];
                $arrayjson['rating'] = 0;
                for($d=0;$d<count($getrating);$d++){
                    if ($getrating[$d]['toidcomm'] == (int)$getcomms[$i]['id']){
                        $arrayjson['rating'] =  $getrating[$d]['rating'];
                    }
                }
                if ($getcomms[$i]['rating'] == null){
                    $arrayjson['rank'] =        $this->getrank(0);
                } else {
                    $arrayjson['rank'] =        $this->getrank($getcomms[$i]['rating']);
                }
                $arrayjson['text'] =            $getcomms[$i]['text'];
                $arrayjson['iduser'] =          $getcomms[$i]['iduser'];
                if ($getcomms[$i]['subscribe'] >= time()){
                    if ($getcomms[$i]['typesubs'] == 1){
                        $arrayjson['subs'] =   '2';
                    } else {
                        $arrayjson['subs'] =   '1';
                    }
                    $arrayjson['border'] = $getcomms[$i]['src'];
                    $arrayjson['border_pos'] = $getcomms[$i]['small_pos'];
                } else {
                        $arrayjson['subs'] =   '0';
                        $arrayjson['border'] = '0';
                        $arrayjson['border_pos'] = '0';
                }
                $arrayjson['name'] =       $getcomms[$i]['login'];
                $arrayjson['avatar_user'] =     $getcomms[$i]['avatar'];
                $arrayjson['date'] =            (int)$getcomms[$i]['date'];
                $mylist['items'][] =            $arrayjson;
            }
        }
        

            for($i=0;$i<count($mylist['items']);$i++){
                for($j=0;$j<count($reply_item_comm);$j++){
                    if ($mylist['items'][$i]['id'] == $reply_item_comm[$j]['reply_id']){
                        $mylist['items'][$i]['thead'][] = $reply_item_comm[$j];
                    }
                }
            }
        return json_encode($mylist);
    }
    
    public function getrank($rating){
        $rank = 'Проходящий мимо';

        if($rating>1500){
            $rank = 'Бог';
        }elseif($rating>800){
            $rank = 'Гений';
        }elseif($rating>500){
            $rank = 'Отаку';
        }elseif($rating>200){
            $rank = 'Сенпай';
        }elseif($rating>100){
            $rank = 'Знаток';
        }elseif($rating>80){
            $rank = 'Любитель';
        }elseif($rating>40) {
            $rank = 'Анимешник';
        }elseif ($rating>20){
            $rank = 'Начинающий анимешник';
        }elseif ($rating>0){
            $rank = 'Проходящий мимо';
        }elseif ($rating<0){
            $rank = 'Изгой';
        }
        
        return $rank;
    }
    
    public function sendcomm(){        
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $sendtext = htmlspecialchars($_POST['sendtext']);
        if (mb_strlen($sendtext)>200){
            return;
        }
        $sendtext = str_replace('&amp;', '', $sendtext);
        $sendtext = str_replace('nbsp;', '', $sendtext);
        if (mb_strlen($sendtext)<1){
            return;
        }
        $sendidreply = (int)$_POST['sendidreply'];
        $senduserreply = (int)$_POST['senduserreply'];
        $date = time();
        
        $path = $_POST['path'];
        $os = strpos($path,'/');
        $ts = strpos($path,'/',1);
        $op = strpos($path,'_');
        $alls = mb_strlen($path);
        $idanime = substr($path, $os+1,$ts-($os+1));
        $season = substr($path, $ts+2, $op-($ts+2));
        $ep = substr($path, $op+2, $alls-($op+2));
        
        if ($op == null){
            $idanime = str_replace('/','',$path);
            $season = 0;
            $ep = 0;
        }
        
        
        $get_id = $this->Query("SELECT id FROM anime WHERE link='$idanime'",[]);
        $idanime = $get_id[0]['id'];
        
        $this->Query("INSERT INTO `comments` (idanime,season,episode,reply_id,reply_to_id,text,iduser,date) VALUES ('$idanime','$season','$ep','$sendidreply','$senduserreply','$sendtext','$this->my_user_id','$date')",[]);
    }
    
    public function sendratingcomm(){        
        $tokenget = $_POST['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        $path = $_POST['path'];
        $os = strpos($path,'/');
        $ts = strpos($path,'/',1);
        $op = strpos($path,'_');
        $alls = mb_strlen($path);
        $idanime = substr($path, $os+1,$ts-($os+1));
        $season = substr($path, $ts+2, $op-($ts+2));
        $ep = substr($path, $op+2, $alls-($op+2));
        
        
        if ($op == null){
            $idanime = str_replace('/','',$path);
            $season = 0;
            $ep = 0;
        }
        
        
        $get_id = $this->Query("SELECT id FROM anime WHERE link='$idanime'",[]);
        $idanime = $get_id[0]['id'];
        
        
        $sendid = $_POST['sendid'];
        $rating = $_POST['rating'];
        if ($rating == 'up'){
            $rating = 1;
        } else {
            $rating = -1;
        }
        
        $getcomms = $this->Query("SELECT * FROM `comments_rating` WHERE idanime = $idanime AND season = $season AND episode = $ep AND fromuser = $this->my_user_id AND toidcomm = $sendid",[]);
        if (count($getcomms) > 0){
            if ($getcomms[0]['uservalue'] == $rating){
                $this->Query("DELETE FROM `comments_rating` WHERE idanime=$idanime AND season=$season AND episode=$ep AND fromuser=$this->my_user_id AND toidcomm=$sendid",[]);
            } else {
                $this->Query("UPDATE `comments_rating` SET uservalue=$rating WHERE idanime=$idanime AND season=$season AND episode=$ep AND fromuser=$this->my_user_id AND toidcomm=$sendid",[]);
            }
        } else {
            $this->Query("INSERT INTO `comments_rating` (idanime,season,episode,fromuser,toidcomm,uservalue) VALUES ('$idanime','$season','$ep','$this->my_user_id','$sendid',$rating)",[]);
        }
            $getrating = $this->Query("SELECT SUM(uservalue) as rating, toidcomm FROM `comments_rating` WHERE idanime = $idanime AND season = $season AND episode = $ep AND toidcomm = $sendid",[]);
            return $getrating[0]['rating'];
        }
    
        public function frame_player($id_anime, $season, $episode,$wtf=0){
        
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        
        $ep_info = json_decode($this->getepisode($token,$id_anime,$season,$episode,1));
        $myhis = json_decode($this->getmyhistory($id_anime,$season,$episode));
        $sections = '';
        $time = 0;
        if ($ep_info){
            $sections = $ep_info->sections != NULL ? 'sections: '.json_encode($ep_info->sections).',' : '';
        } else {
            header('Location: ./');
        }
        if ($myhis){
            $time = $myhis[0]->time != NULL ? $myhis[0]->time : 0;
        }
            if ($wtf != 0){
                $time = $wtf;
            }
        if ($season == 0){
            $title = $ep_info->animename;
        } else {
            $title = $ep_info->animename.' - '.$ep_info->name.' | Сезон '.$season.' - Серия '.$episode;
        }
            
        return '
<script>
    var player = VenomPlayer.make({
        publicPath: "https://cdn.jsdelivr.net/npm/venom-player@" + VenomPlayer.version + "/dist/",
        container: document.getElementById("backgroundplayer"),
        source: {
            hls:  "'.$ep_info->link.'",
            audio: {"names":["Eng.Original"],"order":[0]},
        },
        time: '.$time.',
        quality: 1080,
        title: "'.$title.'",
        volume: 0.5,
        theme: "metro",
        autoLandscape: true,
        poster: "'.$ep_info->poster.'",
        '.$sections.'
        ui: {
            about: false,
        },
        translations: { 
        en: {
            repeat: "s",
            skipDescription: "Skip fragments",
        },
        ru: {
            repeat: "Повтор",
            skipDescription: "Пропуск фрагментов",
        }, 
        } 

    });
    
        var dur,curtime;
        player.once("timeupdate", (e) => dur = e.target.duration);
        player.on("timeupdate", (e) => curtime = e.target.currentTime);  
        player.once("play", (e) => e.target.currentTime="'.$time.'");

    
    
</script>';
    }
    
    public function getnotice($saw = 0){
        
        if ($saw == 1){
            $this->Query("UPDATE user_notice SET saw=1 WHERE iduser=$this->my_user_id",[]);
            return;
        }
        
        $getnotice = $this->Query("SELECT (SELECT COUNT(saw) FROM user_notice WHERE iduser=$this->my_user_id AND saw=0) as count,un.id,un.iduser,un.type,un.msg,un.saw,un.date,un.attch,ur.avatar,ur.login FROM user_notice as un LEFT JOIN users as ur ON un.attch=ur.id WHERE un.iduser=$this->my_user_id ORDER BY un.`date` DESC LIMIT 10;",[]);

        $arrayjson = array();
        $countsaw = array();
        
        for($i=0;$i<=count($getnotice)-1;$i++){
                $arrayjson[$i]['id'] = $getnotice[$i]['id'];
                $arrayjson[$i]['iduser'] = $getnotice[$i]['iduser'];
                $arrayjson[$i]['type'] = $getnotice[$i]['type'];
                $arrayjson[$i]['msg'] = $getnotice[$i]['msg'];
                $arrayjson[$i]['attch'] = $getnotice[$i]['attch'];
                if ($getnotice[$i]['attch'] > 0){
                    $arrayjson[$i]['name'] = $getnotice[$i]['login'];
                    $arrayjson[$i]['avatar'] = $getnotice[$i]['avatar'];
                }
                $arrayjson[$i]['saw'] = $getnotice[$i]['saw'];
                $arrayjson[$i]['date'] = $getnotice[$i]['date'];
        }
        if ($getnotice[0]['count'] > 100){
            $count = "99+";
        } else {
            $count = $getnotice[0]['count'];
        }
        $countsaw['count'] = $count;
        $countsaw['data'] = $arrayjson;
        
        
        $jsondata = json_encode($countsaw);
        return $jsondata;
    }
    
    public function search(){
        $find = $_POST['find'];
        $get_res = $this->Query("SELECT * FROM `anime` WHERE name LIKE '%$find%'",[]);
        return json_encode($get_res);
    }
    
    public function subscribe(){
        $jsondata = json_decode($_POST['sendadddata'], true); 
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        
        
        $res = json_encode(array('err'));
        
        $id_user = $this->my_user_id;
        $get_res = $this->Query("SELECT * FROM `users` WHERE id='$id_user'",[]);
        if (isset($jsondata['changesub']) &&  mb_strlen($jsondata['changesub']) > 0){
            if ($get_res[0]['subscribe'] > time() && $get_res[0]['typesubs'] == '1'){
                $typesub = '0';
                $sub_time = ($get_res[0]['subscribe'] - time()) / 0.5 + time();
                $this->Query("UPDATE `users` SET subscribe='$sub_time',typesubs=$typesub WHERE id='$id_user'",[]);
            } elseif ($get_res[0]['subscribe'] > time() && $get_res[0]['typesubs'] == '0') {
                $typesub = '1';
                $sub_time = ($get_res[0]['subscribe'] - time()) * 0.5 + time();
                $this->Query("UPDATE `users` SET subscribe='$sub_time',typesubs=$typesub WHERE id='$id_user'",[]);
            }
            
            
            $res = json_encode(array('ok'));
            return $res;
        }
        
        $typesub = $jsondata['typesub'];
        $period = (int)$jsondata['period'];
        $price_standart = array('50', '120', '390');
        $price_premium = array('100', '250', '800');
        
        $period_subs = array('2592000', '7776000', '31104000');
        
        $get_res = $this->Query("SELECT * FROM `users` WHERE id='$id_user'",[]);
        if ($typesub == 'standart'){
            if ($get_res[0]['money'] > $price_standart[$period-1]){
                $moneym = $price_standart[$period-1]; 
                $sub_time = time() + $period_subs[$period-1];
                if ($get_res[0]['subscribe'] > time()){
                    $sub_time = $get_res[0]['subscribe'] + $period_subs[$period-1];
                } 
                $this->Query("UPDATE `users` SET subscribe='$sub_time',typesubs=0, money=money-'$moneym' WHERE id='$id_user'",[]);
                $res = json_encode(array('ok'));
            }
        } elseif ($typesub == 'premium'){
            if ($get_res[0]['money'] > $price_premium[$period-1]){
                $moneym = $price_premium[$period-1]; 
                $sub_time = time() + $period_subs[$period-1];
                if ($get_res[0]['subscribe'] > time()){
                    $sub_time = $get_res[0]['subscribe'] + $period_subs[$period-1];
                }
                $this->Query("UPDATE `users` SET subscribe='$sub_time',typesubs=1, money=money-'$moneym' WHERE id='$id_user'",[]);
                $res = json_encode(array('ok'));
            }
            
        }
        return $res;
    }
    
    public function support(){
        $jsondata = json_decode($_POST['sendadddata'], true); 
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        if (isset($jsondata['hash'])) {
            $hash = $jsondata['hash'];
            $get_sup = $this->Query("SELECT * FROM `support_themes` WHERE MD5(CONCAT(`id`,'MweN4')) = '$hash' AND `iduser`='$id_user'",[]);
            if (count($get_sup)>0){
                if (mb_strlen($jsondata['dialog_msg']) > 0 && mb_strlen($jsondata['dialog_msg']) < 200){
                    $time = time();
                    $msg = $jsondata['dialog_msg'];
                    $idtheme = $get_sup[0]['id'];
                    $this->Query("INSERT INTO `support_dialog` (`idtheme`,`iduser`,`msg`,`date`) VALUES ('$idtheme','$id_user','$msg','$time')",[]);
                }
            }
            return json_encode(array('ss' => $jsondata['dialog_msg']));
        }
        
        $section = (int)$jsondata['section'];
        $theme = htmlspecialchars($jsondata['theme']);
        $msg = htmlspecialchars($jsondata['msg']);
        if ( mb_strlen($theme)<1 || mb_strlen($msg)<1){
            return json_encode(array('err' => 'Тема или описание не могут быть пустыми!'));
        }
        if (mb_strlen($theme)>30){
            return json_encode(array('err' => 'Тема не должна превышать 30 символов!'));
        }
        if (mb_strlen($msg)>200){
            return json_encode(array('err' => 'Описание не должно превышать 200 символов!'));
        }
        
        $time = time();
        
        $this->Query("INSERT INTO `support_themes` (`section`,`nametheme`,`question`,`iduser`,`date`) VALUES ('$section','$theme','$msg','$id_user','$time')",[]);
        $get_sup = $this->Query("SELECT id FROM `support_themes` WHERE `iduser`='$id_user' ORDER BY date DESC LIMIT 1",[]);
        $idsup = $get_sup[0]['id'];
        $hash_sup = md5($idsup . 'MweN4');
        return json_encode(array('success' => $hash_sup));
    }
    public function getsupport($iduser){
        
        $get_sup = $this->Query("SELECT * FROM `support_themes` WHERE `iduser`='$iduser' ORDER BY date DESC",[]);
        
        return json_encode($get_sup);
    }
    public function getsupport_dialog($hash, $iduser){
        
        $get_sup = $this->Query("SELECT st.id,nametheme,question,sd.iduser,msg,closed,login,avatar,sd.date,subscribe,typesubs,src,small_pos FROM `support_dialog` as sd RIGHT JOIN support_themes as st on sd.idtheme=st.id LEFT JOIN users ON sd.iduser=users.id LEFT JOIN borders on users.border=borders.idbor WHERE MD5(CONCAT(`st`.`id`,'MweN4')) = '$hash' AND `st`.`iduser`='$iduser'",[]);
        
        return json_encode($get_sup);
    }
    
    public function get_social_notice($iduser){
        $get_soc = $this->Query("SELECT * FROM `user_notice_social` WHERE `iduser` = '$iduser'",[]);
        
        return json_encode($get_soc);
    }
    
    public function push_social(){
        $jsondata = json_decode($_POST['sendadddata'], true); 
        $tokenget = $jsondata['token'];
        $token = hash('sha256', crypt($this->my_user_id.'mxlk'.date('d',time()).'mfilk','m1xlk2NreX37').crypt(date('d',time()).'mfilk','4lM8xcmfilko9xj').crypt($_SERVER['REMOTE_ADDR'].'mxk','mxk4416445'));
        if ($tokenget != $token){
            die('invalid token');
        }
        $id_user = $this->my_user_id;
        $soc = $jsondata['social'];
        
        $get_soc = $this->Query("SELECT * FROM `user_notice_social` WHERE `iduser`='$id_user'",[]);
        
        if ($soc == 'vk'){
            if ($get_soc[0]['vkstatus'] == 0){
                $this->Query("UPDATE `user_notice_social` SET `vkstatus`=1 WHERE `iduser`='$id_user'",[]);
            } else {
                $this->Query("UPDATE `user_notice_social` SET `vkstatus`=0 WHERE `iduser`='$id_user'",[]);
            }
        }
        if ($soc == 'tg'){
            if ($get_soc[0]['tgstatus'] == 0){
                $this->Query("UPDATE `user_notice_social` SET `tgstatus`=1 WHERE `iduser`='$id_user'",[]);
            } else {
                $this->Query("UPDATE `user_notice_social` SET `tgstatus`=0 WHERE `iduser`='$id_user'",[]);
            }
        }
        
        return json_encode($get_soc);
    }
    
    
    
    private function PROTECT(){
        $ipuser = $_SERVER['REMOTE_ADDR'];
        $page = $_SERVER['REQUEST_URI'];
        $timenow = time();
        $timenow_check = time()+3;
        
        
        $get_ban = $this->Query("SELECT * FROM `blockip` WHERE `blockip`='$ipuser'",[]);
        if (isset($get_ban) && count($get_ban)>0){
            return true;
        }
        $this->Query("INSERT INTO `checkddos` (`ip`,`lastreq`,`page`) VALUES ('$ipuser','$timenow_check','$page')",[]);
        
        $get_list = $this->Query("SELECT * FROM `checkddos` WHERE `ip`='$ipuser' AND `lastreq`>'$timenow'",[]);
        $this->Query("DELETE FROM `checkddos` WHERE `lastreq`<'$timenow'",[]);
        if (isset($get_list) && count($get_list)>20){
            $this->Query("INSERT INTO `blockip` (`blockip`) VALUES ('$ipuser')",[]);
            $this->Query("DELETE FROM `checkddos` WHERE `ip`='$ipuser'",[]);
            return true;
        } else {
            $this->Query("UPDATE `users` SET `lastact`='$timenow' WHERE `id`='$this->my_user_id'",[]); // в крон
            return false;
        }
        
    }

    

}
?>