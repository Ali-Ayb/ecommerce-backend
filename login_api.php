<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    echo 'already logedin';
    exit;
}

require_once "connection_db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) && isset($_POST['password'])) {

        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        if (empty($email)) {
            $err =  'email is empty';
            $response = [
                "response" => $err
            ];
            echo json_encode([$response]);

            exit();
        } else if (empty($password)) {
            $err =  'Password is required"';
            $response = [
                "response" => $err
            ];
            echo json_encode([$response]);

            exit();
        } else {
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($link, $sql);

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $password = hash('sha256', $password . $row['salt']);

                if ($row['email'] === $email && $row['password'] === $password) {
                    echo "Logged in!";
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['loggedin'] = true;
                } else {
                    $err =  'Password is required"';
                    $response = [
                        "response" => $err
                    ];
                    echo json_encode([$response]);
                }
            } else {
                $err =  'failed"';
                $response = [
                    "response" => $err
                ];
                echo json_encode([$response]);
            }
        }
    } else {

        $err =  'failed"';
        $response = [
            "response" => $err
        ];
        echo json_encode([$response]);
    }
} else {
    $err =  'failed"';
    $response = [
        "response" => $err
    ];
    echo json_encode([$response]);
}
