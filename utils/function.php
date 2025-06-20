<?php

$conn = mysqli_connect("localhost", "root", "", "nimeku");


function getAllFilm()
{
    global $conn;
    $films = mysqli_query($conn, "SELECT * FROM anime");
    $rows = [];
    while ($row = mysqli_fetch_array($films)) {
        $rows[] = $row;
    }
    return $rows;
}

function searchFilm($data)
{
    global $conn;
    $input = $data['inputSearch'];

    $films = mysqli_query($conn, "SELECT * FROM anime WHERE title LIKE '%$input%'");
    $rows = [];
    while ($row = mysqli_fetch_array($films)) {
        $rows[] = $row;
    }
    return $rows;
}
function login($data)
{
    $email = $data["email"];
    $password = $data["password"];
    global $conn;

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' ");

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['identifier'] = $email;
            $_SESSION['login'] = '<script>
            Swal.fire({
                title: "Berhasil!",
                text: "Anda Berhasil Login!",
                icon: "success"
              });
              </script>';
            if ($_SESSION['identifier'] == 'admin123@gmail.com') {
                $_SESSION['admin'] = true;
            }
            return mysqli_affected_rows($conn);
        }
    }
    return false;
}

function register($data)
{
    global $conn;

    $username = $data['username'];
    $email = $data['email'];
    $password = $data['password'];

    $duplicate = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
    if (mysqli_num_rows($duplicate)) {
        echo "<script>
        alert('Email sudah digunakan!');
    </script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO user VALUES ('', '$username', '$email', '$password')";
    mysqli_query($conn, $query);
    $_SESSION['login'] = true;
    $_SESSION['identifier'] = $email;
    if ($_SESSION['identifier'] == 'admin123@gmail.com') {
        $_SESSION['admin'] = true;
    }
    return mysqli_affected_rows($conn);
}

function tambahFilm($data)
{
    $judul = $data['judul'];
    $rating = $data['rating'];
    $produser = $data['produser'];
    $episode = $data['episode'];
    $tanggal = $data['tanggal'];
    $studio = $data['studio'];
    $genre = $data['genre'];
    $src = $data['src'];

    $nameGambar = $_FILES['film']['name'];
    $tmpGambar = $_FILES['film']['tmp_name'];
    $errGambar = $_FILES['film']['error'];


    $eksGambarValid = ['jpg', 'jpeg', 'png']; // test.jpg = ['test','jpg']
    $eksGambar = explode('.', $nameGambar);
    $eksGambar = strtolower(end($eksGambar));

    if ($errGambar == 4) {
        echo "<script>
        alert('Gambar tidak boleh kosong');
    </script>";
        return false;
    }

    if (!in_array($eksGambar, $eksGambarValid)) {
        echo "<script>
        alert('Masukkan Gambar');
    </script>";
        return false;
    }

    move_uploaded_file($tmpGambar, 'img/' . $nameGambar);

    global $conn;

    $lokasiGambar = "img/$nameGambar";

    mysqli_query($conn, "INSERT INTO anime VALUES('','$lokasiGambar','$judul','$rating','$produser','$episode','$tanggal','$studio','$genre','$src')");
    return mysqli_affected_rows($conn);
}

function updateFilm($data)
{
    $id = $data['id'];
    $imgLama = $data['img'];
    $title = $data['title'];
    $rating = $data['rating'];
    $produser = $data['produser'];
    $episode = $data['episode'];
    $tanggal = $data['tanggal'];
    $studio = $data['studio'];
    $genre = $data['genre'];
    $src = $data['src'];

    $nameGambar = $_FILES['img']['name'];
    $tmpGambar = $_FILES['img']['tmp_name'];
    $errGambar = $_FILES['img']['error'];

    $lokasiGambar = $imgLama;


    if (!$errGambar == 4) {
        echo 'ada';

        $eksGambarValid = ['jpg', 'jpeg', 'png'];
        $eksGambar = explode('.', $nameGambar);
        $eksGambar = strtolower(end($eksGambar));


        if (!in_array($eksGambar, $eksGambarValid)) {
            echo "<script>
            alert('Masukkan Gambar sesuai ekstensi yang tersedia');
        </script>";
            return false;
        }

        move_uploaded_file($tmpGambar, 'img/' . $nameGambar);


        $lokasiGambar = "img/$nameGambar";
    }
    
    global $conn;

    mysqli_query($conn, "UPDATE anime SET img='$lokasiGambar',title='$title',rating='$rating',produser='$produser',episode='$episode',tanggal='$tanggal',studio='$studio',genre='$genre',src='$src' WHERE id='$id'");
    return mysqli_affected_rows($conn);
}

function getUsername()
{
    global $conn;
    if (isset($_SESSION['identifier'])) {
        $email = $_SESSION['identifier'];
        $username = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
        $username = mysqli_fetch_assoc($username);
        return $username['username'];
    } else {
        return null;
    }
}

// function setFlashMessage($key, $message)
// {
//     $_SESSION['flash'][$key] = $message;
// }

// function getFlashMessage($key)
// {
//     if (isset($_SESSION['flash'][$key])) {
//         $message = $_SESSION['flash'][$key];
//         unset($_SESSION['flash'][$key]);
//         return $message;
//     }
//     return null;
// }