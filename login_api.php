<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo 'already logedin';
    exit;
}

require_once "connection_db.php";
