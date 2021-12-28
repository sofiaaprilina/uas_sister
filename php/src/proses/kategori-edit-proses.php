<?php 
    include '../koneksi.php';

    $id_kategori = $_POST['id_kategori'];
    $nama = $_POST['nama'];

    if (isset($_POST['simpan'])) {
        extract($_POST);
        $nama_file = $_FILES['foto']['name'];

        mysqli_query($db, "UPDATE tbkategori
                            SET nama='$nama'
                            WHERE idkategori='$id_kategori'");

        header("location:../index.php?p=kategori");
    }
?>