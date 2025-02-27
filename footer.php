<section>
    <footer>
        <div class="footerSection">
            <div>
                <nav>

                    <ul>
                        <li>
                            <a class="links" href="index.html">Information</a>
                            <br>
                            <p>Contact</p>
                            <br>
                            <p>Privacy</p>
                            <br>
                            <p>Shipping</p>
                            <br>
                            <p>Refunds</p>
                        </li>

                        <li>
                            <a class="links" href="latest.html">Community</a>
                            <br>
                            <p>Our Story</p>
                            <br>
                            <p>Career</p>
                            <br>
                            <p>Store Locator</p>
                            <br>
                            <p>Become a Dealer</p>
                            <br>
                            <p>Discounts</p>
                        </li>
                        <li>
                            <a class="links" href="contactUs.html">Contact Us</a>
                            <br>
                            <p>Customer Support</p>
                            <br>
                            <p>FAQ</p>
                            <br>
                            <p><b>tel: </b> 01698 654345</p>
                            <br>
                            <p><b>e-mail: </b>info@vinylsonline.com</p>
                            <br>
                            <p>150A Main Street</p>
                            <p>Wishaw</p>
                            <p>ML2 7TU</p>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="socialMedia">
                <div>
                    <p class="followUs">Follow Us:</p>
                </div>
                <div class="icons">
                    <img src="images/facebookIcon.webp" alt="Facebook Icon">
                    <img src="images/instagramIcon.png" alt="Instagram Icon">

                    <img src="images/tiktokIcon.png" alt="TikTok Icon">

                    <img src="images/youtubeIcon.png" alt="YouTube Icon">
                </div>
            </div>
        </div>
    </footer>
</section>
<br>
<div class="copyright">All rights reserved. Created by Angelika Wysocka</div>

<script>
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
    });

    let logoutBtn = document.querySelectorAll(".logoutBtn");

    logoutBtn.forEach(function(btn) {
        btn.addEventListener("click", function() {
            window.location.href = "logout.php";
        })
    });

    let loginBtn = document.querySelectorAll(".loginButton");

    loginBtn.forEach(function(btn) {
        btn.addEventListener("click", function() {
            window.location.href = "login.php";
        })
    });

    let registerBtn = document.querySelectorAll(".registerBtn");

    registerBtn.forEach(function(btn) {
        btn.addEventListener("click", function() {
            window.location.href = "addUserForm.php";
        })
    });

    let sellUpdate = document.querySelectorAll(".sellUpdate");

    sellUpdate.forEach(function(btn) {
        btn.addEventListener("click", function() {
            let id = btn.getAttribute("data-id");
            window.location.href = "updateVinyl.php?id=" + id;
        })
    });

    let sellDelete = document.querySelectorAll(".sellDelete");

    sellDelete.forEach(function(btn) {
        btn.addEventListener("click", function () {
            let id = btn.getAttribute("data-id");
            window.location.href = "deleteVinyl.php?id=" + id;
        })
    });

    let logo = document.querySelector(".logo");
    logo.addEventListener("click", function() {
        window.location.href = "index.php";
    })
</script>