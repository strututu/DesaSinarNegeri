<?php
require_once __DIR__ . '/../../src/config/db.php';
require_once __DIR__ . '/../../src/lib/auth.php';
require(__DIR__ . '/../../src/vendor/fpdf/fpdf.php');
require_login();

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM residents WHERE id = ?");
$stmt->execute([$id]);
$d = $stmt->fetch();

if (!$d) die("Data warga tidak ditemukan.");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'PEMERINTAH DESA SINAR SEGERI',0,1,'C');
$pdf->SetFont('Arial','U',12);
$pdf->Cell(0,6,'SURAT KETERANGAN TIDAK MAMPU (SKTM)',0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,8,"Yang bertanda tangan di bawah ini menerangkan bahwa:");
$pdf->Cell(40,8,"Nama"); $pdf->Cell(0,8,": " . $d['nama'], 0, 1);
$pdf->Cell(40,8,"NIK"); $pdf->Cell(0,8,": " . $d['nik'], 0, 1);
$pdf->Cell(40,8,"Pekerjaan"); $pdf->Cell(0,8,": Buruh Harian Lepas", 0, 1); // Bisa disesuaikan
$pdf->Cell(40,8,"Alamat"); $pdf->Cell(0,8,": " . $d['alamat'], 0, 1);
$pdf->Ln(5);
$pdf->MultiCell(0,8,"Adalah benar warga desa kami yang tergolong Keluarga Tidak Mampu / Miskin.");
$pdf->Ln(10);
$pdf->Cell(0,8,"Surat ini dibuat untuk persyaratan pengajuan bantuan.",0,1);

$pdf->Ln(20);
$pdf->Cell(120);
$pdf->Cell(0,6,"Sinar Segeri, " . date('d-m-Y'), 0, 1, 'C');
$pdf->Cell(120);
$pdf->Cell(0,6,"Kepala Desa", 0, 1, 'C');
$pdf->Ln(20);
$pdf->Cell(120);
$pdf->Cell(0,6,"( ........................ )", 0, 1, 'C');

$pdf->Output();
?>