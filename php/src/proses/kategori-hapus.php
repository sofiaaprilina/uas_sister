<?php 
    include '../koneksi.php';

    $id_kategori = $_GET['id'];

    mysqli_query($db, "DELETE FROM tbkategori WHERE idkategori = '$id_kategori'");

    header("location:../index.php?p=kategori");
?>