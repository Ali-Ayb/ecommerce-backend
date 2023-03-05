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

        $salt = generateRandomString(5);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = hash('sha256', $password . $salt);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birth = $_POST['birth_date'];
        $age = calculateAgeFromBirth($birth);
        $gender = $_POST['gender'];
        $date_created = date("Y-m-d H:i:s");
        $deleted = 0;

        $stmt = mysqli_prepare($link, "SELECT email FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
}
