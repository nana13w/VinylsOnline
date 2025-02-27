<?php 

require_once "connectVinylsOnline.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($email && $password) {
        $query = "SELECT userID, email, password FROM user WHERE email = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {

            if (password_verify($password, $user["password"])) {

                $_SESSION["userID"] = $user["userID"];
                $_SESSION["email"] = $user["email"];

                header("Location: loginSuccess.php");
                exit;

            } else {
                $_SESSION["error"] = "Invalid email or password";
            } 
        } else {
                $_SESSION["error"] = "Invalid email or password";
            }

            header("Location: login.php");
            exit();
    }
}

?>