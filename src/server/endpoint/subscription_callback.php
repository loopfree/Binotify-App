<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';

$json_content = file_get_contents("php://input");
$decoded = json_decode($json_content, true);

$query = "UPDATE \"Subscription\" SET status = $1 WHERE creator_id = $2 AND subscriber_id = $3";

pg_query_params($conn, $query, [$decoded["status"], $decoded["creatorId"], $decoded["subscriberId"]]);

?>