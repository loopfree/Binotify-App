<?php
if(isset($_GET["name"])) {
    $name = $_GET["name"];

    $conn = pg_connect("host=localhost port=5432 dbname=tubesIF3110 user=postgres password=admin");

    $query = "
        SELECT
            *
        FROM
            \"User\"
        WHERE
            username = '$name';
    ";

    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);

    if($row !== false) {
        echo "not unique";
    } else {
        echo "unique";
    }

    pg_close($conn);
}

if(isset($_GET["email"])) {
    $email = $_GET["email"];

    $conn = pg_connect("host=localhost port=5432 dbname=tubesIF3110 user=postgres password=admin");

    $query = "
        SELECT
            *
        FROM
            \"User\"
        WHERE
            email = '$email';
    ";

    $result = pg_query($conn, $query);

    $row = pg_fetch_row($result);

    if($row !== false) {
        echo "not unique";
    } else {
        echo "unique";
    }

    pg_close($conn);
}
?>