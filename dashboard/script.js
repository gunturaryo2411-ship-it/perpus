// Array of Objects untuk menyimpan data anggota
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
/**
 * Memfilter data anggota berdasarkan nama depan.
 *
 * @param {string} keyword - Kata kunci pencarian.
 * @returns {Array} Data anggota yang sesuai.
 */
function filterAnggota(keyword) {
    return dataAnggota.filter(function(anggota) {
        return anggota.firstName
            .toLowerCase()
            .includes(keyword.toLowerCase());
    });
}
/**
 * Melakukan validasi terhadap form anggota.
 *
 * @returns {boolean} true jika form valid,
 *                    false jika terdapat kesalahan.
 */
function validateForm() {
    const firstName = document.forms["formUser"]["first_name"].value.trim();
    const lastName = document.forms["formUser"]["last_name"].value.trim();
    const email = document.forms["formUser"]["email"].value.trim();
    const gender = document.forms["formUser"]["gender"].value;

    // Validasi nama awal
    if (firstName === "") {
        alert("Nama awal wajib diisi!");
        return false;
    }

    // Validasi nama akhir
    if (lastName === "") {
        alert("Nama akhir wajib diisi!");
        return false;
    }

    // Validasi email
    if (email === "") {
        alert("Email wajib diisi!");
        return false;
    }

    // Validasi gender
    if (gender === "") {
        alert("Jenis kelamin wajib dipilih!");
        return false;
    }

    // Membuat object anggota baru
    const anggotaBaru = {
        firstName: firstName,
        lastName: lastName,
        email: email,
        gender: gender
    };

    // Menambahkan object baru ke dalam Array
    dataAnggota.push(anggotaBaru);

    // Menampilkan seluruh data menggunakan forEach
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

    return true;
}