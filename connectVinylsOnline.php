<?php

$conn = mysqli_connect("localhost", "root", "", "vinylsonline");

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>