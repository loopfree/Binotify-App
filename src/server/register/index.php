<?php
(function(){
    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    require '/hash.php';

    $json_content = file_get_contents("php://input");

    $decoded = json_decode($json_content, true);

    $username = $decoded["username"];
    $email = $decoded["email"];
    $password = $decoded["password"];

    $userId = hashString($username);

    $conn = pg_connect("host=localhost port=5432 dbname=tubesIF3110 user=postgres password=admin");

    $query = "
        INSERT INTO
            \"User\"
        VALUES (
            $userId,
            '$email',
            '$password',
            '$username',
            false
        );
    ";

    $reuslt = pg_query($conn, $query);

    if(!$result) {
        echo "fail";
    } else {
        echo "succeed";
    }

    pg_close($conn);
})();
?>