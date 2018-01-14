<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css" /> -->
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />

		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<!-- gritter notification -->
		<link rel="stylesheet" href="../assets/css/jquery.gritter.min.css" />

        <style media="screen">
			html {
				background: url('../assets/images/bg-login.jpg') no-repeat center center fixed;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				overflow: hidden;
			}

			img{
				display: block;
				margin: auto;
				width: 100%;
				height: auto;
			}

			#login-button{
				cursor: pointer;
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				padding: 30px;
				margin: auto;
				width: 100px;
				height: 100px;
				border-radius: 50%;
				background: rgba(3,3,3,.8);
				overflow: hidden;
				opacity: 0.4;
				box-shadow: 10px 10px 30px #000;
			}

			/* Login container */
			#container{
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				margin: auto;
				width: 300px;
				height: 400px;
				border-radius: 5px;
				background: rgba(3,3,3,0.25);
				box-shadow: 1px 1px 50px #000;
			}

			.close-btn{
				position: absolute;
				cursor: pointer;
				font-family: 'Open Sans Condensed', sans-serif;
				line-height: 18px;
				top: 3px;
				right: 3px;
				width: 20px;
				height: 20px;
				text-align: center;
				border-radius: 10px;
				opacity: .2;
				-webkit-transition: all 2s ease-in-out;
				-moz-transition: all 2s ease-in-out;
				-o-transition: all 2s ease-in-out;
				transition: all 0.2s ease-in-out;
			}

			.close-btn:hover{
				opacity: .5;
			}

			/* Heading */
			h1{
				font-family: 'Open Sans Condensed', sans-serif;
				position: relative;
				margin-top: 0px;
				text-align: center;
				font-size: 40px;
				color: #ddd;
				text-shadow: 3px 3px 10px #000;
			}

			h3{
				font-family: 'Open Sans Condensed', sans-serif;
				position: relative;
				margin-top: 0px;
				text-align: center;
				font-size: 24px;
				color: #ddd;
				text-shadow: 3px 3px 10px #000;
			}

			/* Inputs */
			.btn-login,
			input{
				font-family: 'Open Sans Condensed', sans-serif;
				text-decoration: none;
				position: relative;
				width: 80%;
				display: block;
				margin: 9px auto;
				font-size: 17px;
				color: #fff;
				padding: 8px;
				border-radius: 6px;
				border: none;
				background: rgba(3,3,3,.1);
				-webkit-transition: all 2s ease-in-out;
				-moz-transition: all 2s ease-in-out;
				-o-transition: all 2s ease-in-out;
				transition: all 0.2s ease-in-out;
			}

			input:focus{
				outline: none;
				box-shadow: 3px 3px 10px #333;
				background: rgba(3,3,3,.18);
			}

			/* Placeholders */
			::-webkit-input-placeholder {
			color: #ddd;  }
			:-moz-placeholder { /* Firefox 18- */
			color: red;  }
			::-moz-placeholder {  /* Firefox 19+ */
			color: red;  }
			:-ms-input-placeholder {
			color: #333;  }

			/* Link */
			.btn-login{
				font-family: 'Open Sans Condensed', sans-serif;
				text-align: center;
				padding: 4px 8px;
				background: #D15B47;
			}

			.btn-login:hover{
				opacity: 0.7;
			}

			#remember-container{
				position: relative;
				margin: -5px 20px;
			}

			.checkbox {
				position: relative;
				cursor: pointer;
				-webkit-appearance: none;
				padding: 5px;
				border-radius: 4px;
				background: rgba(3,3,3,.2);
				display: inline-block;
				width: 16px;
				height: 15px;
			}

			.checkbox:checked:active {
				box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
			}

			.checkbox:checked {
				background: rgba(3,3,3,.4);
				box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.5);
				color: #fff;
			}

			.checkbox:checked:after {
				content: '\2714';
				font-size: 10px;
				position: absolute;
				top: 0px;
				left: 4px;
				color: #fff;
			}

			#remember{
				position: absolute;
				font-size: 13px;
				font-family: 'Hind', sans-serif;
				color: rgba(255,255,255,.5);
				top: 7px;
				left: 20px;
			}

			#forgotten{
				position: absolute;
				font-size: 12px;
				font-family: 'Hind', sans-serif;
				color: rgba(255,255,255,.2);
				right: 0px;
				top: 8px;
				cursor: pointer;
				-webkit-transition: all 2s ease-in-out;
				-moz-transition: all 2s ease-in-out;
				-o-transition: all 2s ease-in-out;
				transition: all 0.2s ease-in-out;
			}

			#forgotten:hover{
				color: rgba(255,255,255,.6);
			}

			#forgotten-container{
				position: absolute;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				margin: auto;
				width: 260px;
				height: 180px;
				border-radius: 10px;
				background: rgba(3,3,3,0.25);
				box-shadow: 1px 1px 50px #000;
			}

			.orange-btn{
				background: rgba(87,198,255,.5);
			}
		</style>
		<script type="text/javascript">
			$('#login-button').click(function(){
			  	$('#login-button').fadeOut("slow",function(){
					$("#container").fadeIn();
					TweenMax.from("#container", .4, { scale: 0, ease:Sine.easeInOut});
					TweenMax.to("#container", .4, { scale: 1, ease:Sine.easeInOut});
			  	});
			});

			$(".close-btn").click(function(){
			  	TweenMax.from("#container", .4, { scale: 1, ease:Sine.easeInOut});
			  	TweenMax.to("#container", .4, { left:"0px", scale: 0, ease:Sine.easeInOut});
			  	$("#container, #forgotten-container").fadeOut(800, function(){
					$("#login-button").fadeIn(800);
			  	});
			});

			/* Forgotten Password */
			$('#forgotten').click(function(){
			  	$("#container").fadeOut(function(){
					$("#forgotten-container").fadeIn();
			  	});
			});
        </script>
    </head>
    <body>
		<div class='login'>
			<?php
			if (empty($_GET['lupa-katasandi'])) {
				?>
				<div id="container">
					<h3>PT.Indonesia</h3>
				  	<img src="../assets/images/logo.png" alt="" width="" height="">
					<h3>Garment</h3>
					<form method="post" action="../action/login.php">
						<input type="hidden" name="log_user" value="pgw" placeholder="">
					    <input type="text" name="nama_pengguna" placeholder="Nama Pengguna" required autofocus>
					    <input type="password" name="kata_sandi" placeholder="Kata sandi" required>
					    <button type="submit" class="btn-login">Log in</button>
					    <div id="remember-container">
					      	<!-- <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/> -->
					      	<!-- <span id="remember">Remember me</span> -->
					      	<span id="forgotten"><a href="index.php?lupa-katasandi=true" style="color:#fff">Lupa Katasandi</a></span>
					    </div>
					</form>
				</div>
				<?php
			}else{
				?>
				<!-- Forgotten Password Container -->
				<div id="container">
					<h3>PT.Indonesia</h3>
				  	<img src="../assets/images/logo.png" alt="" width="" height="">
					<h3>Garment</h3>

					<!-- <span style="color:#fff;font-weight:bold""><left>Lupa Kata Sandi</left></span> -->
				 	<form method="post" action="../action/lupa_kata_sandi.php" class="">
						<input type="hidden" name="log_user" value="pgw" placeholder="">
				    	<input type="email" name="email" placeholder="E-mail" required>
				    	<button type="submit" class="btn-login">Reset Kata sandi</button>
						<div id="remember-container">
					      	<!-- <input type="checkbox" id="checkbox-2-1" class="checkbox" checked="checked"/> -->
					      	<!-- <span id="remember">Remember me</span> -->
					      	<span id="forgotten"><a href="../admin/" style="color:#fff">Kembali</a></span>
					    </div>
					</form>
				</div>
				<?php
			}
			?>

		</div>
    </body>

	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>

	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/jquery-ui.custom.min.js"></script>

	<script src="../assets/js/jquery.easypiechart.min.js"></script>
	<!-- gritter notification -->
	<script src="../assets/js/jquery.gritter.min.js"></script>

	<script>

		// LOADING SCREEN WHILE PROCESS SAVING/UPDATE/DELETE DATA
		$(document).ready(function(){

			//Callback handler for form submit event
			$(".myform").submit(function(e)
			{

			var formObj = $(this);
			var formURL = formObj.attr("action");
			var formData = new FormData(this);
			$.ajax({
				url: formURL,
				type: 'POST',
				data:  formData,
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function (){
						$("#loading").show(1000).html("<img src='../assets/images/loading.gif' height='100'>");
						},
				success: function(data, textStatus, jqXHR){
						$("#result").html(data);
						$("#loading").hide();
						$("#hapus").modal('hide');
						$('#mytable').DataTable().ajax.reload();
				},
					error: function(jqXHR, textStatus, errorThrown){
			}
			});
				e.preventDefault(); //Prevent Default action.
				e.unbind();
			});

		});
	</script>
</html>

<?php

	$gagal_login = isset($_SESSION['login'])? $_SESSION['login'] : true;
	if($gagal_login==false) {
		 ?>
	    <script type="text/javascript">
		    $(function(){
	            $.gritter.add({
	                // (string | mandatory) the heading of the notification
	                title: 'Gagal!',
	                // (string | mandatory) the text inside the notification
	                text: 'Akun anda tidak terdaftar!',
	                // (string | optional) the image to display on the left
	                image: '../assets/images/gagal.png',
	                // (bool | optional) if you want it to fade out on its own or just sit there
	                sticky: false,
	                // (int | optional) the time you want it to be alive for before fading out
	                time: ''
		        });
	        });
		</script>
		<?php
		session_unset($_SESSION['login']);
	}

	if (isset($_SESSION['pesan_berhasil'])) {
	    ?>
	    <script type="text/javascript">
	        $(function(){
	            $.gritter.add({
	                // (string | mandatory) the heading of the notification
	                title: 'Sukses!',
	                // (string | mandatory) the text inside the notification
	                text: '<?= $_SESSION['pesan_berhasil'] ?>',
	                // (string | optional) the image to display on the left
	                image: '../assets/images/berhasil.png',
	                // (bool | optional) if you want it to fade out on its own or just sit there
	                sticky: false,
	                // (int | optional) the time you want it to be alive for before fading out
	                time: ''
	            });
	        });
			console.log('berhasil');
	    </script>
	    <?php
		session_unset('pesan_berhasil');
	}else if(isset($_SESSION['pesan_gagal'])){
	    ?>
	    <script type="text/javascript">
		    $(function(){
	            $.gritter.add({
	                // (string | mandatory) the heading of the notification
	                title: 'Gagal!',
	                // (string | mandatory) the text inside the notification
	                text: '<?= $_SESSION['pesan_gagal'] ?>',
	                // (string | optional) the image to display on the left
	                image: '../assets/images/gagal.png',
	                // (bool | optional) if you want it to fade out on its own or just sit there
	                sticky: false,
	                // (int | optional) the time you want it to be alive for before fading out
	                time: ''
		        });
	        });
			console.log('gagal');
		</script>
	    <?php
		session_unset('pesan_gagal');
	}
?>
