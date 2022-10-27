<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    $_SESSION["played-song"] = [];
    $_SESSION["admin"] = false;
    header("Location: /page/login/");
}
else {
    header("Location: /page/home/");
}
?>