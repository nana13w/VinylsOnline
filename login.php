<?php require_once "connectVinylsOnline.php";

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

    <?php 
    $errorMessage = $_SESSION["error"] ?? "";

    unset($_SESSION["error"]);
    ?>
    <main>


        <section>

            <div class="register">
                <form class="registerForm" action="loginCheck.php" method="post">
                <h2>Login</h2>

                    <input type="text" name="email" required placeholder="Email Address"><br><br>
                    <input type="password" name="password" required placeholder="Password"><br><br>
                    
                    <?php if (!empty($errorMessage)): ?>
                        <p class="errorMessage">*<?= $errorMessage ?></p>
                    <?php endif; ?>
                    
                    <div class="submitForm">
                    <button class="submitReg" type="submit" 
                    name="add">Login</button></div>
                </form>
            </div>



        </section>

        <?php include "footer.php"; ?>
    </main>

</body>

</html>