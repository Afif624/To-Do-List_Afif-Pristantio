<?php 
$dbHost = 'localhost';
$dbName = 'kegiatan';
$dbUsername = 'root';
$dbPassword = '';

$mysqli = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);
if (!$mysqli) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
?>