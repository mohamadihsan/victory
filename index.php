<?php
// route untuk manage user pegawai
session_start();
$menu       = isset($_GET['menu']) ? $_GET['menu']: '';
$sub        = isset($_GET['sub']) ? $_GET['sub']: '';
$base_url   = 'http://127.0.0.1/victory/';
$url_api    = 'http://127.0.0.1/victory/action/';

// load _header
include_once '_header.php';

// load content
switch ($menu) {

    case 'tracking':
        include_once 'users/pelanggan/tracking.php';
    break;

    default:
        include_once 'users/pelanggan/tracking.php';
        break;
}

// load footer
include_once '_footer.php';

?>
