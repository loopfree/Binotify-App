<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

$result = pg_query($conn, 'SELECT * FROM "Album" ORDER BY Judul;');
$content = "";

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $album_id = pg_fetch_result($result, $row, "album_id");
    $title = pg_fetch_result($result, $row, "Judul");
    $year = (new DateTime(pg_fetch_result($result, $row, "Tanggal_terbit")))->format("Y");
    $artist = pg_fetch_result($result, $row, "Penyanyi");
    $genre = pg_fetch_result($result, $row, "Genre");
    if (trim($genre) != "") {
        $genre = "• " . $genre;
    }
    $imgpath = pg_fetch_result($result, $row, "Image_path");

    $content .= "
        <div class='album-card' album-id=$album_id>
            <img 
                src='$imgpath'
                alt='$title'
                class='album-image'
            >
            <div class='album-info'>
                <h2 class='album-title'>$title</h2>
                <p class='album-desc'>$year • $artist $genre</p>
            </div>
            <div class='play-button'>
                <div class='triangle'></div>
            </div>
        </div>
    ";
}

echo $content;

?>