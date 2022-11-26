<?php

require $_SERVER['DOCUMENT_ROOT'] . '/db_connection.php';

$result = pg_query($conn, 'SELECT Username, Email FROM "User" WHERE is_admin=false;');
$content = "";

for ($row = 0; $row < pg_num_rows($result); $row++) {
    $uname = pg_fetch_result($result, $row, "Username");
    $email = pg_fetch_result($result, $row, "Email");

    $content .= "
        <tr>
            <td>$uname</td>
            <td>$email</td>
        </tr>
    ";
}

echo $content;

?>