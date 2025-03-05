<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "connectVinylsOnline.php";

echo "Script is running";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["albumCover"]) && $_FILES["albumCover"]["error"] === 0) {

    echo "<pre>"; print_r($_FILES); print_r($_POST); echo "</pre>";


    $allowed = array(
        "jpeg" => "image/jpeg",
        "jpg" => "image/jpeg",
        "gif" => "image/gif",
        "png" => "image/png",
        "webp" => "image/webp"
    );

    $filename = basename($_FILES["albumCover"]["name"]);
    $filetype = $_FILES["albumCover"]["type"];
    $filesize = $_FILES["albumCover"] ["size"];
    $upload_dir = "images/";
    $maxSize = 5 * 1024 * 1024;

    if ($filesize > $maxSize) {
        die("Error: File size exceed the allowed limit of 5MB");
    }

    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!array_key_exists($ext, $allowed) || $filetype !== $allowed[$ext]) {
        die("Error: Invalid file format. Detected: " . $filetype);
    }
    


    echo "File type detected: " . $filetype;

    if(file_exists($upload_dir . $filename)) {
        die("Error: A file with the name '$filename' already exist.");
    }

    if (!move_uploaded_file($_FILES["albumCover"]["tmp_name"], $upload_dir . $filename)) {
        die("Error: Failed to upload the file. Please try again.");
    }
    

    if (!isset($_SESSION["email"])) {
        die("Error: User not logged in");
    }

    if (!isset($_SESSION["userID"]) || empty($_SESSION["userID"])) {
        die("Error: User ID is not set.");
    }


    $artist=$_POST["artist"];
    $album=$_POST["album"];
    $year=$_POST["year"];
    $genre=$_POST["genre"];
    $albumCover= $upload_dir . $filename;
    $price=$_POST["price"];
    $dateAdded = date("Y-m-d H:i:s");  // Getting today's date and time
    $userID=$_SESSION["userID"];

    if (!isset($_SESSION["userID"])) {
        die("Error: User ID is not set.");
    }

    $query = "INSERT INTO products (artist, album, year, genre, albumCover, dateAdded, price, userID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssdi", $artist, $album, $year, $genre, $albumCover, $dateAdded, $price, $userID);

    if (mysqli_stmt_execute($stmt)) {
        echo "Vinyl added for sell";

        $id = mysqli_insert_id($conn);
        
        header("Location: productDetails.php?id=$id");
        exit();
    } else {
        echo "Erros: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>