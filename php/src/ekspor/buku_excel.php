<?php 
    require("../vendor/autoload.php");
    require("../koneksi.php");

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $query = 'SELECT * FROM tbbuku ORDER BY idbuku';
    $q_tampil_buku = mysqli_query($db, $query);

    $spreadsheet = new Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Data Buku')
                ->setCellValue('A3', 'No')
                ->setCellValue('B3', 'ID Buku')
                ->setCellValue('C3', 'Judul')
                ->setCellValue('D3', 'ID Kategori')
                ->setCellValue('E3', 'Pengarang')
                ->setCellValue('F3', 'Penerbit')
                ->setCellValue('G3', 'Tahun')
                ->setCellValue('H3', 'Jumlah');

    $sheet = $spreadsheet->getActiveSheet();

    $index = 4;
    $nomor = 0;

    if (mysqli_num_rows($q_tampil_buku) > 0) {
        while ($r_tampil_buku = mysqli_fetch_array($q_tampil_buku)) {
            $nomor++;
            $sheet->setCellValue('A'.$index, $nomor);
            $sheet->setCellValue('B'.$index, $r_tampil_buku['idbuku']);
            $sheet->setCellValue('C'.$index, $r_tampil_buku['judul']);
            $sheet->setCellValue('D'.$index, $r_tampil_buku['kategori']);
            $sheet->setCellValue('E'.$index, $r_tampil_buku['pengarang']);
            $sheet->setCellValue('F'.$index, $r_tampil_buku['penerbit']);
            $sheet->setCellValue('G'.$index, $r_tampil_buku['tahun']);
            $sheet->setCellValue('H'.$index, $r_tampil_buku['jumlah']);
            $index++;
        }
    }

    $sheet->setTitle('Data Buku Perpustakaan');
    $spreadsheet->setActiveSheetIndex(0);

    $filename = 'Data-Buku.xlsx';

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