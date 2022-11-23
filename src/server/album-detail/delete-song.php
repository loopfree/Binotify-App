<?php
require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';

$albumId = $_GET["album-id"];
$songId = $_GET["song-id"];

$conn = pg_connect($postgreUrl);
pg_query_params($conn, "UPDATE \"Song\" SET album_id=$1 WHERE song_id=$2", [NULL, $songId]);
pg_query_params($conn, "UPDATE \"Album\" SET Total_duration=(SELECT COALESCE(SUM(Duration),0) FROM \"Song\" WHERE album_id=$1) 
                                         WHERE album_id=$1", [$albumId]);
pg_close($conn);

header("Refresh: 0; url=/page/album-detail/index.php?album-id=$albumId");
?>