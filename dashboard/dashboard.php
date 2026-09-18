<?php 
$conn = mysqli_connect("localhost", "root", "", "user_db");

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$error = "";

if (isset($_POST['submit'])) {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $gender     = isset($_POST['gender']) ? $_POST['gender'] : "";

    // Validasi form
    if ($first_name == "") {
        $error = "Nama awal wajib diisi!";
    } elseif ($last_name == "") {
        $error = "Nama akhir wajib diisi!";
    } elseif ($email == "") {
        $error = "Email wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } elseif ($gender == "") {
        $error = "Jenis kelamin wajib dipilih!";
    } elseif (!in_array($gender, ['male', 'female'], true)) {
        $error = "Jenis kelamin tidak valid!";
    }

    // Jika tidak ada error, simpan data
    if ($error == "") {
        $sql = "INSERT INTO siswa (first_name, last_name, email, gender) 
                VALUES ('$first_name','$last_name','$email','$gender')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: daftar_siswa.php?msg=Data berhasil dibuat");
            exit;
        } else {
            $error = "Data gagal dibuat: " . mysqli_error($conn);
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* Notifikasi error berwarna merah */
        .error-message {
            color: #dc2626;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar">
            <h1>DATA PERPUSTAKAAN</h1>

            <ul>
                <li>
                    <a href="../LOGIN_PAGE/login_form.php">LOGOUT</a>
                </li>

                <li>
                    <a href="daftar_siswa.php">DAFTAR ANGGOTA</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <section>

            <div class="container">
                <h3>Tambah Anggota Baru</h3>
                <p>Lengkapi data dibawah untuk menambahkan anggota baru</p>
            </div>

            <div class="container-form">

                <!-- Notifikasi error -->
                <?php if ($error != ""): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form 
                    name="formUser" 
                    action="" 
                    method="post" 
                    class="form-user" 
                    onsubmit="return validateForm()"
                >

                    <div class="row-first">

                        <div class="col-1">
                            <label class="form-label">Nama Awal :</label>

                            <input 
                                type="text" 
                                class="form-input" 
                                name="first_name"
                                placeholder="Nama Awal"
                                value="<?= htmlspecialchars($first_name ?? ''); ?>"
                            >
                        </div>

                        <div class="col-2">
                            <label class="form-label">Nama Akhir :</label>

                            <input 
                                type="text" 
                                class="form-input" 
                                name="last_name"
                                placeholder="Nama Akhir"
                                value="<?= htmlspecialchars($last_name ?? ''); ?>"
                            >
                        </div>

                    </div>

                    <div class="row-second">

                        <label class="form-label">Email :</label>

                        <input 
                            type="email" 
                            class="form-input" 
                            name="email"
                            placeholder="Masukkan Email"
                            value="<?= htmlspecialchars($email ?? ''); ?>"
                        >

                    </div>

                    <div class="row-radio">

                        <label>Jenis Kelamin :</label>

                        <input 
                            type="radio" 
                            class="input-radio" 
                            name="gender" 
                            id="male" 
                            value="male"
                        >

                        <label for="male" class="radio-label">
                            Laki - laki
                        </label>

                        <input 
                            type="radio" 
                            class="input-radio" 
                            name="gender" 
                            id="female" 
                            value="female"
                        >

                        <label for="female" class="radio-label">
                            Perempuan
                        </label>

                    </div>

                    <div>
                        <button 
                            type="submit" 
                            name="submit" 
                            class="submit-btn"
                        >
                            Save
                        </button>

                        <a 
                            href="daftar_siswa.php" 
                            class="cancel-btn"
                        >
                            Cancel
                        </a>
                    </div>

                </form>

            </div>

        </section>
    </main>


    <!-- ================= JAVASCRIPT ================= -->
    <script>

        // ==========================================
        // ARRAY OF OBJECTS
        // ==========================================

        let dataAnggota = [
            {
                firstName: "Guntur",
                lastName: "Aryo",
                email: "guntur@gmail.com",
                gender: "male"
            },
            {
                firstName: "Budi",
                lastName: "Santoso",
                email: "budi@gmail.com",
                gender: "male"
            }
        ];

        console.log("=== PROGRAM DIMULAI ===");
        console.log("Data awal Array of Objects:", dataAnggota);


        // ==========================================
        // FUNCTION FILTER
        // ==========================================

        /**
         * Memfilter data anggota berdasarkan nama depan.
         *
         * @param {string} keyword - Kata kunci pencarian.
         * @returns {Array} Data anggota yang sesuai.
         */
        function filterAnggota(keyword) {

            console.log("Keyword pencarian:", keyword);

            const hasilFilter = dataAnggota.filter(function(anggota) {

                return anggota.firstName
                    .toLowerCase()
                    .includes(keyword.toLowerCase());

            });

            console.log("Hasil filter:", hasilFilter);

            return hasilFilter;
        }


        // ==========================================
        // FUNCTION VALIDASI FORM
        // ==========================================

        /**
         * Melakukan validasi terhadap form anggota.
         *
         * @returns {boolean} true jika form valid,
         * false jika terdapat kesalahan.
         */
        function validateForm() {

            console.log("================================");
            console.log("PROSES VALIDASI FORM DIMULAI");
            console.log("================================");

            const firstName = document.forms["formUser"]["first_name"].value.trim();
            const lastName = document.forms["formUser"]["last_name"].value.trim();
            const email = document.forms["formUser"]["email"].value.trim();

            const genderElement = document.querySelector(
                'input[name="gender"]:checked'
            );

            const gender = genderElement ? genderElement.value : "";

            // Menampilkan data form ke Console
            console.log("Nama awal :", firstName);
            console.log("Nama akhir:", lastName);
            console.log("Email     :", email);
            console.log("Gender    :", gender);


            // ==========================================
            // VALIDASI NAMA AWAL
            // ==========================================

            if (firstName === "") {

                console.error("ERROR: Nama awal kosong!");

                alert("Nama awal wajib diisi!");

                return false;
            }


            // ==========================================
            // VALIDASI NAMA AKHIR
            // ==========================================

            if (lastName === "") {

                console.error("ERROR: Nama akhir kosong!");

                alert("Nama akhir wajib diisi!");

                return false;
            }


            // ==========================================
            // VALIDASI EMAIL
            // ==========================================

            if (email === "") {

                console.error("ERROR: Email kosong!");

                alert("Email wajib diisi!");

                return false;
            }


            // ==========================================
            // VALIDASI GENDER
            // ==========================================

            if (gender === "") {

                console.error("ERROR: Gender belum dipilih!");

                alert("Jenis kelamin wajib dipilih!");

                return false;
            }


            // ==========================================
            // MEMBUAT OBJECT ANGGOTA BARU
            // ==========================================

            const anggotaBaru = {
                firstName: firstName,
                lastName: lastName,
                email: email,
                gender: gender
            };

            console.log("Object anggota baru:", anggotaBaru);


            // ==========================================
            // PUSH OBJECT KE ARRAY
            // ==========================================

            dataAnggota.push(anggotaBaru);

            console.log("Data berhasil ditambahkan menggunakan push()");
            console.log("Array setelah push:", dataAnggota);


            // ==========================================
            // FOREACH
            // ==========================================

            console.log("=== DAFTAR DATA ANGGOTA ===");

            dataAnggota.forEach(function(anggota, index) {

                console.log(
                    (index + 1) + ". " +
                    anggota.firstName + " " +
                    anggota.lastName +
                    " | " + anggota.email +
                    " | " + anggota.gender
                );

            });


            // ==========================================
            // FILTER
            // ==========================================

            console.log("=== CONTOH FILTER ===");

            const hasilPencarian = filterAnggota(firstName);

            console.log(
                "Hasil pencarian berdasarkan nama:",
                hasilPencarian
            );


            // ==========================================
            // VALIDASI BERHASIL
            // ==========================================

            console.log("================================");
            console.log("VALIDASI BERHASIL!");
            console.log("Data siap dikirim ke server.");
            console.log("================================");

            return true;
        }

    </script>

</body>
</html>