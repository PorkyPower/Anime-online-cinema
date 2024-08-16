<?
    require_once("/var/www/html/Controllers/VideoController.php");
    $Video = new VideoController();
    if ($_POST['namefile']){
        $dur = $Video -> getprogress($_POST['namefile']);
        if ($dur>0){
            echo 'done';
            //$Video -> takeScreen($dur);
        } 
    } else {
        echo "err";
    }
?>