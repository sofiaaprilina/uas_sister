<?php 
    $id_kategori = $_GET['id'];
    $q_tampil_kategori = mysqli_query($db, "SELECT * FROM tbkategori WHERE idkategori = '$id_kategori'");
    $r_tampil_kategori = mysqli_fetch_array($q_tampil_kategori);
?>
<div id="label-page"><h3>Edit Data Kategori</h3></div>
<div id="content">
    <p id="tombol-tambah-container">
        <a href="index.php?p=kategori" class="tombol">Kembali</a>
    </p>
    <form action="proses/kategori-edit-proses.php" method="post" enctype="multipart/form-data">
        <table id="tabel-input">
            <tr>
                <td class="label-formulir">ID kategori</td>
                <td class="isian-formulir"><input type="text" name="id_kategori" value="<?php echo $r_tampil_kategori['idkategori'];?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
            </tr>
            <tr>
                <td class="label-formulir">Nama</td>
                <td class="isian-formulir"><input type="text" name="nama" value="<?php echo $r_tampil_kategori['nama'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir"></td>
                <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" id="tombol-simpan"></td>
            </tr>
        </table>
    </form>
</div>