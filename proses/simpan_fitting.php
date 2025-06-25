<?php
session_start();
require_once('../config/koneksi.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $tanggal_fitting = mysqli_real_escape_string($koneksi, $_POST['tanggal_fitting']);
    $jam_fitting = mysqli_real_escape_string($koneksi, $_POST['jam_fitting']);
    $jenis_pakaian = mysqli_real_escape_string($koneksi, $_POST['jenis_pakaian']);
    $jumlah_orang = intval($_POST['jumlah_orang']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

    $query = "INSERT INTO booking_fitting (user_id, tanggal_fitting, jam_fitting, jenis_pakaian, jumlah_orang, catatan) 
              VALUES ('$user_id', '$tanggal_fitting', '$jam_fitting', '$jenis_pakaian', '$jumlah_orang', '$catatan')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../riwayat/fitting.php?status=success");
    } else {
        header("Location: ../form/fitting.php?status=error");
    }
} else {
    header("Location: ../form/fitting.php");
}
