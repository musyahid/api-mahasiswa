<?php
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once('app/Mahasiswa.php');

$mahasiswa = new Mahasiswa;

$nim = $_GET['nim'];
$masa = $_GET['masa'];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->mergeCells('A1:I1');

$sheet->setCellValue('A1', 'Data Billing Mahasiswa NIM '.$nim. ' Masa '.$masa);
$spreadsheet->getActiveSheet()->getStyle('A1:I2')->getFont()->setBold(true);

$sheet->getStyle('A1:I12')->getAlignment()->setHorizontal('center');


$sheet->setCellValue('A2', 'NIM')->getColumnDimension('A')->setWidth(15);
$sheet->setCellValue('B2', 'Masa');
$sheet->setCellValue('C2', 'Nomor Billing')->getColumnDimension('C')->setWidth(25);
$sheet->setCellValue('D2', 'Tanggal Setor')->getColumnDimension('D')->setWidth(15);
$sheet->setCellValue('E2', 'Total SKS');
$sheet->setCellValue('F2', 'Total Bayar')->getColumnDimension('F')->setWidth(15);
$sheet->setCellValue('G2', 'Jenis Bayar')->getColumnDimension('G')->setWidth(20);
$sheet->setCellValue('H2', 'Status Billing')->getColumnDimension('H')->setWidth(20);
$sheet->setCellValue('I2', 'Status Pembayaran')->getColumnDimension('I')->setWidth(25);

// Get the highest column index (e.g., 'C')
$highestColumn = $sheet->getHighestColumn();

// Set border for all columns
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
$sheet->getStyle('A2:' . $highestColumn . '2')->applyFromArray($styleArray);

$hasil = $mahasiswa->getBillingByNomorBillingDanMasa($nim, $masa);

$count = 3;
foreach($hasil['dataPribadi'] as $row){
    $spreadsheet->getActiveSheet()->fromArray(array(
		$row['nim'], 
		$row['masa']['masa'],
		$row['nobilling'],
		$row['tanggal_setor'],
		$row['total_sks'],
		$row['total_bayar'],
		$row['jenis_bayar']['keterangan'],
		$row['status_billing']['keterangan'],
		$row['status_pembayaran']['keterangan']
	), null, 'A'.$count)->getStyle('A'.$count.':' . $highestColumn . $count)->applyFromArray($styleArray);
    $count++;
}


$writer = new Xlsx($spreadsheet);

// Set headers to force download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data-billing-mahasiswa.xlsx"');
header('Cache-Control: max-age=0');

// Send the file to the browser
$writer->save('php://output');
?>