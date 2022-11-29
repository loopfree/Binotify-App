<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: /index.php");
}

if (!isset($_SESSION['logged_in'])) {
    $_SESSION["logged_in"] = false;
}

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

$json_content = file_get_contents("php://input");

$decoded = json_decode($json_content, true);

$username = $decoded["username"];
$password = $decoded["password"];
$passwordHashed = hashPasswordTo($password);

$query = "
    SELECT 
        user_id,
        is_admin
    FROM
        \"User\"
    WHERE
        username = $1
        AND
        password = $2;
";

$json = array();
$result = pg_query_params($conn, $query, [$username, $passwordHashed]);
$row = pg_fetch_row($result);

if ($row === false) {
    $json += ["success" => "false"];
} else {
    $json += ["success" => "true"];
    /**
     * $row[0] is user_id
     */
    $json += ["user-id" => $row[0]];

    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $row[0];
    $_SESSION['username'] = $username;
    if($row[1] === "f") {
        $_SESSION["admin"] = false;
    } else {
        $_SESSION["admin"] = true;
    }
}

echo json_encode($json);

?>