<?php
// buka koneksi
require_once '../config/connection.php';
session_start();

// retrieve data post
$email       = mysqli_real_escape_string($conn, trim($_POST['email']));
$log_user       = mysqli_real_escape_string($conn, trim($_POST['log_user']));

if ($log_user == 'pgw') {
    // select data
    $sql = "SELECT email, nomor_induk_karyawan
            FROM pengguna
            WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // kirim Email
        $username   = $data['nomor_induk_karyawan'];
        $email      = $data['email'];
        $kata_sandi_baru = "victory".$username;
        $subject = "Lupa Kata Sandi";
        $message = "Silahkan login dengan menggunakan username : ".$username." dan kata sandi : ".$kata_sandi_baru;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        // More headers
        $headers .= 'From: mohamad_ihsan100@yahoo.co.id <noreply@mohamad_ihsan100@yahoo.co.id>'."\r\n" . 'Reply-To: '.$username.' <'.$email.'>'."\r\n";
        $headers .= 'Cc: admin@indonesiavictory.com' . "\r\n";

        $kirim = @mail($email,$subject,$message,$headers);

        if ($kirim) {

            $kata_sandi = md5($kata_sandi_baru);

            //reset kata sandi
            $sql = "UPDATE pengguna SET kata_sandi='$kata_sandi' WHERE email='$email'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['pesan_berhasil'] = "Kata sandi telah dikirim melalui email";
            }else{
                $_SESSION['pesan_gagal'] = "Gagal untuk mereset kata sandi";
            }

        }else{
            $_SESSION['pesan_gagal'] = "Gagal menghubungkan ke server";
        }

    }else{
        // jika data tidak ditemukan
        $_SESSION['pesan_gagal'] = "User tidak terdaftar!";
    }

}else if ($log_user == 'supp') {
    // select data
    $sql = "SELECT email, nomor_induk_karyawan
            FROM supplier
            WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // kirim Email
        $username   = $data['nomor_induk_karyawan'];
        $email      = $data['email'];
        $kata_sandi_baru = "victory".$username;
        $subject = "Lupa Kata Sandi";
        $message = "Silahkan login dengan menggunakan nama pengguna : ".$username." dan kata sandi : ".$kata_sandi_baru;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

        // More headers
        $headers .= 'From: mohamad_ihsan100@yahoo.co.id <noreply@mohamad_ihsan100@yahoo.co.id>'."\r\n" . 'Reply-To: '.$username.' <'.$email.'>'."\r\n";
        $headers .= 'Cc: admin@indonesiavictory.com' . "\r\n";

        $kirim = @mail($email,$subject,$message,$headers);

        if ($kirim) {

            $kata_sandi = md5($kata_sandi_baru);

            //reset kata sandi
            $sql = "UPDATE supplier SET kata_sandi='$kata_sandi' WHERE email='$email'";
            if (mysqli_query($conn, $sql)) {
                $_SESSION['pesan_berhasil'] = "Kata sandi telah dikirim melalui email";
            }else{
                $_SESSION['pesan_gagal'] = "Gagal untuk mereset kata sandi";
            }

        }else{
            $_SESSION['pesan_gagal'] = "Gagal menghubungkan ke server";
        }

    }else{
        // jika data tidak ditemukan
        $_SESSION['pesan_gagal'] = "User tidak terdaftar!";
    }
}

// arahkan ke route
header('location:../admin');
?>
