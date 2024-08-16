<?
$data = json_decode(file_get_contents("php://input"));    


if (empty($data['message']['chat']['id'])) {
	exit();
}
$command = $data['message']['text'];

    if ($command == 'дала'){
        require_once './classes/tg_api.php';
        $tg = new TG();
        $from_id = $data['message']['from']['id'];
        $data = [
            'chat_id' => $from_id
        ];
        $tg->send_message('Всё окей!', $data);
    }

}
?>