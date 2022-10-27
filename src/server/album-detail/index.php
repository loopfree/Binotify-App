<?php
$json = array();
$album_id = $_GET["album-id"];
$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

$query = "SELECT * FROM \"Album\" WHERE album_id = $album_id;";
$result = pg_query($conn, $query);
$json += ["title" => pg_fetch_result($result, 0, "Judul")];
$json += ["date" => (new DateTime(pg_fetch_result($result, 0, "Tanggal_terbit")))->format("d M Y")];
$json += ["artist" => pg_fetch_result($result, 0, "Penyanyi")];
$json += ["genre" => pg_fetch_result($result, 0, "Genre")];
$json += ["imgpath" => pg_fetch_result($result, 0, "Image_path")];
$json += ["duration" => pg_fetch_result($result, 0, "Total_duration")];

$query = "SELECT Judul, EXTRACT(YEAR FROM Tanggal_terbit) AS Tahun, Penyanyi, Image_path 
          FROM \"Song\" WHERE album_id = $album_id;";
$result = pg_query($conn, $query);
$content = "";

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $title = pg_fetch_result($result, $row, "Judul");
    $year = pg_fetch_result($result, $row, "Tahun");
    $artist = pg_fetch_result($result, $row, "Penyanyi");
    $imgpath = pg_fetch_result($result, $row, "Image_path");
    $song_nb = $row + 1;
    $content .= "
        <div class='song'>
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
                <div class='penyanyi'>$year</div>
                <div class='blank'></div>
                <div class='tahun'>$year</div>
                <div class='remove'>
                    <button>Remove</button>
                </div>
            </div>
        </div>
    ";
}

$json += ["song-list-html" => $content];

pg_close($conn);

echo json_encode($json);
?>