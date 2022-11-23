<?php
require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';

$songId = $_POST["song-id"];

$conn = pg_connect($postgreUrl);

$query = "
    DELETE FROM
        \"Song\"
    WHERE
        song_id = $1;
";

$result = pg_query_params($conn, $query, [$songId]);

header("Location: /index.php");

pg_close($conn);

?>