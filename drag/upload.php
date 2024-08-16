<?php
// Название <input type="file">
$input_name = 'file';
 
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
$path = '/var/www/html/imgs/temp/';
 
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
			$error = 'Недопустимый тип файла';
		} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
			$error = 'Недопустимый тип файла';
		} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
			$error = 'Недопустимый тип файла';
		} else {
			// Перемещаем файл в директорию.
       
                $getsz = getImageSize($file['tmp_name']);
                if ($getsz[1] <= '4024'){
                    
                    $name = time() . '.png';
                    
                    
                     imagepng(imagecreatefromstring(file_get_contents($file['tmp_name'])), $file['tmp_name']);
                    			if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                                    $success = $name;
                                    //$success = '<div id=iconsbanner><div>Удалить</div></div>';
                                } else {
                                    $error = 'Не удалось загрузить файл.';
                                }
                } else {
                    
                                    $error = 'Неверный размер изображения.';
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