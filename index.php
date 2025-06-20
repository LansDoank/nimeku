<?php
session_start();
require "utils/function.php";

$username = getUsername();

if (isset($_POST['login'])) {
  if (login($_POST) > 0) {
    if (isset($_SESSION['admin'])) {
      header('location: admin.php');
    } else {
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
  }
}

if (isset($_POST['register'])) {
  if (register($_POST) > 0) {
    echo "<script>
    alert('Anda berhasil register');
    </script>";
    header("Location: anime.php");
  } else {
    "<script>
  alert('Anda gagal register');
</script>";
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
  <main>
    <div id="hero" class="container-fluid">
      <img src="img/bg1.jpg" alt="anime" />
      <div class="col-lg-12">
        <div id="jumbo" class="col-lg-8 offset-lg-2 d-flex flex-column align-items-center py-5 justify-content-center">
        <div class="jumbo-text">
        </div>  
          <p class="text-center text-white">
            Siap menonton? Mari kita mulai menonton anime.
          </p>
          <form action="anime.php" method="POST" class="my-4 d-flex flex-column align-items-center">
            <input class="px-3 py-3 rounded" style="height: 50px; width:450px;" type="search" name="inputSearch" id="search" placeholder="Cari anime kesukaanmu!">
            <br>
            <button type="submit" class="btn btn-primary py-2 px-5 fw-medium" name="search">
              Mulai
            </button>
          </form>
        </div>
      </div>
    </div>
    <div id="trending" class="container py-5">
      <div class="col-lg-12 mb-4">
        <h1>Trending</h1>
      </div>
      <div class="row">
        <a href="detailAnime.php?id=13" class="anime text-dark text-decoration-none col-lg-3">
          <img class="mb-2 rounded" src="img/naruto.jpg" alt="" />
          <h5>Naruto</h5>
        </a>
        <a href="detailAnime.php?id=4" class="anime text-dark text-decoration-none col-lg-3">
          <img class="mb-2 rounded" src="img/bc.jpg" alt="" />
          <h5>Black Clover</h5>
        </a>
        <a href="detailAnime.php?id=11" class="anime text-dark text-decoration-none col-lg-3">
          <img class="mb-2 rounded" src="img/jjk.jpg" alt="" />
          <h5>Jujutsu Kaisen</h5>
        </a>
        <a href="detailAnime.php?id=8" class="anime text-dark text-decoration-none col-lg-3">
          <img class="mb-2 rounded" src="img/kny.jpg" alt="" />
          <h5>Kimetsu No Yaiba</h5>
        </a>
      </div>
    </div>
    <div id="card" class="container py-5">
      <div class="col-lg-12 mb-4">
        <h3>Alasan Nonton Di NimeKu</h5>
      </div>
      <div class="row row-cols-4 justify-content-around">
        <div class="card col-lg-3 d-flex justify-content-center align-items-center py-4" style="width: 17rem">
          <img style="width: 100px" src="img/tv.svg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title text-center">Nikmati di HP mu</h5>
            <p class="card-text text-center">Tonton anime dengan hanya mengunjungi website resmi NimeKu</p>
          </div>
        </div>
        <div class="card col-lg-3 d-flex justify-content-center align-items-center py-4" style="width: 17rem">
          <img style="width: 100px" src="img/download.svg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title text-center">
              Download anime untuk menontonnya secara offline
            </h5>
            <p class="card-text text-center">
              Simpan anime favoritmu dengan mudah agar selalu ada film
              yang bisa ditonton.
            </p>
          </div>
        </div>
        <div class="card col-lg-3 d-flex justify-content-center align-items-center py-4" style="width: 17rem">
          <img style="width: 100px" src="img/geo-alt-fill.svg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title text-center">Tonton di mana pun</h5>
            <p class="card-text text-center">
              Streaming anime tak terbatas di ponsel, tablet,
              laptop, dan PC-mu.
            </p>
          </div>
        </div>
        <div class="card col-lg-3 d-flex justify-content-center align-items-center py-4" style="width: 17rem">
          <img style="width: 100px" src="img/person-circle.svg" class="card-img-top" alt="..." />
          <div class="card-body">
            <h5 class="card-title text-center">Buat profil untuk anda</h5>
            <p class="card-text text-center">
              Streaming film dan acara TV tak terbatas di ponsel, tablet,
              laptop, dan PC-mu.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div id="pertanyaan" class="container py-5">
      <div class="col-lg-12 mb-4">
        <h3>Tanya Jawab (FAQ)</h5>
      </div>
      <div class="col-lg-12">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Apa itu NimeKu
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Website nonton anime adalah platform online yang menyediakan
                layanan streaming atau download berbagai
                anime.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Dimana saya bisa menonton?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Tonton di mana pun, kapan pun. Masuk ke akunmu untuk
                menonton langsung di nimeku.com dari komputer pribadi atau di
                perangkat yang terhubung ke Internet dan mendukung website
                Nimeku, termasuk smart TV, smartphone, tablet, pemutar media
                streaming, dan konsol game. Kamu juga bisa men-download acara
                favoritmu dengan aplikasi iOS atau Android. Gunakan download
                untuk menonton saat kamu di perjalanan dan tidak punya koneksi
                Internet. Bawa NimeKu ke mana saja.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Apa saja yang bisa ditonton di NimeKu
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Di website NimeKu, Anda dapat menemukan berbagai jenis
                konten, termasuk serial anime dengan episode yang sedang
                tayang atau yang sudah selesai, film anime yang dirilis di
                bioskop atau TV, serta OVA (Original Video Animation) dan ONA
                (Original Net Animation) yang menambah pengalaman menonton.
                Selain itu, situs ini menawarkan genre beragam seperti aksi,
                romance, drama, komedi, dan fantasi, serta anime yang
                ditargetkan untuk berbagai kelompok usia seperti shonen,
                shojo, seinen, dan josei. Dengan berbagai pilihan ini,
                penggemar anime bisa menikmati konten yang sesuai dengan
                selera dan preferensi mereka.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Apakah NimeKu menyediakan anime dalam resolusi HD?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                 Ya, NimeKu menyediakan anime dalam berbagai resolusi, mulai dari 360p hingga HD 1080p. Bagi pengguna berlangganan, kamu bisa menikmati anime dalam resolusi HD tanpa iklan. Pastikan koneksi internetmu stabil untuk pengalaman menonton terbaik.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed fw-medium" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Apakah ada subtitle bahasa Indonesia?
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Untuk sekarang nimeku hanya tersedia untuk bahasa Indonesia,tapi untuk subtitle yang lain akan segera dibuatkan oleh mimin NimeKu.
              <!-- NimeKu menawarkan pilihan subtitle dalam beberapa bahasa, termasuk bahasa Indonesia. Ketika kamu memutar anime, kamu bisa memilih bahasa subtitle yang diinginkan melalui pengaturan video. Kami terus menambahkan subtitle untuk anime-anime baru. -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="container-fluid bg-primary pt-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 d-flex align-items-center">
          <a href="#" class="footer-brand text-decoration-none text-white fw-medium">NimeKu</a>
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
  <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
  <script>
    var typed = new Typed('.jumbo-text', {
    strings: [`<h1 class="text-center text-white">
              Anime,Movie tak 
              terbatas dan, banyak 
              lagi.
            </h1>`],
    typeSpeed: 50,
  });
  </script>
  <?php
  if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    // unset($_SESSION['login']);
  }
  ?>
</body>
</html>