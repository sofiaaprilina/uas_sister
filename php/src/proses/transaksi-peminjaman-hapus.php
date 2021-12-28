<?php 
    include '../koneksi.php';

    $id_pinjam = $_GET['id'];

    mysqli_query($db, "DELETE FROM tbpinjam WHERE idpinjam = '$id_pinjam'");

    header("location:../index.php?p=transaksi-peminjaman");
?>