<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    $_SESSION["admin"] = false;
    header("Location: /page/login/");
}
else {
    header("Location: /page/home/");
}
?>