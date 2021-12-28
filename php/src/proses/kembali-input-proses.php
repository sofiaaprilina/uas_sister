<?php 
    include '../koneksi.php';

    $id_kembali = $_POST['id_kembali'];
    $id_pinjam = $_POST['id_pinjam'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $jumlah = 1;
    $tgl_kembali = $_POST['tgl_kembali'];
   

    if (isset($_POST['simpan'])) {
        extract($_POST);

        mysqli_query($db, "DELETE FROM tbpinjam WHERE idpinjam = '$id_pinjam'");
        mysqli_query($db, "UPDATE tbbuku
                            SET jumlah= jumlah + $jumlah
                            WHERE idbuku='$id_buku'");
        $sql = "INSERT INTO tbkembali VALUES('$id_kembali','$id_pinjam','$id_anggota','$id_buku','$jumlah','$tgl_kembali')";
        $query = mysqli_query($db, $sql);

        header("location:../index.php?p=transaksi-pengembalian");
    }
?>