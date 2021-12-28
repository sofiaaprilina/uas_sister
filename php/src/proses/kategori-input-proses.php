<?php 
    include '../koneksi.php';

    $id_kategori = $_POST['id_kategori'];
    $nama = $_POST['nama'];

    if (isset($_POST['simpan'])) {
        extract($_POST);

        $sql = "INSERT INTO tbkategori VALUES('$id_kategori','$nama')";
        $query = mysqli_query($db, $sql);

        header("location:../index.php?p=kategori");
    }
?>