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

    if($row !== false) {
        echo "not unique";
    } else {
        echo "unique";
    }

    pg_close($conn);
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

    if($row !== false) {
        $isUnique = "not unique";
    } else {
        $isUnique = "unique";
    }

    // regex = ^\w+@[A-Za-z]+[.][A-Za-z]+([.][A-Za-z]+)*$
    $regexp = "/^\w+@[A-Za-z]+[.][A-Za-z]+([.][A-Za-z]+)*$/i";

    if(preg_match($regexp, $email) === 1) {
        $isUnique = "unique";
    } else {
        $isUnique = "not unique";
    }

    echo $isUnique;

    pg_close($conn);
}
?>