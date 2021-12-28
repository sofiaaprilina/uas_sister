<div id="label-page"><h3>Input Transaksi Peminjaman</h3></div>
<div id="content">
	<form action="proses/transaksi-peminjaman-input-proses.php" method="post">
	<table id="tabel-input">
		<tr>
			<td class="label-formulir">ID Peminjaman</td>
			<td class="isian-formulir"><input type="text" name="id_pinjam" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Anggota</td>
			<td class="isian-formulir">
				<select name="id_anggota" class="isian-formulir isian-formulir-border">
					<option value="" select="selected">-- Pilih Anggota --</option>
                    <?php 
                        $nomor = 1;
                        $query = "SELECT * FROM tbanggota";
                        $q_tampil_anggota = mysqli_query($db, $query);
        
                        if (mysqli_num_rows($q_tampil_anggota) >0) {
                            while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
                                
                    ?>
                    <option value="<?php echo $r_tampil_anggota['idanggota']; ?>"> <?php echo $r_tampil_anggota['idanggota']." | ".$r_tampil_anggota['nama']; ?></option>
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
                    <option value="" select="selected">-- Pilih Buku --</option>
                    <?php 
                        $nomor = 1;
                        $query1 = "SELECT * FROM tbbuku";
                        $q_tampil_buku = mysqli_query($db, $query1);
        
                        if (mysqli_num_rows($q_tampil_buku) >0) {
                            while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
                                
                    ?>
                    <option value="<?php echo $r_tampil_buku['idbuku'];?>"> <?php echo $r_tampil_buku['idbuku']." | ". $r_tampil_buku['judul'];?></option>
                    <?php 
                        }
                    }
                    ?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label-formulir">Tanggal Pinjam</td>
			<td class="isian-formulir"><input type="date" name="tgl_pinjam" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir">Tanggal Kembali</td>
			<td class="isian-formulir"><input type="date" name="tgl_kembali" class="isian-formulir isian-formulir-border"></td>
		</tr>
		<tr>
			<td class="label-formulir"></td>
			<td class="isian-formulir"><input type="submit" name="simpan" value="Simpan" class="tombol"></td>
		</tr>
	</table>
	</form>
</div>