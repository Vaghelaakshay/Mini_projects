<?php
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;


$text = $_POST["text"];
$img = $_POST["qr"];
// Create a basic QR code
$qrCode = QrCode::create($text);

// Set additional options
$qrCode->setSize(300);

// Create a writer instance
$writer = new PngWriter();

// Write the QR code to a file
$result = $writer->write($qrCode);
//echo $result->getString();
$result->saveToFile(__DIR__ . '/'.$img.'.png');
if (file_exists('./'.$img.'.png')) {
    echo "QR code generated successfully!<br>"; 
    echo'<img src="./'.$img.'.png"><br>';
    echo"<a href='index.php'>back</a>";
}else{
    echo"error";
}
