<?php
session_start();
require "utils/function.php";

$username = getUsername();
$films = getAllFilm();

if (isset($_POST['login'])) {
  if (login($_POST) > 0) {
    if (isset($_SESSION['admin'])) {
      header('location: admin.php');
    } else {
      echo "<script>
            alert('Anda berhasil login');
        </script>";
      header("Location: anime.php");
    }
  } else {
    $_SESSION['login'] = '<script>
    Swal.fire({
        title: "Gagal!",
        text: "Anda Gagal Login!",
        icon: "error"
      });
      </script>';
    echo 'alert("Anda Gagal Login!"); ';
  }
}

if (isset($_POST['register'])) {
  if (register($_POST) > 0) {
    echo "<script>
      alert('Anda berhasil register');
      </script>";
    header("Location: anime.php");
  } else {
    $_SESSION['login'] = '<script>
    Swal.fire({
        title: "Gagal!",
        text: "Anda Gagal Login!",
        icon: "error"
      });
      </script>';
  }
}

if (isset($_POST['search'])) {
  echo $_POST['search'];
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
  <main>
    <div id="anime" class="container  p-5 rounded-md">
      <h2>Sedang Populer di NimeKu</h2>
     <div id="carouselExampleCaptions" class="carousel slide rounded-1 mb-5 overflow-hidden">
      <div class="carousel-indicators">
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/dandadan.webp" class="d-block w-100" alt="..">
         <div class="carousel-caption d-none d-md-block">
          <h5>Dandadan</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
        </div>
        <div class="carousel-item">
          <img src="img/kny.webp" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
          <h5>Kimetsu No Yaiba</h5>
          <p>Some representative placeholder content for the second slide.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/rc.webp" class="d-block w-100" alt="...">
           <div class="carousel-caption d-none d-md-block">
            <h5>Ragna Crimson</h5>
            <p>Some representative placeholder content for the third slide.</p>
           </div>
        </div>
     </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
      </button>
     </div>
      <div class="row">
        <?php if (isset($_POST['inputSearch'])): ?>
                  <h2 class="text-center mb-3">Hasil pencarian : <?= $_POST['inputSearch'] ?></h2>
        <?php else: ?>
                  <h2 class="text-center mb-3">Telusuri Animemu Disini!</h2>
        <?php endif; ?>
        <div class="col-md-12 d-flex justify-content-center">
          <form class="w-100 d-flex justify-content-center" action="" method="post">
            <input class=" px-3 py-2 mx-4 w-50" type="search" name="inputSearch" id="searchAnime"
              placeholder="Ketikkan anime favoritmu disini...">
            <button class="btn btn-outline-success" type="submit" name="search">Search</button>
          </form>
        </div>
      </div>
      <div class="container-anime border border-1 row my-5 rounded-4 shadow px-3 py-4">
        <?php if (count($films) > 0): ?>
                <?php foreach ($films as $film): ?>
                      <a href="detailAnime.php?id=<?= $film['id']; ?>" class="anime-sm col-lg-2 text-dark text-decoration-none">
                        <img class="mb-2 rounded" src="<?= $film['img'] ?>" alt="" />
                        <h5><?= $film['title'] ?></h5>
                        </a>
                <?php endforeach; ?>
        <?php else: ?>
                <h5 class="text-center">Tidak ada hasil untuk <?= $_POST['inputSearch']; ?></h5>
        <?php endif; ?>
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
  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
  }
  ?>
</body>
</html>