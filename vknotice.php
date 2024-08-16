<?
$data = json_decode(file_get_contents("php://input"));    

$secret = 'sdU3nmwjk4';


if ($secret != $data->secret)
    die();
        
if ($data->type == 'message_event'){
    echo 'ok';
} elseif ($data->type == 'message_new'){
    if ($data->object->message->text == 'Начать'){
        require_once './classes/vk_api.php';
        $vk = new VK();
        $from_id = $data->object->message->from_id;
        $data = [
            'chat_id' => $from_id
        ];
        $get_hash = file_get_contents('http://SITE/get_hash_social/'.$from_id);
        $vk->send_message('Для активации оповещаний перейдите по ссылке http://SITE/social/'.$get_hash, $data);
    }
    echo 'ok';
} elseif ($data->type == 'confirmation') {
    echo '0908c45d';
} else {
    echo 'ok';
}
?>