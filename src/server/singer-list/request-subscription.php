<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';

session_start();

if(!isset($_GET["creator_id"])) {
    return;
}

$creatorId = hashUsername($_GET["creator_id"]);
$subscriberId = hashUsername($_SESSION["username"]);

$requestSubscriptionUrl = "http://catify-soap:8042/request?wsdl";

$options = array(
    "stream_context" => stream_context_create([
        "socket" => [
                "bindto" => "0:0"
            ]
        ]),
    "trace" => 1,
    "exception" => 0
);

$client = new SoapClient($requestSubscriptionUrl, $options);

$req = array(
    "subscriberId" => $subscriberId,
    "creatorId" => $creatorId
);

$res = $client->__soapCall('requestSubscription', array($req));

$query = "SELECT status FROM \"Subscription\" WHERE creator_id = $1 AND subscriber_id = $2";

$check = pg_query_params($conn, $query, [$creatorId, $subscriberId]);

$exists = false;

if($row = pg_fetch_row($check)) {
    $exists = true;
}

if(!$exists) {
    $query = "INSERT INTO \"Subscription\"
                VALUES ( $1, $2, 'PENDING');
            ";
    
    pg_query_params($conn, $query, [$creatorId, $subscriberId]);
} else {
    $query = "UPDATE \"Subscription\" SET status = 'PENDING' WHERE creator_id = $1 AND subscriber_id = $2";
    pg_query_params($conn, $query, [$creatorId, $subscriberId]);
}

echo json_encode($res);
?>