<?php
require 'vendor/autoload.php';
require 'koneksi.php';

use Dompdf\Dompdf;

$nomor = 1;
$query = 'SELECT * FROM tbanggota ORDER BY idanggota';
$q_tampil_anggota = mysqli_query($db, $query);

$html = '<h1 style="text-align: center;">Data Anggota</h1>';
$html .= '<table width="100%" border="1" cellspacing="0" cellpadding="2">
            <thead>
                <tr>
                    <th id="label-tampil-no">No</th>
                    <th>ID Anggota</th>
                    <th>Nama</th>
                    <th>Foto</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>';
if (mysqli_num_rows($q_tampil_anggota) > 0) {
    while ($r_tampil_anggota = mysqli_fetch_array($q_tampil_anggota)) {
        if (
            empty($r_tampil_anggota['foto']) or
            $r_tampil_anggota['foto'] == '-'
        ) {
            $foto = 'admin-no-photo.jpg';
        } else {
            $foto = $r_tampil_anggota['foto'];
        }
        
        $html .=
            '<tr>
            <td>'.$nomor.'</td>
            <td>'.$r_tampil_anggota['idanggota'].'</td>
            <td>'.$r_tampil_anggota['nama'].'</td>
            <td><img src="http://localhost/jwd_11/images/'.$foto.'" width="70px" height="70px"></td>
            <td>'.$r_tampil_anggota['jeniskelamin'].'</td>
            <td>'.$r_tampil_anggota['alamat'].'</td>
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