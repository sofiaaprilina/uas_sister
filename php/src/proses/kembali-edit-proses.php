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

        mysqli_query($db, "UPDATE tbkembali
                            SET idpinjam='$id_pinjam', idanggota='$id_anggota', idbuku='$id_buku', jumlah='$jumlah', tglkembali='$tgl_kembali'
                            WHERE idkembali='$id_kembali'");

        header("location:../index.php?p=transaksi-pengembalian");
    }
?>