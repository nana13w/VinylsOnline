<?php 

require_once "connectVinylsOnline.php";

session_start();

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$userID = $_SESSION["userID"]; 

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

if (isset($_POST["updateSell"])) {

    $id = $_POST["id"];


        $query = "DELETE FROM products WHERE id = ? AND userID = ? LIMIT 1";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ii", $id, $userID);

if (mysqli_stmt_execute($stmt)) {
    redirect_to("yourSell.php");  // Redirect to your sell page
} else {
    die("Delete failed: " . mysqli_error($conn));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
}
?>