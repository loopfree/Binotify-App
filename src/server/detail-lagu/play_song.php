<?php

session_start();

$songId = $_GET["song-id"];

$playedSongArr = $_SESSION["played-song"];

if(!is_array($playedSongArr)) {
    $playedSongArr = [];
}

if(count($playedSongArr) < 3) {
    if(in_array($songId, $playedSongArr)) {
        echo "valid";
        return;
    }

    $playedSongArr[] = $songId;

    $_SESSION["played-song"] = $playedSongArr;

    echo "valid";
    return;
}

echo "invalid";

?>
