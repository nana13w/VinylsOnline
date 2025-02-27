<?php require_once "connectVinylsOnline.php";

if(isset($_POST["search"])) {

    $searching= mysqli_real_escape_string($conn, $_POST["searching"]);

    $query="SELECT artist, album, genre FROM products WHERE artist LIKE '%$searching%' OR album LIKE '%$searching%' OR genre LIKE '%$searching%'";

$result = mysqli_query($conn, $query);

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sss", $searching_param, $searching_param, $searching_param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) >0) {
    while ($row = mysqli_fetch_array($result)) {
        $artist=$row["artist"];
        $album=$row["album"];
        $genre=$row["genre"];

        echo $artist. " - " . $album. "<br/>";
    }

} else echo "No records matching your query were found.";
}
?>