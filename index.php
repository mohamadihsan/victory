<?php

$menu       = isset($_GET['menu']) ? $_GET['menu']: '';
$sub        = isset($_GET['sub']) ? $_GET['sub']: '';
$base_url   = 'http://pt-ivg-purwakarta.com/';
$url_api    = 'http://pt-ivg-purwakarta.com/action/';


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
