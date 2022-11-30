<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';

function requestSingerFromRest() {
    $url = "http://catify-rest:3000/premium_singer/list";

    $params = array('http' => array(
        'method' => 'POST',
    ));

    $ctx = stream_context_create($params);
    $fp = @fopen($url, 'rb', false, $ctx);

    if(!$fp) {
        throw new Exception('Problem with $url');
    }

    $response = @stream_get_contents($fp);
    if($response === false) {
        throw new Exception("Problem reading data from $url");
    }

    return $response;
}

$premiumSingers = json_decode(requestSingerFromRest());
$resp = array();

foreach ($premiumSingers->singers as $premiumSinger) {
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