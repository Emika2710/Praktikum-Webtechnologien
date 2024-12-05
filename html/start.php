<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    spl_autoload_register(function($class) {
        include str_replace('\\', '/', $class) . '.php';
    });

    $service = new Utils\BackendService("https://online-lectures-cs.thi.de/chat/", "f00a3c26-3aa4-40c6-a772-5adebc4c3689");
    session_start();


?>