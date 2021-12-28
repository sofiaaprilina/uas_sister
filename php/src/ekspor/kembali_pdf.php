<?php
require '../vendor/autoload.php';
require '../koneksi.php';

use Dompdf\Dompdf;

$nomor = 1;
$query = 'SELECT * FROM tbkembali ORDER BY idkembali';
$q_tampil_kembali = mysqli_query($db, $query);

$html = '<h1 style="text-align: center;">Data Pengembalian</h1>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead>
                <tr>
                    <th id="label-tampil-no">No</th>
                    <th>ID Pengembalian</th>
                    <th>ID Peminjaman</th>
                    <th>ID Anggota</th>
                    <th>ID Buku</th>
                    <th>Jumlah</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>';

            // $query1 = "SELECT * FROM tbanggota";
            // $q_tampil_anggota = mysqli_query($db, $query1);
            // $r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota);
            
            // $query2 = "SELECT * FROM tbbuku WHERE";
            // // $q_tampil_buku = mysqli_query($db, $query2);
            // // $r_tampil_buku = mysqli_fetch_array($q_tampil_buku);

            // $q_tampil_buku = mysqli_query($db, "SELECT judul FROM tbbuku WHERE idbuku = $r_tampil_kembali[idbuku]");
            // $r_tampil_buku = mysqli_fetch_array($q_tampil_buku);
            // $buku = $r_tampil_buku;
                            
if (mysqli_num_rows($q_tampil_kembali) > 0) {
    while ($r_tampil_kembali = mysqli_fetch_array($q_tampil_kembali)) {

        $html .=
            '<tr>
            <td align="center">'.$nomor.'</td>
            <td align="center">'.$r_tampil_kembali['idkembali'].'</td>
            <td align="center">'.$r_tampil_kembali['idpinjam'].'</td>
            <td align="center">'.$r_tampil_kembali['idanggota'].'</td>
            <td align="center">'.$r_tampil_kembali['idbuku'].'</td>
            <td align="center">'.$r_tampil_kembali['jumlah'].'</td>
            <td align="center">'.$r_tampil_kembali['tglkembali'].'</td>
        </tr>';
        $nomor++;
    }
}
$html .= '</tbody></html>';

// echo $html;

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->load_html($html);
$dompdf->setPaper('a4', 'landscape');
$dompdf->render();
$dompdf->stream();

?>