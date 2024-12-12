<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    spl_autoload_register(function($class) {
        include str_replace('\\', '/', $class) . '.php';
    });

    //$service = new Utils\BackendService("https://online-lectures-cs.thi.de/chat/", "f00a3c26-3aa4-40c6-a772-5adebc4c3689");

    define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
    define('CHAT_SERVER_ID', 'f3630146-151d-41a7-a0bb-fd844a6cdebc'); # Ihre Collection ID

    session_start();

?>