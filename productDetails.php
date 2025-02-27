<?php require_once "connectVinylsOnline.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Invalid Reference");
}

$query = "SELECT id, artist, album, year, genre, dateAdded, price, albumCover FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Query failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    die("Error result: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
if (!$row) {
    die("Product not found");
}

$id = $row["id"];
$artist = $row["artist"];
$album = $row["album"];
$year = $row["year"];
$genre = $row["genre"];
$price = $row["price"];
$dateAdded = $row["dateAdded"];
$albumCover = $row["albumCover"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vinyls Online</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=New+Amsterdam&display=swap" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

    <?php include "header.php"; ?>

    <main>


        <section class="detailsSection">
            <h2><?= $artist, " ", "-", " ", $album ?></h2>

            <div class="newVinyls">
                <div class="details">
                    <div class="pairs">
                        <img class="largeImg" src="<?= "$albumCover"; ?>" alt="Image of <?= $artist, $album ?>">


                        <table>
                            <tr>
                                <th>Artist</th>
                                <td><?= $artist; ?></td>

                            </tr>

                            <tr>
                                <th>Album</th>
                                <td><?= $album; ?></td>
                            </tr>

                            <tr>
                                <th>Year Released</th>
                                <td><?= $year; ?></td>
                            </tr>

                            <tr>
                                <th>Genre</th>
                                <td><?= $genre;?></td>
                            </tr>

                            <tr>
                                <th>Date of Added</th>
                                <td><?= $dateAdded;?></td>
                            </tr>

                            <tr>
                                <th>Price</th>
                                <td>£<?= $price;?></td>
                            </tr>
                        </table>

                    </div>


                </div>
            </div>

        </section>

        <?php include "footer.php"; ?>
    </main>

</body>

</html>