<?php 
    require("../vendor/autoload.php");
    require("../koneksi.php");

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $query = 'SELECT * FROM tbpinjam ORDER BY idpinjam';
    $q_tampil_pinjam = mysqli_query($db, $query);

    $query2 = 'SELECT * FROM tbkembali ORDER BY idkembali';
    $q_tampil_kembali = mysqli_query($db, $query2);

    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Data Peminjaman')
                ->setCellValue('A3', 'No')
                ->setCellValue('B3', 'ID Peminjaman')
                ->setCellValue('C3', 'ID Anggota')
                ->setCellValue('D3', 'ID Buku')
                ->setCellValue('E3', 'Jumlah')
                ->setCellValue('F3', 'Tanggal Pinjam')
                ->setCellValue('G3', 'Tanggal Kembali')
                ->setCellValue('H3', 'Status');

    $sheet = $spreadsheet->getActiveSheet();

    $index = 4;
    $nomor = 0;
    $status = "Pinjam";


    if (mysqli_num_rows($q_tampil_pinjam) > 0) {
        while ($r_tampil_pinjam = mysqli_fetch_array($q_tampil_pinjam)) {
            $nomor++;
            $sheet->setCellValue('A'.$index, $nomor);
            $sheet->setCellValue('B'.$index, $r_tampil_pinjam['idpinjam']);
            $sheet->setCellValue('C'.$index, $r_tampil_pinjam['idanggota']);
            $sheet->setCellValue('D'.$index, $r_tampil_pinjam['idbuku']);
            $sheet->setCellValue('E'.$index, $r_tampil_pinjam['jumlah']);
            $sheet->setCellValue('F'.$index, $r_tampil_pinjam['tglpinjam']);
            $sheet->setCellValue('G'.$index, $r_tampil_pinjam['tglkembali']);
            $sheet->setCellValue('H'.$index, $status);
            $index++;
        }
    }

    $sheet->setTitle('Laporan Transaksi Perpustakaan');
    $spreadsheet->setActiveSheetIndex(0);

    $filename = 'Laporan-Transaksi.xlsx';

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