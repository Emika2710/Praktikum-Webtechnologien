<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    spl_autoload_register(function($class) {
        include str_replace('\\', '/', $class) . '.php';
    });

    session_start();
    
    define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
    define('CHAT_SERVER_ID', 'f3630146-151d-41a7-a0bb-fd844a6cdebc'); # Ihre Collection ID

    $service= new Utils\BackendService(CHAT_SERVER_URL, CHAT_SERVER_ID);

?>
