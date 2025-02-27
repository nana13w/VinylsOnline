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

    $artist=$_POST["artist"];
    $album=$_POST["album"];
    $year=$_POST["year"];
    $genre=$_POST["genre"];
 //   $albumCover=$_POST["albumCover"];
    $price=$_POST["price"];
    $id = $_POST["id"]; //new

    if (isset($_FILES["albumCover"]) && $_FILES["albumCover"]["error"] === 0) {

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
    
        if(file_exists($upload_dir . $filename)) {
            die("Error: A file with the name '$filename' already exist.");
        }
    
        if (!move_uploaded_file($_FILES["albumCover"]["tmp_name"], $upload_dir . $filename)) {
            die("Error: Failed to upload the file. Please try again.");
        }

        $albumCover = $upload_dir . $filename;

    } else {
        // No new image uploaded, use the existing one from the database
        // Retrieve the current albumCover from the database
        $query = "SELECT albumCover FROM products WHERE id = ? AND userID = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $id, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $existingAlbumCover);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Use the existing image if no new image is uploaded
        $albumCover = $existingAlbumCover;
    }

    if (empty($artist) || empty($album) || empty($year) || empty($genre) || empty($albumCover) || empty($price)) {
        die("Invalid input. Please ensure all fields are filled out correctly.");
    }
        $query = "UPDATE products SET 
            artist = ?,
            album = ?,
            year = ?,
            genre = ?,
            albumCover = ?,
            price = ? 
            WHERE id = ? AND userID = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ssssssii", $artist, $album, $year, $genre, $albumCover, $price, $id, $userID);

if (mysqli_stmt_execute($stmt)) {
    redirect_to("productDetails.php?id=" . $id);  // Redirect to the update list page after successful update
} else {
    die("Update failed: " . mysqli_error($conn));
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
}
?>