<?php

require $_SERVER['DOCUMENT_ROOT'] . '/utils/db_connection.php';

$result = pg_query($conn, 'SELECT * FROM (SELECT song_id, Judul, EXTRACT(YEAR FROM Tanggal_terbit) AS Tahun, Penyanyi,
                           Genre, Image_path FROM "Song" ORDER BY song_id DESC LIMIT 10) AS temp ORDER BY Judul ASC;');
$content = "";

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $song_id = pg_fetch_result($result, $row, "song_id");
    $title = pg_fetch_result($result, $row, "Judul");
    $year = pg_fetch_result($result, $row, "Tahun");
    $artist = pg_fetch_result($result, $row, "Penyanyi");
    $genre = pg_fetch_result($result, $row, "Genre");
    $imgpath = pg_fetch_result($result, $row, "Image_path");
    if (trim($genre) != "") {
        $genre = "• " . $genre;
    }
    if (trim($artist) != "") {
        $artist = $artist . " •";
    }
    $content .= "
        <div class='song-card' song-id='$song_id'>
            <img 
                src='$imgpath'
                alt='$title'
                class='song-image'
            >
            <div class='song-info'>
                <h2 class='song-title'>$title</h2>
                <p class='song-desc'>$artist $year $genre</p>
            </div>
            <div class='play-button'>
                <div class='triangle'></div>
            </div>
        </div>
    ";
}

echo $content;

?>