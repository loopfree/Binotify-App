<?php

if($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location: /page/login/");
    return;
}

$userId = $_POST["user-id"];

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

$query = "
    SELECT
        is_admin
    FROM
        \"User\"
    WHERE
        user_id='$userId';
";

$result = pg_query($conn, $query);

$row = pg_fetch_row($result);

session_start();

if($row !== false) {
    if($row[0] === 't') {
        $_SESSION['is-admin'] = true;
    } else {
        $_SESSION['is-admin'] = false;
    }
}

pg_close($conn);

header("Location: /page/home/");
?>