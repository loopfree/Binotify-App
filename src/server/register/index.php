<?php
(function(){
    if($_SERVER["REQUEST_METHOD"] !== "POST") {
        return;
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';
    require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

    $json_content = file_get_contents("php://input");

    $decoded = json_decode($json_content, true);

    $username = $decoded["username"];
    $email = $decoded["email"];
    $password = $decoded["password"];
    $passwordHashed = hashPasswordTo($password);

    $query = "INSERT INTO \"User\" (email, password, username, is_admin)
              VALUES ($1, $2, $3, $4);";

    $result = pg_query_params($conn, $query, [$email, $passwordHashed, $username, "f"]);

    if(!$result) {
        echo "fail";
    } else {
        echo "succeed";
    }

})();
?>