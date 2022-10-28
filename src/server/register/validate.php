<?php
if(isset($_GET["name"])) {
    $name = $_GET["name"];

    $conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

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

    $regexp = "/^[A-Za-z_0-9]+$/i";

    $isUnique;

    if($row !== false || preg_match($regexp, $name) === 0) {
        $isUnique = "not unique";
    } else {
        $isUnique = "unique";
    }

    pg_close($conn);
    echo $isUnique;
}

if(isset($_GET["email"])) {
    $email = $_GET["email"];

    $conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

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

    $isUnique;

    // regex = ^\w+@[A-Za-z]+[.][A-Za-z]+([.][A-Za-z]+)*$
    $regexp = "/^\w+@[A-Za-z]+[.][A-Za-z]+([.][A-Za-z]+)*$/i";

    if($row !== false || preg_match($regexp, $email) === 0) {
        $isUnique = "not unique";
    } else {
        $isUnique = "unique";
    }

    // if(preg_match($regexp, $email) === 1) {
    //     $isUnique = "unique";
    // } else {
    //     $isUnique = "not unique";
    // }

    echo $isUnique;

    pg_close($conn);
}
?>