<?php

if($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Location: /page/login/");
    return;
}

header("Location: /page/home/");
?>