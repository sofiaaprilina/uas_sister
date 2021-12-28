<?php 
    $id_buku = $_GET['id'];
    $q_tampil_buku = mysqli_query($db, "SELECT * FROM tbbuku WHERE idbuku = '$id_buku'");
    $r_tampil_buku = mysqli_fetch_array($q_tampil_buku);

    if (empty($r_tampil_buku['cover']) or ($r_tampil_buku['cover'] == '-')) {
        $cover = "buku.png";
    } else {
        $cover = $r_tampil_buku['cover'];
    }
?>
<div id="label-page"><h3>Edit Data Buku</h3></div>
<div id="content">
    <form action="proses/buku-edit-proses.php" method="post" enctype="multipart/form-data">
        <table id="tabel-input">
            <tr>
                <td class="label-formulir">Cover</td>
                <td class="isian-formulir">
                    <img src="images/<?php echo $cover; ?>" width="70px" height="75px">
                    <input type="file" name="cover" class="isian-formulir isian-formulir-border">
                    <input type="hidden" name="cover_awal" value="<?php echo $r_tampil_buku['cover'];?>">
                </td>                
            </tr>
            <tr>
                <td class="label-formulir">ID Buku</td>
                <td class="isian-formulir"><input type="text" name="id_buku" value="<?php echo $r_tampil_buku['idbuku'];?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
            </tr>
            <tr>
                <td class="label-formulir">Judul</td>
                <td class="isian-formulir"><input type="text" name="judul" value="<?php echo $r_tampil_buku['judul'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Kategori</td>
                <td class="isian-formulir">
                <select name="kategori">
                    <?php 
                        $nomor = 1;
                        $query = "SELECT * FROM tbkategori";
                        $q_tampil_kategori = mysqli_query($db, $query);
        
                        if (mysqli_num_rows($q_tampil_kategori) >0) {
                            while ($r_tampil_kategori = mysqli_fetch_array($q_tampil_kategori)) {
                                if ($r_tampil_buku['kategori'] == $r_tampil_kategori['idkategori']) {
                                ?>
                                    <option value="<?php echo $r_tampil_kategori['idkategori'];?>" selected><?php echo $r_tampil_kategori['nama'];?></option>
                                <?php 
                                }
                                ?>
                    <option value="<?php echo $r_tampil_kategori['idkategori'];?>"><?php echo $r_tampil_kategori['nama'];?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
                </td>
            </tr>
            <tr>
                <td class="label-formulir">Pengarang</td>
                <td class="isian-formulir"><input type="text" name="pengarang" value="<?php echo $r_tampil_buku['pengarang'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Penerbit</td>
                <td class="isian-formulir"><input type="text" name="penerbit" value="<?php echo $r_tampil_buku['penerbit'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Tahun Terbit</td>
                <td class="isian-formulir"><input type="text" name="tahun" value="<?php echo $r_tampil_buku['tahun'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Jumlah</td>
                <td class="isian-formulir"><input type="text" name="jumlah" value="<?php echo $r_tampil_buku['jumlah'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir"></td>
                <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" id="tombol-simpan"></td>
            </tr>
        </table>
    </form>
</div>