<?php
include "../../koneksi.php";
 

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $koneksi->prepare("DELETE FROM guru WHERE id_guru=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../guru_hapus.php?page=jurusan&pesan=hapus");
    exit;
} else {
    header("Location: ../guru_hapus.php?page=jurusan");
    exit;
}

?>