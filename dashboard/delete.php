<?php
$conn = mysqli_connect("localhost", "root", "", "user_db");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

    $id = $_GET["id"];
    $sql = "DELETE FROM `siswa` WHERE id = $id";
    $result = mysqli_query($conn, $sql);

      if ($result) {
         header("Location: daftar_siswa.php?msg=Data deleted successfully");
      } else {
        echo "Failed: " . mysqli_error($conn);
        }