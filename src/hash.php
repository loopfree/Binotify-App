<?php

function hashString($string) {
    $hash = 0;
    for($i = 0; $i < strlen($string); ++$i) {
        $hash += ord($string[$i]) + $i;
    }

    return $hash;
}

?>