<?php
require_once './Controllers/AuthController.php';

class Main {

    public $is_auth;
    public $is_admin;
    public $my_id;
    public $mylogin;
    public $date;
    public $info;
    public $is_banned;

    public function __construct() {
        $au = new AuthController();
        $this->date = time();
        $this->is_auth = $au->isAuth();
        $this->is_admin = $au->getMyRules();
        $this->my_id = $au->getMyId();
        $this->mylogin = $au->getMyLogin();
        $this->is_banned = $au->getBan();
    }

}
?>