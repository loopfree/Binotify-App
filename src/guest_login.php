<?php
session_start();

$_SESSION["logged_in"] = false;
$_SESSION["admin"] = false;

header("Location: /page/home")
?>