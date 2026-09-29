<?php

require_once "koneksi.php";


// ========================================
// MENGAMBIL DATA BERDASARKAN ID
// ========================================

if (!isset($_GET["id"])) {

    header("Location: index.php");
    exit;

}

$id = (int) $_GET["id"];


$query = "SELECT * FROM barang WHERE id = ?";

$stmt = mysqli_prepare($koneksi, $query);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$barang = mysqli_fetch_assoc($result);


if (!$barang) {

    echo "Data barang tidak ditemukan.";
    exit;

}


// ========================================
// PROSES UPDATE
// ========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $kode_barang = trim($_POST["kode_barang"]);
    $nama_barang = trim($_POST["nama_barang"]);
    $jumlah = $_POST["jumlah"];
    $satuan = trim($_POST["satuan"]);
    $lokasi = trim($_POST["lokasi"]);


    // Validasi
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


    $query = "
        UPDATE barang
        SET
            kode_barang = ?,
            nama_barang = ?,
            jumlah = ?,
            satuan = ?,
            lokasi = ?
        WHERE id = ?
    ";


    $stmt = mysqli_prepare($koneksi, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "ssissi",
        $kode_barang,
        $nama_barang,
        $jumlah,
        $satuan,
        $lokasi,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php");

        exit;

    } else {

        echo "Gagal memperbarui data.";

    }

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Barang</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body>

<div class="container">

    <header>

        <h1>Edit Data Barang</h1>

        <p>Perbarui informasi inventaris</p>

    </header>


    <section class="card">

        <h2>Edit Barang</h2>


        <form
            method="POST"
            onsubmit="return validasiForm()"
        >

            <div class="form-group">

                <label>Kode Barang</label>

                <input
                    type="text"
                    name="kode_barang"
                    value="<?php
                        echo htmlspecialchars(
                            $barang['kode_barang']
                        );
                    ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Nama Barang</label>

                <input
                    type="text"
                    name="nama_barang"
                    value="<?php
                        echo htmlspecialchars(
                            $barang['nama_barang']
                        );
                    ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Jumlah</label>

                <input
                    type="number"
                    name="jumlah"
                    min="1"
                    value="<?php
                        echo $barang['jumlah'];
                    ?>"
                    required
                >

            </div>


            <div class="form-group">

                <label>Satuan</label>

                <select
                    name="satuan"
                    required
                >

                    <option value="pcs"
                        <?php
                        echo $barang['satuan'] === 'pcs'
                            ? 'selected'
                            : '';
                        ?>>
                        Pcs
                    </option>

                    <option value="unit"
                        <?php
                        echo $barang['satuan'] === 'unit'
                            ? 'selected'
                            : '';
                        ?>>
                        Unit
                    </option>

                    <option value="box"
                        <?php
                        echo $barang['satuan'] === 'box'
                            ? 'selected'
                            : '';
                        ?>>
                        Box
                    </option>

                    <option value="buah"
                        <?php
                        echo $barang['satuan'] === 'buah'
                            ? 'selected'
                            : '';
                        ?>>
                        Buah
                    </option>

                    <option value="lusin"
                        <?php
                        echo $barang['satuan'] === 'lusin'
                            ? 'selected'
                            : '';
                        ?>>
                        Lusin
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Lokasi Penyimpanan</label>

                <input
                    type="text"
                    name="lokasi"
                    value="<?php
                        echo htmlspecialchars(
                            $barang['lokasi']
                        );
                    ?>"
                    required
                >

            </div>


            <div class="button-group">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Simpan Perubahan
                </button>


                <a
                    href="index.php"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

            </div>

        </form>

    </section>

</div>


<script src="script.js"></script>

</body>

</html>