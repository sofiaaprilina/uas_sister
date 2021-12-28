<div id="label-page"><h3>Data pengembalian</h3></div>
<div id="content">
    <p id="tombol-tambah-container">
        <!-- <a href="index.php?p=transaksi-peminjaman-input" class="tombol">Tambah Pengembalian</a> -->
        <a href="ekspor/kembali_pdf.php"><img src="pdf.png" height="50px" height="50px"></a>
        <a href="ekspor/kembali_excel.php"><img src="excel.png" height="50px" height="50px"></a>

        <div class="form-inline">
            <div align="right">
                <form method="post">
                    <input type="text" name="pencarian">
                    <input type="submit" name="search" value="search" class="tombol">
                </form>
            </div>
    </p>
    <table id="tabel-tampil">
        <thead>
            <tr>
                <th id="label-tampil-no">No</th>
                <th>ID Pengembalian</th>
                <th>ID Peminjaman</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Jumlah</th>
                <th>Tanggal Kembali</th>
                <th id="label-opsi">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $batas = 10;
                extract($_GET);
                if (empty($hal)) {
                    $posisi = 0;
                    $hal = 1;
                    $nomor = 1;
                } else {
                    $posisi = ($hal - 1) * $batas;
                    $nomor = $posisi+1;
                }

                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
                    if ($pencarian != "") {
                        $sql = "SELECT * FROM tbkembali WHERE idkembali LIKE '%$pencarian%'
                                OR idanggota LIKE '%$pencarian%'
                                OR idbuku LIKE '%$pencarian%'
                                OR jumlah LIKE '%$pencarian%'
                                OR tglkembali LIKE '%$pencarian%'";
                        
                        $query = $sql;
                        $queryJml = $sql;
                    } else {
                        $query = "SELECT * FROM tbkembali LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbkembali";
                        $no = $posisi * 1;
                    }
                } else {
                    $query = "SELECT * FROM tbkembali LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM tbkembali";
                    $no = $posisi * 1;
                }
                //$sql = "SELECT * FROM tbkembali ORDER BY idkembali DESC";
                $q_tampil_kembali = mysqli_query($db, $query);

                // Pengecekan apakah terdapat data di database, jika ada tampilkan
                if (mysqli_num_rows($q_tampil_kembali) > 0) {
                    while ($r_tampil_kembali = mysqli_fetch_array($q_tampil_kembali)) {
                ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_kembali['idkembali']; ?></td>
                        <td><?php echo $r_tampil_kembali['idpinjam']; ?></td>
                        <td><?php
                            $q_tampil_anggota = mysqli_query($db, "SELECT * FROM tbanggota");
                            if (mysqli_num_rows($q_tampil_anggota) >0) {
                                while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
                                    if ($r_tampil_kembali['idanggota'] == $r_tampil_anggota['idanggota']) {
                                        echo $r_tampil_anggota['nama'];
                                    }
                                }
                            }
                        ?></td>
                        <td><?php 
                            $q_tampil_buku = mysqli_query($db, "SELECT * FROM tbbuku");
                            if (mysqli_num_rows($q_tampil_buku) >0) {
                                while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
                                    if ($r_tampil_kembali['idbuku'] == $r_tampil_buku['idbuku']) {
                                        echo $r_tampil_buku['judul'];
                                    }
                                }
                            } 
                        ?></td>
                        <td><?php echo $r_tampil_kembali['jumlah']; ?></td>
                        <td><?php echo $r_tampil_kembali['tglkembali']; ?></td>
                        <td>
                            <div class="tombol-opsi-container"><a href="index.php?p=kembali-edit&id=<?php echo $r_tampil_kembali['idkembali']; ?>" class="tombol">Edit</a></div>
                            <div class="tombol-opsi-container"><a href="proses/kembali-hapus.php?id=<?php echo $r_tampil_kembali['idkembali']; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
                        </td>
                    </tr>
                <?php 
                            $nomor++;
                        }
                    } else {
                        echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
                    }
                ?>
        </tbody>
    </table>
    <?php 
        if (isset($_POST['pencarian'])) {
            if ($_POST['pencarian'] != '') {
                echo "<div style=\"float:left;\">";
                $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
                echo "Data Hasil Pencarian: <b>$jml</b>";
                echo "</div>";
            }
        } else {
            ?>
            <div style="float: left;">
                <?php 
                    $jml = mysqli_num_rows(mysqli_query($db, $queryJml));
                    echo "Jumlah Data : <b>$jml</b>";
                ?>
            </div>
            <div class="pagination" style="float: right;">
                <?php 
                    $jml_hal = ceil($jml / $batas);
                    for ($i = 1; $i <= $jml_hal ; $i++) { 
                        if ($i != $hal) {
                            echo "<a href=\"?p=transaksi-pengembalian&hal=$i\">$i</a>";
                        } else {
                            echo "<a class=\"active\">$i</a>";
                        }
                    }
                ?>
            </div>
            <?php 
        }
    ?>
</div>