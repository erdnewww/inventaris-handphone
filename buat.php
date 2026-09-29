<?php

require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $kode_barang = trim($_POST["kode_barang"]);
    $nama_barang = trim($_POST["nama_barang"]);
    $jumlah = $_POST["jumlah"];
    $satuan = trim($_POST["satuan"]);
    $lokasi = trim($_POST["lokasi"]);


    // Validasi input
    if (
        empty($kode_barang) ||
        empty($nama_barang) ||
        empty($jumlah) ||
        empty($satuan) ||
        empty($lokasi)
    ) {

        die("Semua data wajib diisi.");

    }


    if (!is_numeric($jumlah) || $jumlah <= 0) {

        die("Jumlah harus berupa angka lebih dari 0.");

    }


    // Menggunakan prepared statement
    $query = "
        INSERT INTO barang
        (kode_barang, nama_barang, jumlah, satuan, lokasi)
        VALUES (?, ?, ?, ?, ?)
    ";

    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ssiss",
        $kode_barang,
        $nama_barang,
        $jumlah,
        $satuan,
        $lokasi
    );


    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php");

        exit;

    } else {

        echo "Gagal menambahkan data: "
            . mysqli_error($koneksi);

    }

}
?>