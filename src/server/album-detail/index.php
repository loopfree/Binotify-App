<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

session_start();

$json = array();
$json += ["admin" => $_SESSION["logged_in"] && $_SESSION["admin"]];

$album_id = $_GET["album-id"];

$query = "SELECT * FROM \"Album\" WHERE album_id = $album_id;";
$result = pg_query($conn, $query);
$json += ["title" => pg_fetch_result($result, 0, "Judul")];
$json += ["date" => (new DateTime(pg_fetch_result($result, 0, "Tanggal_terbit")))->format("d M Y")];
$json += ["artist" => pg_fetch_result($result, 0, "Penyanyi")];
$json += ["genre" => pg_fetch_result($result, 0, "Genre")];
$json += ["imgpath" => pg_fetch_result($result, 0, "Image_path")];
$json += ["duration" => pg_fetch_result($result, 0, "Total_duration")];

$query = "SELECT song_id, Judul, EXTRACT(YEAR FROM Tanggal_terbit) AS Tahun, Penyanyi, Image_path 
          FROM \"Song\" WHERE album_id = $album_id;";
$result = pg_query($conn, $query);
$content = "";

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $song_id = pg_fetch_result($result, $row, "song_id");
    $title = pg_fetch_result($result, $row, "Judul");
    $year = pg_fetch_result($result, $row, "Tahun");
    $artist = pg_fetch_result($result, $row, "Penyanyi");
    $imgpath = pg_fetch_result($result, $row, "Image_path");
    $song_nb = $row + 1;
    $content .= "
        <div class='song' song-id='$song_id'>
            <div class='grid-container'>
                <div class='number'>$song_nb</div>
                <button class='play-button'>
                    <i class='fas fa-play'></i>
                </button>
                <div class='image'>
                    <div class='image-container'>
                        <img src='$imgpath' alt='song-image'/>
                    </div>
                </div>
                <div class='judul'>$title</div>
                <div class='penyanyi'>$artist</div>
                <div class='tahun'>$year</div>
                <div class='remove-button' song-id='$song_id'>
                    <lord-icon
                        src='/assets/lord-icon/delete-icon.json'
                        trigger='hover'
                        colors='primary:#ffffff'
                        style='width:2rem;height:2rem'>
                    </lord-icon>
                </div>
            </div>
        </div>
    ";
}

$json += ["song-list-html" => $content];

echo json_encode($json);
?>