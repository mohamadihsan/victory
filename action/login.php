<?php
session_start();

// buka koneksi
require_once '../config/connection.php';

// retrieve data post
$nama_pengguna  = mysqli_real_escape_string($conn, trim($_POST['nama_pengguna']));
$kata_sandi     = md5(mysqli_real_escape_string($conn, trim($_POST['kata_sandi'])));
$log_user       = mysqli_real_escape_string($conn, trim($_POST['log_user']));

if ($log_user == 'pgw') {
    // select data
    $sql = "SELECT nomor_induk_karyawan, bagian
            FROM pengguna
            WHERE nomor_induk_karyawan='$nama_pengguna' AND kata_sandi='$kata_sandi'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // buat session pegawai
        $_SESSION['nomor_induk_karyawan'] = $data['nomor_induk_karyawan'];
        $_SESSION['nama_pegawai'] = $data['bagian'];
        $_SESSION['nama_lengkap'] = $data['bagian'];
        $_SESSION['bagian'] = $data['bagian'];
        $_SESSION['nama_pengguna'] = $data['nomor_induk_karyawan'];
        $_SESSION['login'] = TRUE;

    }else{
        // jika data tidak ditemukan
        $_SESSION['login'] = FALSE;
    }

    // arahkan ke route
    header('location:../admin/');
}else if($log_user == 'supp'){
    // select data
    $sql = "SELECT id_supplier, nama_supplier, nama_pengguna
            FROM supplier
            WHERE nama_pengguna='$nama_pengguna' AND kata_sandi='$kata_sandi'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // buat session pegawai
        $_SESSION['id_supplier'] = $data['id_supplier'];
        $_SESSION['nama_supplier'] = $data['nama_supplier'];
        $_SESSION['nama_lengkap'] = $data['nama_supplier'];
        $_SESSION['bagian'] = 'supplier';
        $_SESSION['nama_pengguna'] = $data['nama_pengguna'];
        $_SESSION['login'] = TRUE;

    }else{
        // jika data tidak ditemukan
        $_SESSION['login'] = FALSE;
    }

    // arahkan ke route
    header('location:../supplier/');
}else if($log_user == 'administrator'){
    if ($nama_pengguna == 'administrator' AND $kata_sandi == md5('admin')) {

        // buat session administrator
        $_SESSION['id_administrator'] = 'Administrator';
        $_SESSION['nama_administrator'] = 'Administrator';
        $_SESSION['nama_lengkap'] = 'Administrator';
        $_SESSION['bagian'] = 'Administrator';
        $_SESSION['login'] = TRUE;

    }else{
        // jika data tidak ditemukan
        $_SESSION['login'] = FALSE;
    }

    // arahkan ke route
    header('location:../superadmin/');
}else{
    // select data
    $sql = "SELECT id_pelanggan, nama_pelanggan, nama_pengguna
            FROM pelanggan
            WHERE nama_pengguna='$nama_pengguna' AND kata_sandi='$kata_sandi'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // buat session pegawai
        $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
        $_SESSION['nama_pelanggan'] = $data['nama_pelanggan'];
        $_SESSION['nama_lengkap'] = $data['nama_pelanggan'];
        $_SESSION['bagian'] = 'pelanggan';
        $_SESSION['nama_pengguna'] = $data['nama_pengguna'];
        $_SESSION['login'] = TRUE;

    }else{
        // jika data tidak ditemukan
        $_SESSION['login'] = FALSE;
    }

    // arahkan ke route
    header('location:../');
}


?>
