<?php
// Название <input type="file">
$input_name = 'file';
$type_file = $_POST['type'];
// Разрешенные расширения файлов.
$allow = array(
    'jpg','jpeg','png'
);
 
// Запрещенные расширения файлов.
$deny = array(
	'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
	'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
	'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
);
 
// Директория куда будут загружаться файлы.
    $path = '/var/www/html/imgs/users/temp/';

 
$error = $success = '';
if (!isset($_FILES[$input_name])) {
	$error = 'Файл не загружен.';
} else {
	$file = $_FILES[$input_name];
	if (!empty($file['error']) || empty($file['tmp_name'])) {
		$error = $_FILES[$input_name];
	} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
		$error = 'Не удалось загрузить файл.';
	} else {
		// Оставляем в имени файла только буквы, цифры и некоторые символы.
		$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
		$name = mb_eregi_replace($pattern, '-', $file['name']);
		$name = mb_ereg_replace('[-]+', '-', $name);
		$parts = pathinfo($name);
 
		if (empty($name) || empty($parts['extension'])) {
			$error = 'Разрешенные типы файлов только jpg или png';
		} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
			$error = 'Разрешенные типы файлов только jpg или png';
		} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
			$error = 'Разрешенные типы файлов только jpg или png';
		} else {
			// Перемещаем файл в директорию.
       
                $getsz = getImageSize($file['tmp_name']);
            
                if ($type_file == 'banner'){
                    if ($getsz[0] > '1920' || $getsz[1] > '1080'){
                        die('Максимальная ширина 1920px, максимальная высота 1080px');
                    }
                    if ($getsz[0] < '900' || $getsz[1] < '300'){
                        die('Минимальная ширина 900px, минимальная высота 300px');
                    }
                }
                if ($type_file == 'avatar'){
                    if ($getsz[0] > '1600' || $getsz[1] > '1600'){
                        die('Максимальная ширина 1600px, максимальная высота 1600px');
                    }
                    if ($getsz[0] < '200' || $getsz[1] < '200'){
                        die('Минимальная ширина 200px, минимальная высота 200px');
                    }
                }
                    
                    
                    require_once '/var/www/html/Controllers/AuthController.php';
                    $au = new AuthController();
                    $name = $au->getMyId().time() . '.png';
                    
                    
                     imagepng(imagecreatefromstring(file_get_contents($file['tmp_name'])), $file['tmp_name']);
                    if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                        $success = $name;
                    } else {
                        $error = 'Не удалось загрузить файл.';
                    }
            

            

		}
	}
}
 
// Вывод сообщения о результате загрузки.
if (!empty($error)) {
	$error = '<p style="color: red">' . $error . '</p>';  
}
 
$data = array(
	'error'   => $error,
	'success' => $success,
);
 
//header('Content-Type: application/json');
//echo json_encode($data, JSON_UNESCAPED_UNICODE);
echo $error.$success;
exit();