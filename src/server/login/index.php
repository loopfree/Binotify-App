<?php
session_start();

if($_SERVER['REQUEST_METHOD'] === "GET") {
    header("Location: /index.php");
}

require $_SERVER['DOCUMENT_ROOT'] . '/hash.php';

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
        username = '$username'
        AND
        password = '$passwordHashed';
";

$json = array();

$conn = pg_connect("host=db_x port=5432 dbname=postgres user=postgres password=postgres");

$result = pg_query($conn, $query);

$row = pg_fetch_row($result);

if($row === false) {
    $json += ["success" => "false"];
} else {
    $json += ["success" => "true"];
    /**
     * $row[0] is user_id
     */
    $json += ["user-id" => $row[0]];

    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    if($row[1] === "f") {
        $_SESSION["admin"] = false;
    } else {
        $_SESSION["admin"] = true;
    }
}

pg_close($conn);

echo json_encode($json);

?>