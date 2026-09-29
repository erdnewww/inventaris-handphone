<?php

require_once "koneksi.php";


if (!isset($_GET["id"])) {

    header("Location: index.php");
    exit;

}


$id = (int) $_GET["id"];


$query = "DELETE FROM barang WHERE id = ?";

$stmt = mysqli_prepare($koneksi, $query);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if (mysqli_stmt_execute($stmt)) {

    header("Location: index.php");

    exit;

} else {

    echo "Data gagal dihapus.";

}

?>