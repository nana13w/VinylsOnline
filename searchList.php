<?php require_once "connectVinylsOnline.php";

function getProducts($conn, $searching = null)
{

    if ($searching) {
        $searching = mysqli_real_escape_string($conn, $searching);
        $query = "SELECT * FROM products WHERE artist LIKE '%$searching%' OR album LIKE '%$searching%' OR genre LIKE '%$searching%'";
    } else {
        $query = "SELECT * FROM products";
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($conn));
    }
    return $result;
}

$searching = isset($_GET["searching"]) ? $_GET["searching"] : null;
$product = getProducts($conn, $searching);

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

            <div class="pairs">


                <?php
if (mysqli_num_rows($product) > 0):
                while ($row = mysqli_fetch_assoc($product)):
                    $id = $row["id"];
                    $artist = $row["artist"];
                    $album = $row["album"];
                    $genre = $row["genre"];
                    $price = $row["price"];
                    $albumCover = $row["albumCover"];
                ?>

                    <div class="eachVinylProducts">
                        <a href="productDetails.php?id=<?= $id ?>">
                            <img class="newRelImg" src="<?= $albumCover ?>" alt="Image of <?= $album ?>">
                        </a>
                        <h3><?= $artist . " - " . $album ?></h3>
                    </div><br><br>

                <?php endwhile; 
                endif ?>
            </div>


        </section>

        <?php include "footer.php"; ?>
    </main>
</body>

</html>