<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: /page/login/");
}
else {
    header("Location: /page/home/");
}
?>