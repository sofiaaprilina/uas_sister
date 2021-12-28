<?php 
    include '../koneksi.php';

    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $jumlah = $_POST['jumlah'];

    if (isset($_POST['simpan'])) {
        extract($_POST);
        $nama_file = $_FILES['cover']['name'];

        if (!empty($nama_file)) {
            $lokasi_file = $_FILES['cover']['tmp_name'];
            $tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
            $file_cover = $id_buku.".".$tipe_file;

            $folder = "../images/$file_cover";
            move_uploaded_file($lokasi_file, "$folder");
        } else {
            $file_cover = "-";
        }
        $sql = "INSERT INTO tbbuku VALUES('$id_buku','$judul','$kategori','$pengarang','$penerbit','$tahun','$jumlah','$file_cover')";
        $query = mysqli_query($db, $sql);

        header("location:../index.php?p=buku");
    }
?>