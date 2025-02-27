<?php require_once "connectVinylsOnline.php";

if (!isset($_SESSION["userID"])) {
    header("Location: login.php");
    exit();
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Invalid Reference.");
}

$userID = $_SESSION["userID"];

$query = "SELECT * FROM products WHERE userID = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $userID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " .mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update your vinyls</title>
</head>
<body>
    <h2>Update List - choose which record to update</h2>

    <div>
        <div>

        <?php

while ($row=mysqli_fetch_array($result)): ?>

                        <div class="updateDetails">
                            <?= "ID: " . $row['id']; ?><br>
                            <?= "Artist: " . $row['artist']; ?><br>
                            <?= "Album: " . $row['album']; ?><br>
                            <?= "Year: " . $row['year']; ?><br>
                            <?= "Genre: " . $row['genre']; ?><br>
                            <?= "Image: " . $row['albumCover']; ?><br>
                            <?= "Price: " . $row['price']; ?><br>
                        </div>
                        <div>
                            <img src="<?= $row["albumCover"]; ?>" alt="Image of <?= $row["artist"] . " - " . $row["album"]; ?>" width="150">
                        </div>
                        <div>
                            <a class="updateBtn" href="update.php?id=<?=$row["id"] ?>">UPDATE</a>
                        </div>

                        <?php endwhile; ?>


        </div>
    </div>
    


</body>
</html>