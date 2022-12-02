<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/hash.php';
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/apikey.php';

session_start();

if(!isset($_GET["creator_id"])) {
    return;
}

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

$creatorId = $_GET["creator_id"];
$subscriberId = $_SESSION["user_id"];

$req = array(
    "apiKey" => $apikey,
    "subscriberId" => $subscriberId,
    "creatorId" => $creatorId
);

$res = $client->__soapCall('requestSubscription', array($req));

echo json_encode($res);
?>