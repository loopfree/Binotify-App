<?php

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

$query = "
    SELECT
        DISTINCT genre
    FROM
        \"Song\"
";

$result = pg_query($conn, $query);

pg_close($conn);

$res = array();

while($row = pg_fetch_row($result)) {
    $res[] = $row[0];
}

echo json_encode($res);

?>