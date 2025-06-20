<?php 
require "./utils/function.php";

$idFilm = $_GET['idfilm'];
$deletedFilm = mysqli_query($conn,"DELETE FROM anime WHERE id='$idFilm'");
header("location: admin.php");
