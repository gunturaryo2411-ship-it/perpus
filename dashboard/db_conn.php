<?php 
 $servername = 'localhost';
 $username = 'root';
 $password = '';
 $dbname ='user_db';

 $conn = mysqli_connect('localhost','root','','user_db');

 if(!$conn){
    die("Koneksi Gagal".mysqli_connect_error());

    
 }
 //echo 'Koneksi Berhasil';
