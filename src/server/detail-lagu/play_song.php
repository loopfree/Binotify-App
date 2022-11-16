<?php

session_start();

if (isset($_SESSION["logged_in"])) {
    echo "valid";
    return;
}

if (isset($_SESSION["first-play-time"])) {
    if ((new DateTime())->diff($_SESSION["first-play-time"])->d >= 1) {
        unset($_SESSION["played-song"]);
        unset($_SESSION["first-play-time"]);
    }
}

if (!isset($_SESSION["played-song"])) {
    $_SESSION["played-song"] = [];
    $_SESSION["first-play-time"] = new DateTime();
}

$songId = $_GET["song-id"];

$playedSongArr = $_SESSION["played-song"];

if(!is_array($playedSongArr)) {
    $playedSongArr = [];
}

if(count($playedSongArr) < 3) {
    array_push($playedSongArr, 1);
    $_SESSION["played-song"] = $playedSongArr;
    echo "valid";
}

echo "invalid";

?>
