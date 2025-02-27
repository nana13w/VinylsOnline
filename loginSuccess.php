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

    require_once "connectVinylsOnline.php";

    if (!isset($_SESSION["email"]) || !isset($_SESSION["userID"])) {
        header("Location: index.php");
        exit();
    }

    $email = $_SESSION["email"];

    $query = "SELECT firstName FROM user WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        $firstName = $user["firstName"];
    } else {
        echo "User not found";
        exit();
    }
    ?>

    <main>


        <section>



            <h2>Welcome, <?php echo $firstName; ?></h2>

            <div class="account">

                <a class="accountField" href="updateDetails.php">Update your details</a>
                <hr>

                <a class="accountField" href="update.php">Your orders</a>
                <hr>

                <a class="accountField" href="yourSell.php">Your sells</a>

            </div>






        </section>

        <?php include "footer.php"; ?>
    </main>

</body>

</html>