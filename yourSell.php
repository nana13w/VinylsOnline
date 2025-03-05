<?php
session_start();
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

    <?php require_once "connectVinylsOnline.php";

    if (!isset($_SESSION["userID"])) {
        header("Location: login.php");
        exit();
    }

    $userID = $_SESSION["userID"];

    $query = "SELECT products.id, products.artist, products.album, products.price, products.albumCover FROM products WHERE products.userID = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    ?>


    <main>


        <section>
            <h2>Your Vinyls for Sell</h2>


            <div class="pairs">


                <?php

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_array($result)) {

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
                            <div class="updateDelete">
                                <button class="sellUpdate" data-id="<?= $id ?>">Update</button>
                                <button class="sellDelete" data-id="<?= $id ?>">Delete</button>
                            </div>
                        </div>
                        <br><br>

                <?php
                    }
                } else {
                    echo "No records...";
                }
                ?>
            </div>


        </section>

        <?php include "footer.php"; ?>
    </main>



</body>

</html>