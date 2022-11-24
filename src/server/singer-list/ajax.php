<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';
require $_SERVER['DOCUMENT_ROOT'] . '/hash.php';

$conn = pg_connect($postgreUrl);

$query = "SELECT DISTINCT penyanyi FROM \"Song\"";

$result = pg_query($conn, $query);

$resp = array();

while($row = pg_fetch_row($result)) {
    /**
     * storing the singer and subscription status in an
     * associative array, to make it easier to be read in the
     * frontend later
     */
    $temp = array();
    $temp += ["singer-name" => $row[0]];

    $query = "SELECT 
                    status 
                FROM 
                    \"Subscription\"
                WHERE
                    creator_id = $1
                    AND
                    subscriber_id = $2;
                ";
    
    $creatorId = hashUsername(trim($row[0]));
    $subscriberId = hashUsername($_SESSION["username"]);

    $subscriptionStatus = pg_query_params($conn, $query, [$creatorId, $subscriberId]);

    $status = "";

    if($row2 = pg_fetch_row($subscriptionStatus)) {
        $status = $row2[0];
    }

    $temp += ["status" => $status];

    $resp[] = $temp;
}

echo json_encode($resp);

pg_close($conn);

?>