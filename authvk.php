<?
    require __DIR__ . "/Controllers/AuthController.php";
    $Auth = new AuthController();

    $Auth->getData();
    exit;
?>