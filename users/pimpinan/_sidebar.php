<div id="sidebar" class="sidebar responsive ace-save-state">
	<script type="text/javascript">
		try{ace.settings.loadState('sidebar')}catch(e){}
	</script>

	<ul class="nav nav-list">
		<li class="<?php if($menu=='') echo "active"; ?>">
			<a href="./">
				<i class="menu-icon fa fa-home"></i>
				<span class="menu-text"> Beranda </span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="<?php if($menu=='pengadaan') echo "active"; ?>">
			<a href="./index.php?menu=pengadaan">
				<i class="menu-icon fa fa-file-text-o"></i>
				<span class="menu-text"> Pengadaan Bahan</span>
			</a>

			<b class="arrow"></b>
		</li>

		<li class="<?php if($menu=='pengeluaran' OR $menu=='pengiriman') echo "active open"; ?>">
				<a href="#" class="dropdown-toggle">
						<i class="menu-icon fa fa-cube"></i>
						<span class="menu-text">
								Penjualan
						</span>

						<b class="arrow fa fa-angle-down"></b>
				</a>

				<b class="arrow"></b>

				<ul class="submenu">
						<li class="<?php if($menu=='pengeluaran') echo "active"; ?>">
							<a href="./index.php?menu=pengeluaran">
								<i class="menu-icon fa fa-file-text-o"></i>
								<span class="menu-text"> Pengeluaran Produk</span>
							</a>

							<b class="arrow"></b>
						</li>

						<li class="<?php if($menu=='pengiriman') echo "active open"; ?>">
								<a href="#" class="dropdown-toggle">
										<i class="menu-icon fa fa-truck"></i>
										<span class="menu-text">
												Distribusi
										</span>

										<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>
								<ul class="submenu">
										<li class="<?php if($menu=='pengiriman') echo "active"; ?>">
											<a href="./index.php?menu=pengiriman">
												<i class="menu-icon fa fa-file-text-o"></i>
												<span class="menu-text"> Pengiriman Produk</span>
											</a>

											<b class="arrow"></b>
										</li>
								</ul>
						</li>
				</ul>
		</li>

	</ul><!-- /.nav-list -->

	<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
		<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
	</div>
</div>
