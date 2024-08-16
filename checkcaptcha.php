<?
if (!isset($_POST['captcha'])){
    die();
}
session_start();
$captcha = $_SESSION['captcha'];
unset($_SESSION['captcha']);
session_write_close();

$result = ['success' => false];
$code = $_POST['captcha'];

if (empty($code)) {
    $result['errors'][] = ['captcha', 'Пожалуйста, введите код!'];
} else {
    $code = crypt(trim($code), 'dfgdfggf$12');
    $result['success'] = $captcha === $code;
    if (!$result['success']) {
        $result['errors'][] = ['captcha', 'Неправильный код'];
    } else {
        require_once "./Controllers/Controller.php";
        $main = new Controller();
        $myip = $_SERVER['REMOTE_ADDR'];
        $main->Query("DELETE FROM `blockip` WHERE `blockip`='$myip'",[]);
    }
}

echo json_encode($result);