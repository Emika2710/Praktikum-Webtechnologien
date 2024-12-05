<?php
    require("start.php");

    define('CHAT_SERVER_URL', 'https://online-lectures-cs.thi.de/chat/');
    define('CHAT_SERVER_ID', '...'); # Ihre Collection ID

    header("Location: login.php");
    exit;

?>