<?php 
    include '../koneksi.php';

    $id_kembali = $_GET['id'];

    mysqli_query($db, "DELETE FROM tbkembali WHERE idkembali = '$id_kembali'");

    header("location:../index.php?p=transaksi-pengembalian");
?>