<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    $_SESSION["logged_in"] = false;
    header("Location: /page/login/");
}
else {
    header("Location: /page/home/");
}
?>