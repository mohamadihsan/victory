<?php
// route untuk manage user pegawai

session_start();

$bagian = strtolower(isset($_SESSION['bagian']) ? $_SESSION['bagian'] : '');
//$bagian 	= 'pemilik';
$menu 		= isset($_GET['menu']) ? $_GET['menu']: '';
$sub 		= isset($_GET['sub']) ? $_GET['sub']: '';
$base_url 	= 'http://127.0.0.1/victory/';
$url_api 	= 'http://127.0.0.1/victory/action/';

if ($bagian!='') {
	// load _header
	include_once '../users/_header.php';
}

switch ($bagian) {

	case 'administrator':
			include_once '../users/administrator/_sidebar.php';
			// load content
			switch ($menu) {

				case 'pengguna':
					include_once '../users/administrator/pengguna.php';
					break;

				default:
					include_once '../users/administrator/beranda.php';
					break;
			}
		break;

	default:
			include_once '../users/general-pages/login_administrator.php';
		break;
}

if ($bagian!='') {
	// load footer
	include_once '../users/_footer.php';
}

?>
