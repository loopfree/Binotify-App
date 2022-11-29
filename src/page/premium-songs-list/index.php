<?php
    session_start();
    if (!($_SESSION["logged_in"])) {
        header("Location: /index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>\(OwO)/</title>
    <link rel="stylesheet" href="premium-songs-list.css">
    <script src="premium-songs-list.js" defer></script>
</head>
<body class="dark-bg body">
    <nav class="nav"></nav>
    <div id="profile" class="profile"></div>
    <main>
        <h1 class="title">Songs</h1>
        <div id="songs-container" class="songs-container"></div>
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>