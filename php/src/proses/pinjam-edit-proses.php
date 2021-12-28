<?php 
    include '../koneksi.php';

    $id_pinjam = $_POST['id_pinjam'];
    $id_anggota = $_POST['id_anggota'];
    $id_buku = $_POST['id_buku'];
    $jumlah = 1;
    $tgl_pinjam = $_POST['tgl_pinjam'];
    $tgl_kembali = $_POST['tgl_kembali'];

    if (isset($_POST['simpan'])) {
        extract($_POST);

        mysqli_query($db, "UPDATE tbpinjam
                            SET idanggota='$id_anggota', idbuku='$id_buku', jumlah='$jumlah', tglpinjam='$tgl_pinjam'
                            WHERE idpinjam='$id_pinjam'");

        header("location:../index.php?p=transaksi-peminjaman");
    }
?>