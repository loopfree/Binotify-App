<?php
$requestSubscriptionUrl = "http://localhost:8042/check?wsdl";

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
pg_prepare($conn, "pollUpdate", "UPDATE \"Subscription\" 
                                 SET status = $1 WHERE creator_id = $2 AND subscriber_id = $3;");

foreach ($res->return as $data) {
    pg_execute($conn, "pollUpdate", [$data->status, $data->creatorId, $data->subscriberId]);
}

?>