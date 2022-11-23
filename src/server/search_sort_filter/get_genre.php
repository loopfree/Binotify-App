<?php

require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';

$conn = pg_connect($postgreUrl);

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