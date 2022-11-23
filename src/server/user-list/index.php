<?php

require $_SERVER['DOCUMENT_ROOT'] . '/postgreurl.php';

$db_handle = pg_connect($postgreUrl);

$result = pg_query($db_handle, 'SELECT Username, Email FROM "User" WHERE is_admin=false;');
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

pg_close($db_handle);

echo $content;

?>