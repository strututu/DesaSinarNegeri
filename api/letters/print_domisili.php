<?php
require_once __DIR__ . '/../../src/config/db.php';
require_once __DIR__ . '/../../src/lib/auth.php';
require_login();

// Ini baris kuncinya. Kalau folder fpdf salah tempat, baris ini error.
require(__DIR__ . '/../../src/vendor/fpdf/fpdf.php');

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM residents WHERE id = ?");
$stmt->execute([$id]);
$d = $stmt->fetch();

if (!$d) die("Data warga tidak ditemukan.");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'PEMERINTAH DESA SINAR SEGERI',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Ln(5);
$pdf->Cell(0,6,'SURAT KETERANGAN DOMISILI',0,1,'C');
$pdf->Ln(10);

$pdf->MultiCell(0,8,"Kepala Desa Sinar Segeri menerangkan bahwa saudara/i:");
$pdf->Cell(40,8,"Nama"); $pdf->Cell(0,8,": " . $d['nama'], 0, 1);
$pdf->Cell(40,8,"NIK"); $pdf->Cell(0,8,": " . $d['nik'], 0, 1);
$pdf->Cell(40,8,"Alamat"); $pdf->Cell(0,8,": " . $d['alamat'], 0, 1);
$pdf->Ln(10);
$pdf->MultiCell(0,8,"Adalah benar penduduk yang berdomisili di desa kami.");

$pdf->Output();
?>