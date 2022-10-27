<?php
session_start();

$_SESSION["played-song"] = [];
$_SESSION["admin"] = false;

header("Location: /page/home")
?>