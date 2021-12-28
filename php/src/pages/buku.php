<div id="label-page"><h3>Tampil Data buku</h3></div>
<div id="content">
    <p id="tombol-tambah-container">
        <div align="right">
        <a href="ekspor/buku_pdf.php"><img src="pdf.png" height="50px" height="50px"></a>
        <a href="ekspor/buku_excel.php"><img src="excel.png" height="50px" height="50px"></a>
        </div>
            <div align="left">
                
        <a href="index.php?p=buku-input" class="tombol">Tambah buku</a>
        <a href="index.php?p=kategori" class="tombol">Lihat Kategori</a>
            </div>
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
                <th>ID Buku</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun Terbit</th>
                <th>Jumlah</th>
                <th>Foto</th>
                <th id="label-opsi">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $batas = 5;
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
                        $sql = "SELECT * FROM tbbuku WHERE judul LIKE '%$pencarian%'
                                OR idbuku LIKE '%$pencarian%'
                                OR kategori LIKE '%$pencarian%'
                                OR pengarang LIKE '%$pencarian%'
                                OR penerbit LIKE '%$pencarian%'
                                OR tahun LIKE '%$pencarian%'
                                OR jumlah LIKE '%$pencarian%'";
                        
                        $query = $sql;
                        $queryJml = $sql;
                    } else {
                        $query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbbuku";
                        $no = $posisi * 1;
                    }
                } else {
                    $query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM tbbuku";
                    $no = $posisi * 1;
                }
                //$sql = "SELECT * FROM tbbuku ORDER BY idbuku DESC";
                $q_tampil_buku = mysqli_query($db, $query);

                // Pengecekan apakah terdapat data di database, jika ada tampilkan
                if (mysqli_num_rows($q_tampil_buku) > 0) {
                    while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
                        if (empty($r_tampil_buku['cover']) or ($r_tampil_buku['cover'] == '-')) {
                            $foto = "book.png";
                        } else {
                            $foto = $r_tampil_buku['cover'];
                        }
                ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_buku['idbuku']; ?></td>
                        <td><?php echo $r_tampil_buku['judul']; ?></td>
                        <td><?php
                            $q_tampil_kategori = mysqli_query($db, "SELECT * FROM tbkategori");
                            if (mysqli_num_rows($q_tampil_kategori) >0) {
                                while ($r_tampil_kategori = mysqli_fetch_array($q_tampil_kategori)) {
                                    if ($r_tampil_buku['kategori'] == $r_tampil_kategori['idkategori']) {
                                        echo $r_tampil_kategori['nama'];
                                    }
                            }
                        }
                        ?></td>
                        <td><?php echo $r_tampil_buku['pengarang']; ?></td>
                        <td><?php echo $r_tampil_buku['penerbit']; ?></td>
                        <td><?php echo $r_tampil_buku['tahun']; ?></td>
                        <td><?php echo $r_tampil_buku['jumlah']; ?></td>
                        <td><img src="images/<?php echo $foto; ?>" width=70px height=90px></td>
                        <td>
                            <div class="tombol-opsi-container"><a href="index.php?p=buku-edit&id=<?php echo $r_tampil_buku['idbuku']; ?>" class="tombol">Edit</a></div>
                            <div class="tombol-opsi-container"><a href="proses/buku-hapus.php?id=<?php echo $r_tampil_buku['idbuku']; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
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
                            echo "<a href=\"?p=buku&hal=$i\">$i</a>";
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