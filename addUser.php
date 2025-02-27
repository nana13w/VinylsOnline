<?php session_start(); 
 require_once "connectVinylsOnline.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstName=$_POST["firstName"];
    $surname=$_POST["surname"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $password=$_POST["password"];

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO user (firstname, surname, phone, email, password) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $surname, $phone, $email, $hash);

    if (mysqli_stmt_execute($stmt)) {

        $userID = mysqli_insert_id($conn);

        $_SESSION["userID"] = $userID;
        $_SESSION["firstName"] = $firstName;
        $_SESSION["email"] = $email;

        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
?>