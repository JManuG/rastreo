<?php
ini_set ("display_errors","1" );
error_reporting(E_ALL);
include('../model/model_con.php');
require('../lib/fpdf16/fpdf.php');

//$vineta="100028";
$vineta = $_GET['v'];
$cab=new model_con();

$pdf = new FPDF('P','mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
//$pdf->Cell(40,10,'Hello World!');
$pdf->SetFont('times','',8);
//ACUSE 1
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 10, 198, 14, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 25, 198, 29, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 55, 198, 80, 1.5, 'DF');

//ACUSE 2
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 145, 198, 14, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 160, 198, 29, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 190, 198, 80, 1.5, 'DF');

//Logo
$pdf->Image('../vista/imgs/g&t_logo.jpg',10,12,12,10);
$pdf->Image('../vista/imgs/g&t_logo.jpg',10,147,12,10);

//Encabezados
$pdf->SetFillColor(0,0,0);
$pdf->Code128(151,12,$vineta,43,9);
$pdf->Code128(151,147,$vineta,43,9);
$pdf->SetFont('Arial','B',16);
$pdf->SetFont('times','',14);
$pdf->Text(30,18,'VOUCHER DE ENCOMIENDA');
$pdf->Text(30,153,'VOUCHER DE ENCOMIENDA');

//Textos 1
$pdf->SetFont('Arial','B',16);
$pdf->SetFont('times','',11);
$pdf->Text(10,31,'Trasaccion: ');
$pdf->Text(10,37,'Remitente: ');
$pdf->Text(10,43,'Sede: ');
//$pdf->Text(10,49,'Direccion: ');
$pdf->Text(130,31,'Fecha y hora: ');
$pdf->Text(130,37,'Nivel/Extension: ');
$pdf->Text(130,43,'Departamento: ');
//
$pdf->Text(10,166,'Trasaccion: ');
$pdf->Text(10,172,'Remitente: ');
$pdf->Text(10,178,'Sede: ');
$pdf->Text(10,184,'Direccion: ');
$pdf->Text(130,166,'Fecha y hora: ');
$pdf->Text(130,172,'Nivel/Extension: ');
$pdf->Text(130,178,'Departamento: ');

//Textos 2
$pdf->Text(10,62,'Destinatario: ');
$pdf->Text(10,68,'Prioridad: ');
$pdf->Text(10,75,'Destino:');
$pdf->Text(10,82,'Direccion: ');
$pdf->Text(10,89,'Descripcion de la encomienda: ');
//$pdf->Text(130,62,'Zona: ');
//$pdf->Text(130,68,'Tipo de gestion: ');
//
$pdf->Text(10,198,'Destinatario: ');
$pdf->Text(10,205,'Prioridad: ');
$pdf->Text(10,212,'Destino: ');
$pdf->Text(10,219,'Direccion: ');
$pdf->Text(10,226,'Descripcion de la encomienda: ');
//$pdf->Text(130,198  ,'Zona: ');
//$pdf->Text(130,205,'Tipo de gestion: ');

//Llenando Variables
$stmt=$cab->data_acuse2($vineta);

while ($row=$stmt->fetch(PDO::FETCH_NUM))
{
    $barra=$row[0];
    $tipo_envio=$row[1];
    $nombre_destinatario=$row[2];
    $ccosto=$row[3];
    $nombre_ccosto=$row[4];
    $direccion=utf8_decode($row[5]);
    $agencia=$row[6];
    $descripcion=utf8_decode($row[7]);
    $categoria=$row[8];
}


$stmt1=$cab->data_acuse($vineta);

while ($row1=$stmt1->fetch(PDO::FETCH_NUM))
{
    $ori_ccosto     =$row1[1];
    $age_ori        =$row1[2];
    $ori_ccosto_nombre=$row1[3];
    $des_ccosto     =$row1[4];
    $age_des        =$row1[5];
    $usr_ori        =utf8_decode($row1[7]);
    $ccDirOri       =$row1[14];
    $fecha_datetime =$row1[9];
}


//Comepletando informacion
$pdf->Text(30,31,$vineta);
$pdf->Text(30,37,$usr_ori);
$pdf->Text(30,43,$ori_ccosto_nombre);
$pdf->Text(30,49,$ccDirOri);
$pdf->Text(160,31,$fecha_datetime);
$pdf->Text(160,37,'');
$pdf->Text(160,43,'');
//
$pdf->Text(30,166,$vineta);
$pdf->Text(30,172,$usr_ori);
$pdf->Text(30,178,$ori_ccosto_nombre);
$pdf->Text(30,184,$ccDirOri);
$pdf->Text(160,166,$fecha_datetime);
$pdf->Text(160,172,'');
$pdf->Text(160,178,'');

$pdf->Text(30,62,$nombre_destinatario);
$pdf->Text(30,68,$categoria);
$pdf->Text(30,75,$ccosto." ".$nombre_ccosto);
$pdf->Text(30,82,$direccion);
$pdf->Text(60,89,$descripcion);
$pdf->Text(160,62,'');
$pdf->Text(160,68,'');

$pdf->Text(30,198,$nombre_destinatario);
$pdf->Text(30,205,$categoria);
$pdf->Text(30,212,$ccosto." ".$nombre_ccosto." ".$agencia);
$pdf->Text(30,219,$direccion);
$pdf->Text(60,226,$descripcion);
$pdf->Text(160,198,'');
$pdf->Text(160,205,'');

$pdf->Output('Acuse.pdf','I');