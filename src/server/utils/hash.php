<?php

function hashUsername($string) {
    $hash = 0;
    for($i = 0; $i < strlen($string); ++$i) {
        $hash += ord($string[$i]) + $i;
    }

    return $hash;
}

function hashPasswordTo($password) {
    $result = "";
    for($i = 0; $i < strlen($password); ++$i) {
        $result .= chr(ord($password[$i]) + 1);
    }

    return $result;
}

function hashPasswordFrom($password) {
    $result = "";
    for($i = 0; $i < strlen($password); ++$i) {
        $result .= chr(ord($password) - 1);
    }

    return $result;
}

?>