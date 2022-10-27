<?php

$songId = $_POST["song-id"];

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

$query = "
    DELETE FROM
        \"Song\"
    WHERE
        song_id = $songId;
";

$result = pg_query($conn, $query);

header("Location: /index.php");

pg_close($conn);

?>