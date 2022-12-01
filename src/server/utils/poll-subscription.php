<?php
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
$res = $client->__soapCall('retrieveAllStatus', array());

require $_SERVER['DOCUMENT_ROOT'] . '/server/utils/db_connection.php';
pg_prepare($conn, "", "INSERT INTO \"Subscription\" 
                       VALUES ($1, $2, $3)
                       ON CONFLICT (creator_id, subscriber_id) DO UPDATE SET status = $3;");

// Nothing
if (!property_exists($res, "return")) {
    // do nothing
}
else {
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
}
?>