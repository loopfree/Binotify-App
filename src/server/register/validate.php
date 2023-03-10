<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
if(isset($_GET["name"])) {

    $name = $_GET["name"];

    $query = "
        SELECT
            *
        FROM
            \"User\"
        WHERE
            username = $1;
    ";

    $result = pg_query_params($conn, $query, [$name]);

    $row = pg_fetch_row($result);

    $regexp = "/^[A-Za-z_0-9]+$/i";

    $isUnique;

    if($row !== false || preg_match($regexp, $name) === 0) {
        $isUnique = "not unique";
    } else {
        $isUnique = "unique";
    }

    echo $isUnique;
}

if(isset($_GET["email"])) {
    $email = $_GET["email"];

    $query = "
        SELECT
            *
        FROM
            \"User\"
        WHERE
            email = $1;
    ";

    $result = pg_query_params($conn, $query, [$email]);

    $row = pg_fetch_row($result);

    $isUnique;

    // regex = ^\w+@[A-Za-z]+[.][A-Za-z]+([.][A-Za-z]+)*$
    $regexp = "/^\w+@[A-Za-z]+[.][A-Za-z]+([.][A-Za-z]+)*$/i";

    if($row !== false || preg_match($regexp, $email) === 0) {
        $isUnique = "not unique";
    } else {
        $isUnique = "unique";
    }

    echo $isUnique;

}
?>