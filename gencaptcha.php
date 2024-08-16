<?
define('USE_SESSION', true);

$chars = '1234567890abcdefghjkmnpqrstuvwxyz';
$length = 4;
$code = substr(str_shuffle($chars), 0, $length);

if (USE_SESSION) {
    session_start();
    $_SESSION['captcha'] =  crypt($code, 'dfgdfggf$12');
    session_write_close();
} else {
    $value = crypt($code, 'dfgdfggf$12');
    $expires = time() + 600;
    setcookie('captcha', $value, $expires, '/', 'SITE', false, true);
}

$image = imagecreatefrompng('./imgs/captcha/capt'.rand(1,4).'.png');
$size = 36;
$color1 = imagecolorallocate($image, rand(120,180), 16, 0);
$color2 = imagecolorallocate($image, rand(120,180), 16, 0);
$color3 = imagecolorallocate($image, rand(120,180), 16, 0);
$color4 = imagecolorallocate($image, rand(120,180), 16, 0);

$font = './css/Inter-Regular.ttf';
$angle = rand(-15, 15);
$x = 56;
$y = 64;     
imagefttext($image, $size, $angle, $x, $y, $color1, $font, $code[0]);
imagefttext($image, $size, $angle, $x+30, $y, $color2, $font, $code[1]);
imagefttext($image, $size, $angle, $x+60, $y, $color3, $font, $code[2]);
imagefttext($image, $size, $angle, $x+90, $y, $color4, $font, $code[3]);
header('Cache-Control: no-store, must-revalidate');
header('Expires: 0');
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);