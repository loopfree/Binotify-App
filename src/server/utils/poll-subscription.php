<?php
require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/apikey.php';

$requestSubscriptionUrl = "http://catify-soap:8042/check?wsdl";

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

$arg = array(
    "apiKey" => $apikey
);

$res = $client->__soapCall('retrieveAllStatus', array($arg));

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
pg_prepare($conn, "", "INSERT INTO \"Subscription\" 
                       VALUES ($1, $2, $3)
                       ON CONFLICT (creator_id, subscriber_id) DO UPDATE SET status = $3;");

// Single Object
if ($res->return instanceof stdClass) {
    pg_execute($conn, "", [$res->return->creatorId, $res->return->subscriberId, $res->return->status]);
}
// Array of Object
else {
    foreach ($res->return as $data) {
        pg_execute($conn, "", [$data->creatorId, $data->subscriberId, $data->status]);
    }
}
?>