<?php 
    require("../vendor/autoload.php");
    require("../koneksi.php");

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $query = 'SELECT * FROM tbkembali ORDER BY idkembali';
    $q_tampil_kembali = mysqli_query($db, $query);

    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Data Pengembalian')
                ->setCellValue('A3', 'No')
                ->setCellValue('B3', 'ID Pengembalian')
                ->setCellValue('C3', 'ID Peminjaman')
                ->setCellValue('D3', 'ID Anggota')
                ->setCellValue('E3', 'ID Buku')
                ->setCellValue('F3', 'Jumlah')
                ->setCellValue('G3', 'Tanggal Pengembalian');

    $sheet = $spreadsheet->getActiveSheet();

    $index = 4;
    $nomor = 0;

    if (mysqli_num_rows($q_tampil_kembali) > 0) {
        while ($r_tampil_kembali = mysqli_fetch_array($q_tampil_kembali)) {
            $nomor++;
            $sheet->setCellValue('A'.$index, $nomor);
            $sheet->setCellValue('B'.$index, $r_tampil_kembali['idkembali']);
            $sheet->setCellValue('C'.$index, $r_tampil_kembali['idpinjam']);
            $sheet->setCellValue('D'.$index, $r_tampil_kembali['idanggota']);
            $sheet->setCellValue('E'.$index, $r_tampil_kembali['idbuku']);
            $sheet->setCellValue('F'.$index, $r_tampil_kembali['jumlah']);
            $sheet->setCellValue('G'.$index, $r_tampil_kembali['tglkembali']);
            $index++;
        }
    }

    $sheet->setTitle('Data Pengembalian Perpustakaan');
    $spreadsheet->setActiveSheetIndex(0);

    $filename = 'Data-Pengembalian.xlsx';

    ob_end_clean();

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit();
?>