<?php
require_once __DIR__ . "/Controller.php";

class SocialController extends \Controller
{
    public function get_hash_social($vkid){
        $makehash = md5(date('dY',time()).'hhS'.$vkid);
        $get_social = $this->Query("SELECT * FROM `user_notice_social` WHERE `vk`='$vkid'",[]);
        if (isset($get_social[0])){
            if ($get_social[0]['iduser'] != 0){
                return json_encode(array('status' => 'err',
                                         'msg'    => 'Аккаунт уже привязан!'));
            }
        } else{
            $this->Query("INSERT INTO `user_notice_social` (`vk`) VALUES ('$vkid')",[]);
        }
        return $makehash;
    }
    public function cron(){
        $ACCEPTIP = '127.0.0.1';
        $remote = $_SERVER["REMOTE_ADDR"] ?? '127.0.0.1';
        if ($remote != '127.0.0.1' && $remote != $ACCEPTIP) 
            die("");
        
        $get_cron = $this->Query("SELECT * FROM `user_notice_social_cron` LIMIT 20",[]);
        $this->Query("DELETE FROM `user_notice_social_cron` LIMIT 20",[]);
        
        if ($get_cron){
            require_once '/var/www/html/classes/vk_api.php';
            $vk = new VK();
            foreach($get_cron as $vkuser){
                if ($vkuser['vk']>0){
                    $to_vk_id[] = $vkuser['vk'];
                }
            }
            $message = $vkuser['msg'];
            if ($to_vk_id)
                $vk->notice_vk($message, $to_vk_id);
            
        }
    }
}
?>