<?php 
    $id_pinjam = $_GET['id'];
    $q_tampil_pinjam = mysqli_query($db, "SELECT * FROM tbpinjam WHERE idpinjam = '$id_pinjam'");
    $r_tampil_pinjam = mysqli_fetch_array($q_tampil_pinjam);

?>
<div id="label-page"><h3>Edit Data Peminjaman</h3></div>
<div id="content">
    <form action="proses/pinjam-edit-proses.php" method="post" enctype="multipart/form-data">
        <table id="tabel-input">
            <tr>
                <td class="label-formulir">ID Peminjaman</td>
                <td class="isian-formulir"><input type="text" name="id_pinjam" value="<?php echo $r_tampil_pinjam['idpinjam'];?>" readonly="readonly" class="isian-formulir isian-formulir-border warna-formulir-disabled"></td>
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
                                if ($r_tampil_pinjam['idanggota'] == $r_tampil_anggota['idanggota']) {
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
                                if ($r_tampil_pinjam['idbuku'] == $r_tampil_buku['idbuku']) {
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
                <td class="label-formulir">Tanggal Pinjam</td>
                <td class="isian-formulir"><input type="date" name="tgl_pinjam" value="<?php echo $r_tampil_pinjam['tglpinjam'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir">Tanggal Kembali</td>
                <td class="isian-formulir"><input type="date" name="tgl_kembali" value="<?php echo $r_tampil_pinjam['tglkembali'];?>" class="isian-formulir isian-formulir-border"></td>
            </tr>
            <tr>
                <td class="label-formulir"></td>
                <td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" id="tombol-simpan"></td>
            </tr>
        </table>
    </form>
</div>