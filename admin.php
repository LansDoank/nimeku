<?php
session_start();
require "utils/function.php";

if (!isset($_SESSION['admin'])) {
  header('location: anime.php');
}

$username = getUsername();

$films = getAllFilm();

if (isset($_POST['addFilm'])) { 
  if (tambahFilm($_POST) > 0) {
    echo "<script>
            alert('Masukkan Data Baru berhasil!');
          </script>";
    header("location: film.php");
  }
}

if (isset($_POST['search'])) {
  $films = searchFilm($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NimeKu</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <div class="container-fluid px-5">
        <a class="navbar-brand fw-medium me-5" href="#">NimeKu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item mx-3">
              <a class="nav-link active" aria-current="page" href="#">Beranda</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="./#trending">Trending</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="./#pertanyaan">FAQ</a>
            </li>
          </ul>
          <h5 class="text-white"><?= $username ?></h5>
          <a href="logout.php" class="ms-4 btn btn-danger">Logout</a>
        </div>
      </div>
    </nav>
  </header>
  <main>
    <div id="admin-main" class="container ">
      <div class="row mb-5">
        <button class="btn btn-success py-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data Anime</button>
      </div>
      <div class="row border border-1 rounded-3 mt-5 shadow p-5 d-flex flex-wrap justify-content-center">
        <h2 class="text-center mb-4">Data Anime</h2>
        <div class="col-md-12 d-flex justify-content-center mb-5">
          <form class="w-100 d-flex justify-content-center" action="" method="post">
            <input class="px-3 py-2 mx-4 w-50" type="search" name="inputSearch" id="searchAnime"
              placeholder="Ketikkan anime favoritmu disini...">
            <button class="btn btn-outline-primary " type="submit" name="search">Search</button>
          </form>
        </div>
        <?php foreach ($films as $film): ?>
                <div class="data-film border border-1 m-2 col-md-6 d-flex  align-items-center bg-white shadow rounded p-3">
                  <div class="d-flex align-items-center w-50">
                    <img src="<?= $film['img'] ?>">
                    <h5 class="mx-3"><?= $film['title'] ?></h5>
                  </div>
                  <div class="d-flex align-items-center w-50 justify-content-end">
                    <a href="detail.php?idfilm=<?= $film['id']; ?>" class="btn btn-warning ms-3 px-4" >Edit</a>
                    <a onclick='return confirm("Yakin?");' href="deletefilm.php?idfilm=<?= $film['id']; ?>" class="btn btn-danger ms-3 px-3">Hapus</a>
                  </div>
                </div>
        <?php endforeach; ?>
      </div>
    </div>
  </main>
  <footer class="container-fluid bg-primary pt-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 d-flex align-items-center">
          <a href="" class="footer-brand text-decoration-none text-white fw-medium">NimeKu</a>
        </div>
        <div class="col-md-4">
          <ul class="text-white fw-medium list-unstyled ">
            Navbar
            <li class="my-2"><a class="text-white fw-normal text-decoration-none" href="#">Beranda</a></li>
            <li class="my-2"><a class="text-white fw-normal text-decoration-none" href="./#trending">Trending</a></li>
            <li class="my-2"><a class="text-white fw-normal text-decoration-none" href="./#pertanyaan">FAQ</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="text-white fw-medium list-unstyled ">
            Medsos
            <li class="my-2"><a class="text-white fw-normal text-decoration-none" href="#">Instagram</a></li>
            <li class="my-2"><a class="text-white fw-normal text-decoration-none" href="#">Tiktok</a></li>
            <li class="my-2"><a class="text-white fw-normal text-decoration-none" href="#">Facebook</a></li>
          </ul>
        </div>
      </div>
    </div>
    <hr>
    <div class="row p-1 ">
      <div class="col-12 d-flex justify-content-center text-white">
        <p>Copyright By Nimeku Allright Reserved.</p>
      </div>
    </div>
  </footer>
  <script src="script.js"></script>
  <script src="js/jquery.min.js"></script>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Film</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <form class="modal-form col-12 rounded-3 p-5" action="" method="POST" enctype="multipart/form-data">
            <h1 class="text-center">Tambah Film</h1>
            <ul class="p-0">
              <li>
                <label for="film">Gambar :</label>
                <input class="w-100 mt-2 px-2 py-2" type="file" id="film " name="film">
              </li>
              <li class="mb-4">
                <label for="judul">Judul :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="text" id="judul" name="judul">
              </li>
              <li class="mb-4">
                <label for="rating">Rating :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="number" id="rating" name="rating">
              </li>
              <li class="mb-4">
                <label for="produser">Produser :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="text" id="produser" name="produser">
              </li>
              <li class="mb-4">
                <label for="episode">Total Episode :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="text" id="episode" name="episode">
              </li>
              <li class="mb-4">
                <label for="tanggal">Tanggal Rilis :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="date" id="tanggal" name="tanggal">
              </li>
              <li class="mb-4">
                <label for="studio">Studio :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="text" id="studio" name="studio">
              </li>
              <li class="mb-4">
                <label for="genre">Genre :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="text" id="genre" name="genre">
              </li>
              <li class="mb-4">
                <label for="src">Source Video :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="text" id="src" name="src">
              </li>
              <li class="my-3 d-flex justify-content-center w-100">
                <button class=" btn btn-primary w-100" type="submit" name="addFilm">Tambah Film</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
  }
  ?>
</body>
</html>