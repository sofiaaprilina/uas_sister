<?php 
    $id_kembali = $_GET['id'];
    $q_tampil_kembali = mysqli_query($db, "SELECT * FROM tbkembali WHERE idkembali = '$id_kembali'");
    $r_tampil_kembali = mysqli_fetch_array($q_tampil_kembali);

?>
<div id="label-page"><h3>Edit Data Pengembalian</h3></div>
<div id="content">
    <form action="proses/kembali-edit-proses.php" method="post" enctype="multipart/form-data">
        <table id="tabel-input">
            <tr>
                <td class="label-formulir">ID Pengembalian</td>
                <td class="isian-formulir"><input type="text" name="id_kembali" value="<?php echo $r_tampil_kembali['idkembali'];?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
            </tr>
            <tr>
                <td class="label-formulir">ID Peminjaman</td>
                <td class="isian-formulir"><input type="text" name="id_pinjam" value="<?php echo $r_tampil_kembali['idpinjam'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Anggota</td>
                <td class="isian-formulir">
				<select name="id_anggota" class="isian-formulir isian-formulir-border">
                <?php 
                        $nomor = 1;
                        $query = "SELECT * FROM tbanggota";
                        $q_tampil_anggota = mysqli_query($db, $query);
        
                        if (mysqli_num_rows($q_tampil_anggota) >0) {
                            while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
                                if ($r_tampil_kembali['idanggota'] == $r_tampil_anggota['idanggota']) {
                                ?>
                                    <option value="<?php echo $r_tampil_anggota['idanggota'];?>" selected><?php echo $r_tampil_anggota['idanggota']." | ".$r_tampil_anggota['nama'];?></option>
                                <?php 
                                }
                                ?>
                    <option value="<?php echo $r_tampil_anggota['idanggota'];?>"><?php echo $r_tampil_anggota['idanggota']." | ".$r_tampil_anggota['nama'];?></option>
                    <?php 
                        }
                    }
                    ?>
				</select>
			</td>
            </tr>
            <tr>
                <td class="label-formulir">Buku</td>
                <td class="isian-formulir">
				<select name="id_buku" class="isian-formulir isian-formulir-border">
                <?php 
                        $nomor = 1;
                        $query1 = "SELECT * FROM tbbuku";
                        $q_tampil_buku = mysqli_query($db, $query1);
        
                        if (mysqli_num_rows($q_tampil_buku) >0) {
                            while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
                                if ($r_tampil_kembali['idbuku'] == $r_tampil_buku['idbuku']) {
                                ?>
                                    <option value="<?php echo $r_tampil_buku['idbuku'];?>" selected><?php echo $r_tampil_buku['idbuku']." | ".$r_tampil_buku['judul'];?></option>
                                <?php 
                                }
                                ?>
                    <option value="<?php echo $r_tampil_buku['idbuku'];?>"><?php echo $r_tampil_buku['idbuku']." | ".$r_tampil_buku['judul'];?></option>
                    <?php 
                        }
                    }
                    ?>
				</select>
			</td>
            </tr>
            <tr>
                <td class="label-formulir">Tanggal kembali</td>
                <td class="isian-formulir"><input type="date" name="tgl_kembali" value="<?php echo $r_tampil_kembali['tglkembali'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir"></td>
                <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" id="tombol-simpan"></td>
            </tr>
        </table>
    </form>
</div>