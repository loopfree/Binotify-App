<?php
require $_SERVER['DOCUMENT_ROOT'] . '/utils/db_connection.php';

$albumId = $_GET["album-id"];

pg_query_params($conn, "UPDATE \"Song\" SET album_id=$1 WHERE album_id=$2", [NULL, $albumId]);
pg_query_params($conn, "DELETE FROM \"Album\" WHERE album_id=$1", [$albumId]);

header("Refresh: 0; url=/page/album-list/");
?>