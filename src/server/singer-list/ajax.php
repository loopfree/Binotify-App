<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';

$restResponse = file_get_contents("localhost:3000/premium_singer/list");
$premiumSingers = json_decode($response);
$resp = array();

foreach ($premiumSingers["singers"] as $premiumSinger) {
    $temp = array();
    $temp += ["singer-name" => $premiumSinger["name"]];

    $query = "SELECT 
                    status 
                FROM 
                    \"Subscription\"
                WHERE
                    creator_id = $1
                    AND
                    subscriber_id = $2;
                ";

    $subscriptionStatus = pg_query_params($conn, $query, [$premiumSinger["id"], $_SESSION["user_id"]]);

    $status = "";

    if ($row2 = pg_fetch_row($subscriptionStatus)) {
        $status = $row2[0];
    }

    $temp += ["status" => $status];

    $resp[] = $temp;
}

echo json_encode($resp);

?>