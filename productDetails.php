<?php
session_start();
require_once "connectVinylsOnline.php";

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

<p class="discount">Use code VINYLS_ONLINE2024 to receive 20% discount!!!</p>
<header>
    <div class="top">
        <img class="logo" src="images/logo.png" alt="logo">

        <div class="rightTop">
            <div class="search_login">

                <div class="searchContainer">
                    <form action="searchList.php" method="GET" class="searchBox">
                        <input type="search" name="searching" placeholder="Search..." require>
                        <button type="submit" name="search" value="Find" class="searchBtn"><i class="fa fa-search"></i></button>
                    </form>
                </div>

                <div class="linksLogin buttons">
                    <?php if (isset($_SESSION["email"])): ?>
                        <a class="logoutBtn smallLogin">Logout</a>

                    <?php else: ?>
                        <a class="loginButton smallLogin">Login</a>
                        <a class="registerBtn smallLogin"> Register</a>
                    <?php endif; ?>
                    <div class="buttons">
                    </div>
                </div>
            </div>

            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav id="nav-menu">
                <a href="index.php">
                    <span class="underline">Home
                        <hr>
                    </span>
                </a>

                <a href="productList.php">
                    <span class="underline">Shop
                        <hr>
                    </span>
                </a>

                <a href="sellForm.php">
                    <span class="underline">Sell
                        <hr>
                    </span>
                </a>

                <a href="yourSell.php">
                    <span class="underline">Your sells
                        <hr>
                    </span>
                </a>

                <a href="loginSuccess.php">
                    <span class="underline">Account
                        <hr>
                    </span>
                </a>
                <a href="contactUs.html">
                    <span class="underline">Contact Us
                        <hr>
                    </span>
                </a>
            </nav>
        </div>
    </div>
</header>
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