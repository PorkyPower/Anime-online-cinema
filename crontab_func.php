<?php
    require_once '/var/www/html/Controllers/SocialController.php';
    $soc = new SocialController();
    $soc->cron();
    exit;
?>