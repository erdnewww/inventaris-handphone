<?php

require_once "koneksi.php";

// Mengambil semua data barang
$query = "SELECT * FROM barang ORDER BY id DESC";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Inventaris Handphone</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <header>
        <h1>Inventaris Handphone</h1>
        <p>Sistem Pengelolaan Data Inventaris</p>
    </header>


    <!-- FORM TAMBAH BARANG -->
    <section class="card">

        <h2>Tambah Data Handphone</h2>

        <form
            action="tambah.php"
            method="POST"
            onsubmit="return validasiForm()"
        >

            <div class="form-group">

                <label for="kode_barang">
                    Kode Barang
                </label>

                <input
                    type="text"
                    id="kode_barang"
                    name="kode_barang"
                    placeholder="Contoh: BRG001"
                    required
                >

            </div>


            <div class="form-group">

                <label for="nama_barang">
                    Nama Barang
                </label>

                <input
                    type="text"
                    id="nama_barang"
                    name="nama_barang"
                    placeholder="Contoh: IPHONE"
                    required
                >

            </div>


            <div class="form-group">

                <label for="jumlah">
                    Jumlah
                </label>

                <input
                    type="number"
                    id="jumlah"
                    name="jumlah"
                    min="1"
                    placeholder="Contoh: 10"
                    required
                >

            </div>


            <div class="form-group">

                <label for="satuan">
                    Satuan
                </label>

                <select
                    id="satuan"
                    name="satuan"
                    required
                >

                    <option value="">
                        -- Pilih Satuan --
                    </option>

                    <option value="pcs">
                        Pcs
                    </option>

                    <option value="unit">
                        Unit
                    </option>

                    <option value="box">
                        Box
                    </option>

                    <option value="buah">
                        Buah
                    </option>

                    <option value="lusin">
                        Lusin
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label for="lokasi">
                    Lokasi Penyimpanan
                </label>

                <input
                    type="text"
                    id="lokasi"
                    name="lokasi"
                    placeholder="Contoh: Gudang A"
                    required
                >

            </div>


            <div class="button-group">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Tambah Barang
                </button>

                <button
                    type="reset"
                    class="btn btn-secondary"
                >
                    Reset
                </button>

            </div>

        </form>

    </section>


    <!-- TABEL DATA -->
    <section class="card">

        <div class="table-header">

            <div>

                <h2>Daftar Barang</h2>

                <p>
                    Total data:
                    <?php echo mysqli_num_rows($result); ?>
                    barang
                </p>

            </div>


            <input
                type="text"
                id="searchInput"
                placeholder="Cari barang..."
                onkeyup="cariBarang()"
            >

        </div>


        <div class="table-container">

            <table id="tabelBarang">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Kode Barang</th>

                        <th>Nama Barang</th>

                        <th>Jumlah</th>

                        <th>Satuan</th>

                        <th>Lokasi</th>

                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                <?php

                $no = 1;

                if (mysqli_num_rows($result) > 0):

                    while ($barang = mysqli_fetch_assoc($result)):

                ?>

                    <tr>

                        <td>
                            <?php echo $no++; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $barang['kode_barang']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $barang['nama_barang']
                            );
                            ?>
                        </td>

                        <td>
                            <?php echo $barang['jumlah']; ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $barang['satuan']
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $barang['lokasi']
                            );
                            ?>
                        </td>

                        <td>

                            <div class="action-buttons">

                                <a
                                    href="edit.php?id=<?php echo $barang['id']; ?>"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>


                                <a
                                    href="hapus.php?id=<?php echo $barang['id']; ?>"
                                    class="btn btn-delete"
                                    onclick="return konfirmasiHapus()"
                                >
                                    Hapus
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php

                    endwhile;

                else:

                ?>

                    <tr>

                        <td
                            colspan="7"
                            class="empty-message"
                        >
                            Belum ada data barang.
                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </section>

</div>


<script src="script.js"></script>

</body>

</html>