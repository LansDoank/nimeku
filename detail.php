<?php
session_start();
require "./utils/function.php";

$username = getUsername();
$id = $_GET['idfilm'];
$result = mysqli_query($conn,"SELECT * FROM anime WHERE id = '$id'");
$film = mysqli_fetch_assoc($result);

if(isset($_POST['updateFilm'])) {
  if(updateFilm($_POST) > 0) {
    header("location: admin.php");
  } else {

  }
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
          <?php if (isset($username)): ?>
            <h5 class="text-white"><?= $username ?></h5>
            <a href="logout.php" class="ms-4 btn btn-danger">Logout</a>
          <?php else: ?>
            <button id="login" type="button" class="btn btn-success text-white hover:bg-primary mx-2"
              data-bs-toggle="modal" data-bs-target="#exampleModal">
              Login
            </button>
            <button id="register" type="button" class="btn btn-warning text-dark mx-2" data-bs-toggle="modal"
              data-bs-target="#exampleModal">
              Register
            </button>
          <?php endif; ?>
        </div>
      </div>
    </nav>
  </header>
  <main id="detail-film">
    <h1 class="text-center mb-4">Detail Film</h1>
    <div class="container edit-container d-flex shadow rounded p-4 ">
      <div class="detail-img w-25 d-flex align-items-center">
        <img class="img-fluid" src="<?= $film['img'] ?>" alt="">
      </div>
      <form action="" method="post" class="detail-form p-5 w-75 h-auto overflow-auto" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $film['id'] ?>">
        <input type="hidden" name="img" value="<?= $film['img'] ?>">
        <label class="fw-medium" for="img">Gambar :</label>
        <br>
        <input class="mt-2 mb-3 w-100 px-3 py-2" type="file" id="img" name="img" value="<?= $film['img'] ?>" >
        <label class="fw-medium" for="title">Judul :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="text" id="title" name="title" value="<?= $film['title'] ?>">
        <br>
        <label class="fw-medium" for="rating">Rating :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="number" id="rating" name="rating" value="<?= $film['rating'] ?>">
        <label class="fw-medium" for="produser">Produser :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="text" id="produser" name="produser" value="<?= $film['produser'] ?>">
        <label class="fw-medium" for="episode">Episode :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="number" id="episode" name="episode" value="<?= $film['episode'] ?>">
        <label class="fw-medium" for="tanggal">Tanggal :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="date" id="tanggal" name="tanggal" value="<?= $film['tanggal'] ?>">
        <label class="fw-medium" for="studio">Studio :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="text" id="studio" name="studio" value="<?= $film['studio'] ?>">
        <label class="fw-medium" for="genre">Genre :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="text" id="genre" name="genre" value="<?= $film['genre'] ?>">
        <label class="fw-medium" for="src">Source Anime :</label>
        <br>
        <input class="mt-2 mb-4 w-100 px-3 py-2" type="text" id="src" name="src" value="<?= $film['src'] ?>">
        <button type="submit" name="updateFilm" class="btn btn-warning">Selesai</button>
        <a href="admin.php" class="btn btn-danger">Cancel</a>
      </form>
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
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="script.js"></script>
</body>
</html>