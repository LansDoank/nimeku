<?php
session_start();
session_destroy();
session_unset();
echo "<script>
alert('Anda Berhasil Logout');
</script>";
header("location: anime.php");