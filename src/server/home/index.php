<?php

$db_handle = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

// $no_of_rows = pg_query($db_handle, 'SELECT COUNT(*) FROM "Album";');     // for pagination

$result = pg_query($db_handle, 'SELECT Judul, EXTRACT(YEAR FROM Tanggal_terbit) AS Tahun, Penyanyi,
                                Genre, Image_path FROM "Song" ORDER BY Judul LIMIT 10;');
$content = "";

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $title = pg_fetch_result($result, $row, "Judul");
    $year = pg_fetch_result($result, $row, "Tahun");
    $artist = pg_fetch_result($result, $row, "Penyanyi");
    $genre = pg_fetch_result($result, $row, "Genre");
    $imgpath = pg_fetch_result($result, $row, "Image_path");

    $content .= "
        <a href=''>
            <div class='song-card'>
                <img 
                    src='$imgpath'
                    alt='$title'
                    class='song-image'
                >
                <div class='song-info'>
                    <h2 class='song-title'>$title</h2>
                    <p class='song-desc'>$artist • $year • $genre</p>
                </div>
                <div class='play-button'>
                    <div class='triangle'></div>
                </div>
            </div>
        </a>
    ";
}

pg_close($db_handle);

echo $content;

?>