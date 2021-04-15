<?php 

    use PHPMVC\Lib\FrontController;
    use PHPMVC\Lib\database;
    require '../app/config.php';
    require '../app/lib/autoload.php';

    $db = new Database();
    global $handler;
    global $errors;
    global $session;

    $handler = $db->db;
    $errors = [];
    $session = new \PHPMVC\Lib\CostumSessionHandler();

    session_set_save_handler($session);

    session_start();

    $a = new FrontController;
    $a->dispatch();


