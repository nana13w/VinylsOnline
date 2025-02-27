<?php require_once "connectVinylsOnline.php";

function getProducts($conn)
{
    $query = "SELECT * FROM products ORDER BY dateAdded DESC LIMIT 12"; // Get 15 most recent products

    $result = mysqli_query($conn, $query); //hold all data from the SQL query

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }
    return $result;
}

$product = getProducts($conn);
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

    <div class="backgroundImg">
        <h1>WE SELL & BUY</h1>

        <div class="buttons">
        <?php if (!isset($_SESSION["email"])): ?> <!-- Check if user is not logged in --> 
            <button class="loginButton">Login</button>
            <button class="registerBtn"> Register</button>
            <?php endif; ?> <!-- Buttons will only show if the user is NOT logged in -->
        </div>

    </div>

    <main>

        <section>
            <h2>New Releases</h2>

            <div class="pairs">


                <?php

                while ($row = mysqli_fetch_assoc($product)):
                    $id = $row["id"];
                    $artist = $row["artist"];
                    $album = $row["album"];
                    $price = $row["price"];
                    $albumCover = $row["albumCover"];
                ?>

                    <div class="eachVinylProducts">
                        <a href="productDetails.php?id=<?= $id ?>">
                            <img class="newRelImg" src="<?= $albumCover ?>" alt="Image of <?= $album ?>">
                        </a>
                        <h3><?= $artist . " - " . $album ?></h3>
                        <p class="price">£<?= $price ?></p>
                    </div><br><br>

                <?php endwhile; ?>
            </div>


        </section>

        <?php include "footer.php"; ?>
    </main>

</body>

</html>