<?php
session_start();
require_once('../config/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $jenis_bahan = mysqli_real_escape_string($koneksi, $_POST['jenis_bahan']);
    $warna = mysqli_real_escape_string($koneksi, $_POST['warna']);
    $jumlah = floatval($_POST['jumlah']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

    $query = "INSERT INTO pemesanan_bahan (user_id, jenis_bahan, warna, jumlah, satuan, catatan) 
              VALUES ('$user_id', '$jenis_bahan', '$warna', '$jumlah', '$satuan', '$catatan')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../riwayat/pemesanan.php?status=success");
    } else {
        header("Location: ../form/pemesanan.php?status=error");
    }
} else {
    header("Location: ../form/pemesanan.php");
}
