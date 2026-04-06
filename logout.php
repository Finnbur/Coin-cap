<?php
session_start();
if(!isset($_SESSION['loggedIn'])) {
    header('Location: index.php');
    exit;
}
session_destroy();

header('location: index.php');