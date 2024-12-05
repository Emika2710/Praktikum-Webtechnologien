<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <title>Chat</title>
</head>

<body>
    <h1>Chat with Tom</h1>
    <p class="title">
        <a href="friendlist.php">
            &lt;back </a>|
        <a href="friendlist.php" style="color: red;">remove friend</a>
    </p>
    <form class="flex" action="friendlist.php" method="get">
        <div class="form-container">
            <ul id="chat">
            </ul>
        </div>
    </form>
    <br>
    <form method="get" action="chat.php">
        <input type="text" id="message" placeholder="new message">
        <input type="button" value="Send" onclick="sendMessage()">
    </form>
    <script src="main.js"></script>
    <script>
        onChatLoad();
    </script>
</body>

</html>