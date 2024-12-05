<?php

    require("start.php");
    $service = new Utils\BackendService("https://online-lectures-cs.thi.de/chat/", "f00a3c26-3aa4-40c6-a772-5adebc4c3689");
    $_results = $service->login("Tom", "12345678");
    var_dump($_results);

    $user = new Model\Friend("Tom");
    var_dump($user);

    $jsonStr = json_encode($user);
    var_dump($jsonStr);

    $newUser = Model\Friend::fromJson(json_decode($jsonStr, true));  
    var_dump($newUser);

?>