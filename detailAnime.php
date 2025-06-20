<?php 
    session_start();
    require "./utils/function.php";

    $username = getUsername();

    $id = $_GET['id'];
    $anime = mysqli_query($conn,"SELECT * FROM anime WHERE id='$id'");
    $anime = mysqli_fetch_assoc($anime);
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
  <main class="detail-container shadow rounded-2">
    <div class="detail-heading bg-primary w-100 p-2 rounded-top-2   text-white fw-medium">
        <?= $anime['title'] ?> Episode 1
    </div>
    <video class="detail-video bg-danger w-100" autoplay controls>
        <source src="<?= $anime['src']; ?>" >
    </video>
    <div class="detail-desc d-flex p-3">
        <img class="" src="<?= $anime['img']; ?>" alt="">
        <div class="">
            <ul>
                <li class="my-2">Judul : <?= $anime['title']; ?></li>
                <li class="my-2">Rating : <?= $anime['rating']; ?></li>
                <li class="my-2">Produser : <?= $anime['produser']; ?></li>
                <li class="my-2">Total Episode : <?= $anime['episode']; ?></li>
                <li class="my-2">Tanggal Rilis : <?= $anime['tanggal']; ?></li>
                <li class="my-2">Studio : <?= $anime['studio']; ?></li>
                <li class="my-2">Genre : <?= $anime['genre']; ?></li>

            </ul>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="modal-form col-12 rounded-3 p-5" action="" method="POST">
            <h1 class="text-center">Login</h1>
            <ul class="p-0">
              <li class="mb-4">
                <label for="email">Email :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="email" id="email" name="email">
              </li>
              <li>
                <label for="password">Password :</label>
                <br>
                <input class="w-100 mt-2 px-2 py-2" type="password" id="password " name="password">
              </li>
              <li class="my-3 d-flex justify-content-center w-100">
                <button class=" btn btn-primary w-100" type="submit" name="login">Login</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if (isset($_SESSION['login'])) {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
  }
  ?>
</body>
</html>