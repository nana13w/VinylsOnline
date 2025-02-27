<?php
 require_once "connectVinylsOnline.php";

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

            <div class="register">
                <form class="registerForm" action="addUser.php" method="post" onsubmit="return validateForm()">
                <h2>Create a new account</h2>
                    <div class="nameSurname"><input type="text" name="firstName" required placeholder="First name"><br><br>
                    <input type="text" name="surname" required placeholder="Surname"></div><br><br><br>
                    <div class="dataInput"><input type="text" name="phone" required placeholder="Phone number"><br><br>
                    <input type="text" id="email" name="email" required placeholder="Email Address"><br><br>
                    <input type="password" id="password" name="password" required placeholder="Password"><br><br>
                    <input type="password" id="repeatPass" name="repeatPass" required placeholder="Repeat password"></div><br><br>
                    <div class="submitForm">
                    <button class="submitReg" type="submit" 
                    name="add">Register Now</button></div>
                </form>
            </div>



        </section>

        <?php include "footer.php"; ?>
    </main>

    <script>
function validateForm() {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const repeatPass = document.getElementById("repeatPass").value;
    
    // Email validation
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Password validation
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!passwordPattern.test(password)) {
        alert("Password must be at least 8 characters long, contain at least one uppercase letter, and one lowercase letter.");
        return false;
    }

    // Check if passwords match
    if (password !== repeatPass) {
        alert("Passwords do not match.");
        return false;
    }

    return true; // Allow form submission
}
</script>

</body>

</html>