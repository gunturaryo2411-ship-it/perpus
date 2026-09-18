<?php
$conn = mysqli_connect("localhost", "root", "", "user_db");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mengambil keyword pencarian
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword != '') {
    $keyword_sql = mysqli_real_escape_string($conn, $keyword);

    $sql = "SELECT * FROM siswa
            WHERE first_name LIKE '%$keyword_sql%'
            OR last_name LIKE '%$keyword_sql%'
            OR email LIKE '%$keyword_sql%'
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM siswa ORDER BY id DESC";
}

// Menjalankan query
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Anggota</title>

    <link rel="stylesheet" href="../DASHBOARD/dashboardstyle.css">
    <link rel="stylesheet" href="daftar_siswa.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    >

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <header>
        <nav class="navbar">

            <h1>DATA PERPUSTAKAAN</h1>

            <ul>
                <li>
                    <a href="../LOGIN_PAGE/login_form.php">
                        LOGOUT
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        TAMBAH ANGGOTA
                    </a>
                </li>
            </ul>

        </nav>
    </header>


    <main>
        <section>

            <div class="container">

                <a href="dashboard.php" class="add-btn">
                    Tambah
                </a>


                <!-- ========================= -->
                <!-- SEARCH -->
                <!-- ========================= -->

                <div class="search-box">

                    <form method="get">

                        <input
                            type="text"
                            name="keyword"
                            placeholder="Cari nama..."
                            value="<?php echo htmlspecialchars($keyword); ?>"
                        >

                        <button type="submit">
                            Cari
                        </button>

                        <a href="daftar_siswa.php">
                            Reset
                        </a>

                    </form>

                </div>


                <!-- ========================= -->
                <!-- TABLE -->
                <!-- ========================= -->

                <table class="table">

                    <thead>

                        <tr>

                            <th scope="col">ID</th>
                            <th scope="col">Nama Awal</th>
                            <th scope="col">Nama Akhir</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Action</th>

                        </tr>

                    </thead>


                    <tbody>

                        <?php

                        // Variabel untuk menghitung jumlah data
                        $jumlahData = 0;

                        // Perulangan data dari database
                        while ($row = mysqli_fetch_assoc($result)) {

                            $jumlahData++;

                        ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($row['id']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['first_name']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['last_name']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['email']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row['gender']); ?>
                                </td>

                                <td>

                                    <a
                                        href="edit.php?id=<?php echo $row['id']; ?>"
                                        class="add-btn"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="delete.php?id=<?php echo $row['id']; ?>"
                                        class="add-btn delete-btn"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php
                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </section>
    </main>


    <!-- ================================================= -->
    <!-- JAVASCRIPT DEBUGGING -->
    <!-- ================================================= -->

    <script>

        console.log("=================================");
        console.log("DEBUGGING DAFTAR ANGGOTA");
        console.log("=================================");


        // ================================================
        // DEBUGGING SEARCH
        // ================================================

        const keyword = <?php echo json_encode($keyword); ?>;

        console.log("Keyword pencarian:", keyword);

        if (keyword !== "") {

            console.log(
                "Status: Pencarian sedang digunakan"
            );

        } else {

            console.log(
                "Status: Menampilkan seluruh data anggota"
            );

        }


        // ================================================
        // DEBUGGING JUMLAH DATA
        // ================================================

        const jumlahData =
            <?php echo $jumlahData; ?>;

        console.log(
            "Jumlah data yang ditampilkan:",
            jumlahData
        );


        // ================================================
        // DEBUGGING HASIL DATABASE
        // ================================================

        if (jumlahData > 0) {

            console.log(
                "Database berhasil menampilkan data."
            );

        } else {

            console.warn(
                "Tidak ada data anggota yang ditemukan."
            );

        }


        // ================================================
        // DEBUGGING DELETE + SWEETALERT
        // ================================================

        try {

            const deleteButtons =
                document.querySelectorAll('.delete-btn');

            console.log(
                "Jumlah tombol Delete:",
                deleteButtons.length
            );


            deleteButtons.forEach(function(button, index) {

                console.log(
                    "Tombol Delete ke-" + (index + 1) +
                    " berhasil ditemukan."
                );


                button.addEventListener(
                    'click',
                    function(event) {

                        event.preventDefault();

                        const deleteUrl =
                            this.href;

                        console.log(
                            "Delete diklik."
                        );

                        console.log(
                            "URL Delete:",
                            deleteUrl
                        );


                        Swal.fire({

                            title: 'Hapus data?',

                            text: 'Data anggota akan dihapus.',

                            icon: 'warning',

                            showCancelButton: true,

                            confirmButtonText: 'Ya, hapus',

                            cancelButtonText: 'Batal'

                        }).then((result) => {

                            console.log(
                                "Hasil konfirmasi:",
                                result.isConfirmed
                            );


                            if (result.isConfirmed) {

                                console.log(
                                    "Data akan dihapus."
                                );

                                window.location.href =
                                    deleteUrl;

                            } else {

                                console.log(
                                    "Penghapusan dibatalkan."
                                );

                            }

                        });

                    }
                );

            });

            console.log(
                "SweetAlert2 berhasil dipasang."
            );

        } catch (error) {

            console.error(
                "Terjadi error:",
                error
            );

        }


        console.log("=================================");
        console.log("DEBUGGING SELESAI");
        console.log("=================================");

    </script>

</body>
</html>