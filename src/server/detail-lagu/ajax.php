<?php

$getQuery = $_GET["q"];

require $_SERVER['DOCUMENT_ROOT'] . '/utils/db_connection.php';
switch($getQuery) {
	case "isadmin":

		$userId = $_GET["user-id"];

		$query = "
			SELECT 
				is_admin
			FROM
				\"User\"
			WHERE
				user_id = $1;
		";

		$result = pg_query_params($conn, $query, [$userId]);

		$row = pg_fetch_row($result);

		if($row !== false) {
			if($row[0] === "f") {
				echo "no";
			} else {
				echo "yes";
			}
		} else {
			echo "error";
		}

		break;

}

?>