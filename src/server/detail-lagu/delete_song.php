<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

$songId = $_POST["song-id"];

$query = "
    DELETE FROM
        \"Song\"
    WHERE
        song_id = $1;
";

$result = pg_query_params($conn, $query, [$songId]);

header("Location: /index.php");

?>