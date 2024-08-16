<?php
class TG{

    public $apiurl = "https://api.telegram.org/bot";
    public $token;

    public function __construct() {
        $this->token = '';
        
    }

    public function call (string $method, array $parms = []) {
        $url = $this->apiurl . $this->token . '/'.$method);
        $result = $this->curl_send($url, $parms);
        
        return json_decode($result);
    }
    
    public function send_message (string $message, array $data) {
                
        $parms = [
            'chat_id' => $data['chat_id'],
            'text' => $message,
        ];

        $result = $this->call('sendMessage', $parms);

        return $result->response;
    }
    
    public function notice_tg(string $message, array $tgusers){
        foreach($tgusers as $tgid){
            $data = [
                    'chat_id' => $tgid
                    ];
            $this->send_message($message, $data);
        }
    }
    
    public function curl_send (string $url, array $resp): string {

        $myCurl = curl_init();

        curl_setopt_array($myCurl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_HEADER => false,
                CURLOPT_POSTFIELDS => $response
        ));

        $response = curl_exec($myCurl);

        curl_close($myCurl);
        return $response;
    }
}
?>