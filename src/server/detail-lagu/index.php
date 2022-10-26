<?php

$param = "?";

$songId = $_GET["song-id"];

$param .= "song-id=$songId";

if(isset($_GET["autoplay"])) {
    $param .= "&autoplay=true";
}

header("Location: /page/detail-lagu/index.php$param");

?>