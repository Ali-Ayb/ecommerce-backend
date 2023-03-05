<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    exit;
}

require 'connection_db.php';
$user_name_err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        function generateRandomString($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        function calculateAgeFromBirth($birth_date)
        {
            $today = date("Y-m-d");
            $diff = date_diff(date_create($birth_date), date_create($today));
            $age = $diff->format('%y');
            return $age;
        };
    }
}
