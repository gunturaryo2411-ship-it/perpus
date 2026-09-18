<?php 
    @include 'db_conn.php';
    $id = $_GET['id'];
    if(isset($_POST['submit'])){
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];

        $sql = "UPDATE `siswa` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`gender`='$gender' WHERE id=$id";
        
        $result = mysqli_query($conn,$sql);

        if($result){
            header("location: daftar_siswa.php?msg= Data berhasil update");
        }
        else{
            echo 'Data gagal dibuat'.mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../DASHBOARD/dashboardstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   
</head>
<body>
    <header>
        <nav class="navbar">
            <h1>DATA PERPUSTAKAAN</h1>
            <ul>
                <li><a href="">DAFTAR BUKU</a></li>
                <li><a href="">DAFTAR SISWA</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <div class="container">
                <h3>Edit Anggota</h3>
                <p>Klik update setelah melakukan perubahan</p>
            </div>
            <?php
                $sql = "SELECT * FROM siswa WHERE id = $id LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);


            ?>


            <div class="container-form">
                <form action="" method="post" class="form-user">
                    <div class="row-first">
                        <div class="col-1">
                            <label class="form-label" for="">Nama Awal :</label>
                            <input type="text" class="form-input" name="first_name" value="<?php echo $row['first_name'] ?>">
                        </div>
                        <div class="col-2">
                            <label class="form-label" for="">Nama Akhir :</label>
                            <input type="text" class="form-input" name="last_name" value="<?php echo $row['last_name'] ?>">
                        </div>
                    </div>
                    <div class="row-second">
                        <label class="form-label" for="">Email :</label>
                        <input type="email" class="form-input" name="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <div class="row-radio">
                        <label>Jenis Kelamin :</label>
                        <input type="radio" class="input-radio" name="gender" id="male" value="male" <?php echo ($row['gender']=='male')?"checked":""; ?>>
                        <label for="male" class="radio-label">Laki - laki</label>
                        <input type="radio" class="input-radio" name="gender" id="female" value="female" <?php echo ($row['gender']=='female')?"checked":""; ?>>
                        <label for="female" class="radio-label">Perempuan</label>
                    </div>
                    <div>
                        <button type="submit" name="submit" class="submit-btn">Update</button>
                        <a href="daftar_siswa.php" class="cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>