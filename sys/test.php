<?

require_once("/var/www/html/Controllers/VideoController.php");
$Video = new VideoController();
$dur = $Video -> getprogress("bfccd60ae2cb653f3fa4709b7981e851");
