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