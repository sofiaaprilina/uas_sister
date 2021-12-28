<div id="label-page"><h3>Kategori Buku</h3></div>
<div id="content">
    <p id="tombol-tambah-container">
        <a href="index.php?p=kategori-input" class="tombol">Tambah Kategori</a>
        <!-- <a target="_blank" href="pages/cetak.php"><img src="print.png" height="50px" height="50px"></a> -->

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
                <th>ID Kategori</th>
                <th>Nama</th>
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
                        $sql = "SELECT * FROM tbkategori WHERE nama LIKE '%$pencarian%'
                                OR idkategori LIKE '%$pencarian%'";
                        
                        $query = $sql;
                        $queryJml = $sql;
                    } else {
                        $query = "SELECT * FROM tbkategori LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbkategori";
                        $no = $posisi * 1;
                    }
                } else {
                    $query = "SELECT * FROM tbkategori LIMIT $posisi, $batas";
                    $queryJml = "SELECT * FROM tbkategori";
                    $no = $posisi * 1;
                }
                //$sql = "SELECT * FROM tbkategori ORDER BY idkategori DESC";
                $q_tampil_kategori = mysqli_query($db, $query);

                // Pengecekan apakah terdapat data di database, jika ada tampilkan
                if (mysqli_num_rows($q_tampil_kategori) > 0) {
                    while ($r_tampil_kategori = mysqli_fetch_array($q_tampil_kategori)) {
                ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $r_tampil_kategori['idkategori']; ?></td>
                        <td><?php echo $r_tampil_kategori['nama']; ?></td>
                        <td>
                            <div class="tombol-opsi-container"><a href="index.php?p=kategori-edit&id=<?php echo $r_tampil_kategori['idkategori']; ?>" class="tombol">Edit</a></div>
                            <div class="tombol-opsi-container"><a href="proses/kategori-hapus.php?id=<?php echo $r_tampil_kategori['idkategori']; ?>" onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="tombol">Hapus</a></div>
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
                            echo "<a href=\"?p=kategori&hal=$i\">$i</a>";
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