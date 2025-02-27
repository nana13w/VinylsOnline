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

    <?php

    if (!isset($_SESSION["email"])) {
        header("Location: login.php");
    }
    require_once "connectVinylsOnline.php";

    ?>

    <main>


        <section>

            <div class="register">
                <form class="sellForm" action="addSell.php" method="post" enctype="multipart/form-data">
                    <h2>Sell your vinyl</h2>
                    <div class="dataInput"><input type="text" name="artist" required placeholder="Artist name"><br><br>
                        <input type="text" name="album" required placeholder="Album name"><br><br>
                        <input type="text" name="year" required placeholder="Year released"><br><br>
                        <input type="text" name="genre" required placeholder="Genre"><br><br>
                        <input type="file" id="albumCover" name="albumCover" accept="images/*" require placeholder="Image of an album"><br><br>
                        <input type="text" name="price" required placeholder="Price">
                    </div><br><br>
                    <div class="submitForm">
                        <button class="submitReg" type="submit"
                            name="sell">Upload</button>
                    </div>
                </form>
            </div>



        </section>

        <?php include "footer.php"; ?>
    </main>

</body>

</html>