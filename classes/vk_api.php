<?php
class VK{

    public $v = "5.131";
    public $apiurl = "https://api.vk.com/method/";
    public $random_id;
    public $token;
    public $group_id;

    public function __construct() {
        $this->random_id = mt_rand(0000000000, 999999999999);
        $this->token = '';
        $this->group_id = '';
        
    }

    public function call (string $method, array $parms = []) {
        $parms['v'] = $this->v;
        
        if (!isset($parms['access_token']))
            $parms['access_token'] = $this->token;
        
        $url = $this->apiurl . $method . '?' 
                . http_build_query($parms, '&');
        
        $result = $this->curl_send($url);

        return json_decode($result);
        
    }
    
    public function sendMessageEventAnswer (string $event_id, int $user_id, int $peer_id, string $textcallback) {
            
            $pl = [
                'type' => 'show_snackbar',
                'text' => $textcallback
            ];
            
            $parms = [
                'event_id' => $event_id,
                'user_id' => $user_id,
                'peer_id' => $peer_id,
                'event_data' => json_encode($pl),
                'lang' => 'ru',
            ];        
        
            $result = $this->call('messages.sendMessageEventAnswer', $parms);
    }
    public function notice_vk(string $message, array $vkusers){
        
        foreach($vkusers as $vkid){
            $data = [
                    'chat_id' => $vkid
                    ];
            $this->send_message($message, $data);
        }
    }
        
    public function send_message (string $message, array $data, array $attachments = [], array $keyboard = []) {
                
            $parms = [
                'peer_id' => $data['chat_id'],
                'group_id' => $this->group_id,
                'message' => $message,
                'random_id' => $this->random_id,
                'lang' => 'ru',
                'dont_parse_links' => 1,
                'keyboard' => json_encode($keyboard, JSON_UNESCAPED_UNICODE)
            ];

            if ($attachments) {

                $parms['attachment'] = "";

                foreach ($attachments as $attachment) {
                    $parms['attachment'] .= $attachment['type'] . $attachment['owner_id'] . "_" . $attachment['media_id'] . ",";
                }

            }

            $result = $this->call('messages.send', $parms);
            return $result->response;
            
        }
    
        public function curl_send (string $url, bool $ignore = true, string $proxy = ""): string {

            $myCurl = curl_init();

            curl_setopt_array($myCurl, array(
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => http_build_query(array())
            ));

            $response = curl_exec($myCurl);

            curl_close($myCurl);
            return $response;

        }
}
?>