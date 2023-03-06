<?php
// session_start();

// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     echo 'already logedin';
//     exit;
// }

include "connection_db.php";
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

        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($link, $sql);
        $response = [];


        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $password = hash('sha256', $password . $row['salt']);

            if ($row['email'] === $email && $row['password'] === $password) {
                $response['user_id'] = $row['user_id'];

                echo json_encode($response);
                // $_SESSION['email'] = $row['email'];
                // $_SESSION['loggedin'] = true;
            }
        }
    }
}
