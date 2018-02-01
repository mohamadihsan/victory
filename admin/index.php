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

	case 'purchasing':
			include_once '../users/purchasing/_sidebar.php';
			// load content
			switch ($menu) {
				case 'bahan-baku':
					include_once '../users/purchasing/bahan_baku.php';
					break;

				case 'supplier':
					include_once '../users/purchasing/supplier.php';
					break;

				case 'peramalan':
					include_once '../users/purchasing/peramalan.php';
					break;

				case 'pengadaan':
					include_once '../users/purchasing/pengadaan_bahan_baku.php';
					break;

				case 'persediaan':
					include_once '../users/purchasing/persediaan.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/purchasing/beranda.php';
					break;
			}
		break;

		case 'marketing':
				include_once '../users/marketing/_sidebar.php';
				// load content
				switch ($menu) {
					case 'konsumen':
						include_once '../users/marketing/konsumen.php';
						break;

					case 'produk':
						include_once '../users/marketing/produk.php';
						break;

					case 'pemesanan':
						include_once '../users/marketing/pemesanan_produk.php';
						break;

					case 'profil':
						include_once '../users/general-pages/profil.php';
						break;

					default:
						include_once '../users/marketing/beranda.php';
						break;
				}
			break;

	case 'factory manager':
			include_once '../users/factory-manager/_sidebar.php';
			// load content
			switch ($menu) {
				case 'bahan-baku':
					include_once '../users/factory-manager/bahan_baku.php';
					break;

				case 'detail_komposisi':
					include_once '../users/factory-manager/detail_komposisi.php';
					break;

				case 'produk':
					include_once '../users/factory-manager/produk.php';
					break;

				case 'komposisi':
					include_once '../users/factory-manager/komposisi.php';
					break;

				case 'pengajuan':
					include_once '../users/factory-manager/pengajuan_kebutuhan_produksi.php';
					break;

				case 'peramalan':
					include_once '../users/factory-manager/peramalan.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/factory-manager/beranda.php';
					break;
			}
		break;

	case 'exim dan container':
			include_once '../users/exim-dan-container/_sidebar.php';
			// load content
			switch ($menu) {
				case 'penerimaan':
					include_once '../users/exim-dan-container/validasi_penerimaan_produk.php';
					break;

				case 'distribusi':
					include_once '../users/exim-dan-container/distribusi.php';
					break;

				case 'profil':
					include_once '../users/general-pages/profil.php';
					break;

				default:
					include_once '../users/exim-dan-container/beranda.php';
					break;
			}
		break;

	default:
			include_once '../users/general-pages/login_pegawai.php';
		break;
}

if ($bagian!='') {
	// load footer
	include_once '../users/_footer.php';
}

?>
