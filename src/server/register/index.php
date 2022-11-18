<?php
(function(){
    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/hash.php';

    $json_content = file_get_contents("php://input");

    $decoded = json_decode($json_content, true);

    $username = $decoded["username"];
    $email = $decoded["email"];
    $password = $decoded["password"];
    $passwordHashed = hashPasswordTo($password);

    $userId = hashUsername($username);

    $conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

    $query = "INSERT INTO \"User\"
              VALUES ($1, $2, $3, $4, $5);";

    $result = pg_query_params($conn, $query, [$userId, $email, $passwordHashed, $username, false]);

    if(!$result) {
        echo "fail";
    } else {
        echo "succeed";
    }

    pg_close($conn);
})();
?>