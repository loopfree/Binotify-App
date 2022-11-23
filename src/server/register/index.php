<?php
(function(){
    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/hash.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';

    $json_content = file_get_contents("php://input");

    $decoded = json_decode($json_content, true);

    $username = $decoded["username"];
    $email = $decoded["email"];
    $password = $decoded["password"];
    $passwordHashed = hashPasswordTo($password);

    $userId = hashUsername($username);

    $conn = pg_connect($postgreUrl);

    $query = "INSERT INTO \"User\"
              VALUES ($1, $2, $3, $4, $5);";

    $result = pg_query_params($conn, $query, [$userId, $email, $passwordHashed, $username, "f"]);

    if(!$result) {
        echo "fail";
    } else {
        echo "succeed";
    }

    pg_close($conn);
})();
?>