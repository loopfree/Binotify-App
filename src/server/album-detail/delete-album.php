<?php
$albumId = $_GET["album-id"];

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");
pg_query_params($conn, "UPDATE \"Song\" SET album_id=$1 WHERE album_id=$2", [NULL, $albumId]);
pg_query_params($conn, "DELETE FROM \"Album\" WHERE album_id=$1", [$albumId]);
pg_close($conn);

header("Refresh: 0; url=/page/album-list/");
?>