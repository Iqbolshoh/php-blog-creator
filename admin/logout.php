<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: ./login.php");
    exit;
}

session_destroy();
session_unset();

header("Location: ./login.php");
exit;
