// ========================================
// VALIDASI FORM
// ========================================

function validasiForm() {

    const jumlahInput =
        document.getElementById("jumlah");

    if (jumlahInput) {

        const jumlah =
            Number(jumlahInput.value);

        if (jumlah <= 0) {

            alert(
                "Jumlah barang harus lebih dari 0!"
            );

            return false;
        }
    }

    return true;
}


// ========================================
// KONFIRMASI HAPUS
// ========================================

function konfirmasiHapus() {

    return confirm(
        "Apakah kamu yakin ingin menghapus data ini?"
    );

}


// ========================================
// PENCARIAN BARANG
// ========================================

function cariBarang() {

    const input =
        document.getElementById("searchInput");

    const filter =
        input.value.toLowerCase();

    const tabel =
        document.getElementById("tabelBarang");

    const baris =
        tabel.getElementsByTagName("tr");


    for (let i = 0; i < baris.length; i++) {

        const isi =
            baris[i].textContent.toLowerCase();

        if (isi.includes(filter)) {

            baris[i].style.display = "";

        } else {

            baris[i].style.display = "none";

        }

    }

}