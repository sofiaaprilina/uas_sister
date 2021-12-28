<?php
require '../vendor/autoload.php';
require '../koneksi.php';

use Dompdf\Dompdf;

$nomor = 1;
$nomor2 = 1;
$query = 'SELECT * FROM tbpinjam ORDER BY idpinjam';
$query2 = 'SELECT * FROM tbkembali ORDER BY idkembali';
$q_tampil_pinjam = mysqli_query($db, $query);
$q_tampil_kembali = mysqli_query($db, $query2);

$html = '<h2 style="text-align: center;">Laporan Transaksi</h2>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="3">
            <thead>
                <tr><td colspan="7"><b>I. Data Peminjaman</b></td></tr>
                <tr>
                    <th id="label-tampil-no">No</th>
                    <th>ID Peminjaman</th>
                    <th>ID Anggota</th>
                    <th>ID Buku</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                </tr>
            </thead>
            <tbody>';
                            
if (mysqli_num_rows($q_tampil_pinjam) > 0) {
    while ($r_tampil_pinjam = mysqli_fetch_array($q_tampil_pinjam)) {

        $html .=
            '<tr>
            <td align="center">'.$nomor.'</td>
            <td align="center">'.$r_tampil_pinjam['idpinjam'].'</td>
            <td align="center">'.$r_tampil_pinjam['idanggota'].'</td>
            <td align="center">'.$r_tampil_pinjam['idbuku'].'</td>
            <td align="center">'.$r_tampil_pinjam['jumlah'].'</td>
            <td align="center">'.$r_tampil_pinjam['tglpinjam'].'</td>
            <td align="center">'.$r_tampil_pinjam['tglkembali'].'</td>
        </tr>';
        $nomor++;
    }
}
$html .= '<tr><td colspan="7" align="center"> </td></tr>
            <tr><td colspan="7"><b>II. Data Pengembalian</b></td></tr>';
// $html .= '<h1 style="text-align: center;">Data Pengembalian</h1>';
$html .= '<tr>
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
                            
if (mysqli_num_rows($q_tampil_kembali) > 0) {
    while ($r_tampil_kembali = mysqli_fetch_array($q_tampil_kembali)) {

        $html .=
            '<tr>
            <td align="center">'.$nomor2.'</td>
            <td align="center">'.$r_tampil_kembali['idkembali'].'</td>
            <td align="center">'.$r_tampil_kembali['idpinjam'].'</td>
            <td align="center">'.$r_tampil_kembali['idanggota'].'</td>
            <td align="center">'.$r_tampil_kembali['idbuku'].'</td>
            <td align="center">'.$r_tampil_kembali['jumlah'].'</td>
            <td align="center">'.$r_tampil_kembali['tglkembali'].'</td>
        </tr>';
        $nomor2++;
    }
}
$totalP = mysqli_num_rows($q_tampil_pinjam);
$totalK = mysqli_num_rows($q_tampil_kembali);
$html .= '<tr>
            <td colspan="7"><b>Total Peminjaman = '.$totalP.'</b></td>
        </tr>
        <tr>
            <td colspan="7"><b>Total Pengembalian = '.$totalK.'</b></td>
        </tr>
        </tbody></html>';

// echo $html;

$dompdf = new Dompdf();
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->load_html($html);
$dompdf->setPaper('a4', 'landscape');
$dompdf->render();
$dompdf->stream();

?>