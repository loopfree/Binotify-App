<?php
    session_start();
    if (!($_SESSION["logged_in"])) {
        header("Location: /index.php");
    }
    if (!isset($_GET["album-id"])) {
        header("Location: /page/singer-list/");
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
        <h1 class="title">Premium songs</h1>
        <?php
            $user_id = $_SESSION["user_id"];
            $artist_id = $_GET["artist_id"];
            echo "<div id='songs-container' class='songs-container' user_id='$user_id' artist_id='$artist_id'></div>";
        ?>
    </main>
    <script src="https://cdn.lordicon.com/pzdvqjsp.js"></script>
</body>
</html>