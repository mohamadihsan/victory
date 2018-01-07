<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>

		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<style media="screen">
			/* @import url('https://fonts.googleapis.com/css?family=Cookie');
			@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,600,700');
			@import url('https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'); */

			*{margin:0px;padding:0px;}
			body{
			background: url('assets/images/bg-login.jpg') no-repeat center center fixed;
			}
			.navigation {
			background-color:#333;
			width:100%;
			height:50px;
			box-shadow: 0px 1px 1px #c8c8c8;
			line-height:50px;
			color:#FFF;
			}
			.container {
			width:760px;
			margin:auto;
			position: relative;
			}
			.title {
			font-family:'Century Gothic';
			font-size:32px;
			cursor: pointer;
			}
			.search-control{
			font-family:'Open Sans';
			position: absolute;
			right:0;
			cursor: pointer;
			color: #bbb;
			}
			.search-control:hover {color:#686868;}
			.fa-home {
			font-size:22px;
			}
			.search-box {
			width:100%;
			position: relative;
			top:48px;
			height:48px;
			transition:opacity 0.4s linear ,visibility 0.4s linear 0s;
			}
			.search-box > #search {
			width:640px;
			height:48px;
			border-radius:6px 0px 0px 6px;
			box-shadow:none;
			box-shadow: 1px 2px 2px #ddd;
			}
			input , input:focus {
			border:none;
			box-shadow:none;
			background-color:none;
			outline: 0;
			font-size:16px;
			font-family:'Century';
			color:#bbb;
			padding:0px 12px;
			}
			.also {
			font-family:'fontawesome';
			color:#bbb;
			display:inline-block;
			background-color:#fff;
			height:48px;
			width:48px;
			line-height: 48px;
			text-align: center;
			cursor: pointer;
			border-left:1px solid #ddd;
			position: absolute;
			top:0;
			box-shadow: 1px 2px 2px #ddd;
			}
			.search-link:hover {color:#686868;}
			.setting {
			border-radius:0px 6px 6px 0px;
			margin-left:48px;
			font-size:18px;
			}
			.setting:hover {color:#686868;}

			.hasil{
				width: 715px;
				height: 100%;
				background-color: #fff;
				padding-bottom: 30px;
			}
		</style>
		<script type="text/javascript">
			var SearchControl = document.getElementById('SBox');
			var ColorChange = document.getElementById('color');

			function searchbox(num) {
				if(num == "1"){
				SearchControl.style.visibility = "visible";
				SearchControl.style.opacity = "1";
				} else if(num == "0") {
				SearchControl.style.visibility = "hidden";
				SearchControl.style.opacity = "0";
				}
			}
		</script>
	</head>
	<body>
