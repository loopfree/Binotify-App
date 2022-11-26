<?php

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

$query = "
    SELECT
        DISTINCT genre
    FROM
        \"Song\"
";

$result = pg_query($conn, $query);

$res = array();

while($row = pg_fetch_row($result)) {
    $res[] = $row[0];
}

echo json_encode($res);

?>