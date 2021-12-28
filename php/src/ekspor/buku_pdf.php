<?php
require '../vendor/autoload.php';
require '../koneksi.php';

use Dompdf\Dompdf;

$nomor = 1;
$query = 'SELECT * FROM tbbuku ORDER BY idbuku';
$q_tampil_buku = mysqli_query($db, $query);

$html = '<h1 style="text-align: center;">Data Buku</h1>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead>
                <tr>
                    <th id="label-tampil-no">No</th>
                    <th>ID Buku</th>
                    <th>Judul</th>
                    <th>ID Kategori</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Jumlah</th>
                    <th>Cover</th>
                </tr>
            </thead>
            <tbody>';
if (mysqli_num_rows($q_tampil_buku) > 0) {
    while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
        if (
            empty($r_tampil_buku['cover']) or
            $r_tampil_buku['cover'] == '-'
        ) {
            $cover = 'buku.png';
        } else {
            $cover = $r_tampil_buku['cover'];
        }
        
        $html .=
            '<tr>
            <td align="center">'.$nomor.'</td>
            <td align="center">'.$r_tampil_buku['idbuku'].'</td>
            <td align="center">'.$r_tampil_buku['judul'].'</td>
            <td align="center">'.$r_tampil_buku['kategori'].'</td>
            <td align="center">'.$r_tampil_buku['pengarang'].'</td>
            <td align="center">'.$r_tampil_buku['penerbit'].'</td>
            <td align="center">'.$r_tampil_buku['tahun'].'</td>
            <td align="center">'.$r_tampil_buku['jumlah'].'</td>
            <td align="center"><img src="http://localhost/jwd_11/images/'.$cover.'" width="70px" height="70px"></td>
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