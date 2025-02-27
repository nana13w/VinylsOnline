<?php require_once "connectVinylsOnline.php";

$query = "SELECT products.id, products.artist, products.album, products.price, products.albumCover, user.userID FROM products, user WHERE products.userID = user.userID";

$result = mysqli_query($conn, $query);

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


        <section>
            <h2> Vinyl Details</h2>

            <div class="newVinyls">

                <div class="pairs">

                    <div class="newVinylsImages">

                        <?php

                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_array($result)) {
                                $id=$row["id"];
                                $artist = $row["artist"];
                                $album = $row["album"];
                                $price = $row["price"];
                                $albumCover = $row["albumCover"];
                                $userID = $row["userID"];
                        ?>

                            <?php 
                            } 
                        } else {
                            echo "No record matching the query were found";
                        }
                            ?>


                            <div class="eachVinyl">
                                <img class="newRelImg" src="<?= "$albumCover"; ?>" alt="Image of <?=$album ?>">
                                <h3><?=$artist. "-". $album. " ";?></h3>
                                <p class="price"><?=$price;?></p>
                            </div>

                                </div>

                    </div>

        <?php include "footer.php"; ?>
    </main>


</body>

</html>