<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

require 'connection.php';
$userNameErr = '';

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
        $salt = generateRandomString(5);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashedPassword = hash('sha256', $password . $salt);
        $stmt = mysqli_prepare($link, "SELECT username FROM users WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $userNameErr =  'username Already exists';
        } else {
            $sql = "INSERT INTO users ( username, password, salt) VALUES (?, ?, ?)";
            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPassword, $salt);
                if (mysqli_stmt_execute($stmt)) {
                    $success = "Insert Successful";
                    header('Location: Login.html');
                } else {
                    $err =  "Error Execute";
                }
            } else {
                echo  "Error Prepare";
            }
        }
    }
}
