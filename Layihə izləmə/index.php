
<?php 
include 'header.php';
?>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css" media="screen">
	@media only screen and (max-width: 700px) {
		.mobilgizle {
			display: none;
		}
		.mobilgizleexport {
			display: none;
		}
		.mobilgoster {
			display: block;
		}
	}
	@media only screen and (min-width: 700px) {
		.mobilgizleexport {
			display: flex;
		}
		.mobilgizle {
			display: block;
		}
		.mobilgoster {
			display: none;
		}
	}
</style>
<script type="text/javascript">
	var genislik = $(window).width()   
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>
<div class="container-fluid p-2">
	<div class="row" style="margin-bottom: -20px;">

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$layihesayisor=$db->prepare("SELECT layihe_id FROM layihe");
		$layihesayisor->execute();
		$layihesayisi = $layihesayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Toplam <b>Layihə</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $layihesayisi; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$layihe_biten_sayi_sor=$db->prepare("SELECT layihe_id FROM layihe WHERE layihe_durum='Bitdi'");
		$layihe_biten_sayi_sor->execute();
		$layihe_biten_sayi_cek = $layihe_biten_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bitən <b>Layihe</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $layihe_biten_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php 
		$layihesayisor=$db->prepare("SELECT layihe_id FROM layihe WHERE layihe_tecili='Təcili'");
		$layihesayisor->execute();
		$layihesayisi = $layihesayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Təcili <b>layihə</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $layihesayisi; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$layihesayisor=$db->prepare("SELECT layihe_id FROM layihe WHERE layihe_tecili='Tələsmə Hələ'");
		$layihesayisor->execute();
		$layihesayicek = $layihesayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Önəmsiz <b>layihə</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $layihesayicek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>

	<hr style="margin-bottom: 15px !important;">

	<div class="row">
		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$sifarissayisor=$db->prepare("SELECT sifaris_id FROM sifaris");
		$sifarissayisor->execute();
		$sifarissayisicek = $sifarissayisor->rowCount();
		?>


	

		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Toplam <b>Sifariş</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $sifarissayisicek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-list fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$sifaris_biten_sayi_sor=$db->prepare("SELECT sifaris_id FROM sifaris WHERE sifaris_durum='Bitdi'");
		$sifaris_biten_sayi_sor->execute();
		$sifaris_biten_sayi_cek = $sifaris_biten_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-success shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bitən <b>Sifariş</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $sifaris_biten_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-check fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
		<!-- Earnings (Monthly) Card Example -->
		

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$sifarissayisor=$db->prepare("SELECT sifaris_id FROM sifaris WHERE sifaris_tecili='Acil'");
		$sifarissayisor->execute();
		$sifarissayicek = $sifarissayisor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-danger shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Təcili <b>Sifariş</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $sifarissayicek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-plus fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Earnings (Monthly) Card Example -->
		<?php 
		$sifaris_biten_sayi_sor=$db->prepare("SELECT sifaris_id FROM sifaris  WHERE sifaris_tecili='Acelesi Yok'");
		$sifaris_biten_sayi_sor->execute();
		$sifaris_biten_sayi_cek = $sifaris_biten_sayi_sor->rowCount();
		?>
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Önəmsiz <b>Sifariş</b> Sayı</div>
							<div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $sifaris_biten_sayi_cek; ?></div>
						</div>
						<div class="col-auto">
							<i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>


	<!--layiheler Giriş-->
	<div class="row">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary text-center">Layihələr</h5>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr> 
									<th>Başlıq</th>
									<th>Bitiş Tarixi</th>
									<th>Təcili</th>
									
								</tr>
							</thead>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
							<tbody>
								<?php 
								$say=0;
								$layihesor=$db->prepare("SELECT * FROM layihe ORDER BY layihe_id DESC");
								$layihesor->execute();
								while ($layihecek=$layihesor->fetch(PDO::FETCH_ASSOC)) { $say++?>

									<tr>
										<td><?php echo $layihecek['layihe_basliq']; ?></td>
										<td><?php echo $layihecek['layihe_teslim_tarixi']; ?></td>
										<td><?php 
										if ($layihecek['layihe_tecili']=="Təcili") {
											echo '<span class="badge badge-danger" style="font-size:1rem">Təcili</span>';
										} else {
											echo $layihecek['layihe_tecili'];
										}
										?></td>

									</tr>
								<?php } ?>
							</tbody>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header py-3 text-center">
					<h5 class="m-0 font-weight-bold text-primary">Sifarişlər</h5>
				</div>
				<div class="card-body" style="width: 100%">

					<div class="table-responsive">
						<table class="table table-bordered" id="sifaristablosu" width="100%" cellspacing="0">
							<thead>
								<tr> 
									<th>Adı</th>
									<th>Bitiş Tarixi</th>
									<th>Təcili</th>

								</tr>
							</thead>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
							<tbody>
								<?php 
								$sifarissor=$db->prepare("SELECT * FROM sifaris ORDER BY sifaris_id DESC");
								$sifarissor->execute();
								while ($sifariscek=$sifarissor->fetch(PDO::FETCH_ASSOC)) { $say++?>

									<tr>
										<td><?php echo $sifariscek['musteri_ad']; ?></td>										
										<td><?php echo $sifariscek['sifaris_teslim_tarixi']; ?></td>
										<td><?php 
										if ($sifariscek['sifaris_tecili']=="Təcili") {
											echo '<span class="badge badge-danger" style="font-size:1rem">Təcili</span>';
										} else {
											echo $sifariscek['sifaris_tecili'];
										}
										?></td>
									</tr>
								<?php }
								?>
							</tbody>
							<!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>



</div>
<!--layiheler Çıkış-->

</div>


<?php 
include 'footer.php';
?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script> 
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>
<script type="text/javascript">
	$("#aktarmagizleme").click(function(){
		$(".dt-buttons").toggle();
	});
</script>
<script type="text/javascript">
	$(".mobilgoster").click(function(){
		$(".gizlemeyiac").toggle();
	});
</script>

<script>
	var dataTables = $('#dataTable').DataTable({
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<script>
	var dataTables = $('#sifaristablosu').DataTable({
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
    dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
});
</script>

<?php 
if (isset($_GET['durum'])) {?>
	<?php if ($_GET['durum']=="izinsiz")  {?>	
		<script>
			Swal.fire({
				type: 'error',
				title: 'İcazəniz Yoxdur',
				text: 'Girmə İcazəniz olmayan bir yerə daxil olmağa çalışdınız. Ayıb olsun',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } ?>
	<?php if ($_GET['durum']=="ok")  {?>	
		<script>
			Swal.fire({
				type: 'success',
				title: 'İşləm Uğurlu',
				text: 'İşləminiz Uğurla Gerçəkləşdirildi',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } } ?>
