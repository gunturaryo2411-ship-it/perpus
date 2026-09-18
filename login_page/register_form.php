<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'Pengguna Sudah Tersedia';

   }else{

      if($pass != $cpass){
         $error[] = 'Password tidak sesuai';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <form action="" method="post" id="register-form">
            <h3>DAFTAR SEKARANG</h3>

            <?php 
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>

            <div class="isi-form">
                <input type="text" name="name" required placeholder="masukkan nama anda" class="form-input">
                <input type="email" name="email" required placeholder="masukkan email anda" class="form-input">
                <input type="password" name="password" required placeholder="masukkan password anda" class="form-input">
                <input type="password" name="cpassword" required placeholder="konfirmasi password anda" class="form-input">
                <select name="user_type">
                    <option value="admin">Admin</option>
                    <option value="user">Admin</option>
                </select>
                <input type="submit" name="submit" value="Daftar" class="form-btn">
                <p>Sudah memiliki akun?</p>
                <a href="login_form.php">login</a>
            </div>
        </form>
    </div>
</body>
</html>