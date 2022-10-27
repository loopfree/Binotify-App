<?php

$json_content = file_get_contents("php://input");

$decoded = json_decode($json_content, true);

$songId = $decoded["songId"];
$judul = $decoded["judul"];
$album = $decoded["album"];
$tanggalTerbit = $decoded["tanggalTerbit"];
$genre = $decoded["genre"];
$newSong = $decoded["newSong"];
$newImage = $decoded["newImage"];
$albumId = null;

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

if($judul !== "") {
    $query = "
        UPDATE 
            \"Song\"
        SET 
            judul = '$judul'
        WHERE
            song_id = $songId; 
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        echo "error";
        return;
    }
}

if($album !== "") {
    $query = "
        SELECT
            album_id
        FROM
            \"Album\"
        WHERE
            judul = '$album';
    ";

    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);

    if($row === false) {
        echo "album doesn't exist";
        return;
    }

    $albumId = $row[0];

    $query = "
        UPDATE
            \"Song\"
        SET
            album_id = $albumId
        WHERE
            song_id = $songId;
    ";

    $result = pg_query($conn, $query);

    if($result === false) {
        echo "error";
        return;
    }
}

pg_close($conn);
?>