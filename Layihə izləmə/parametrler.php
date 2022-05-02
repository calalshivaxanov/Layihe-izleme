<?php 
include 'header.php';
if (vezifekontrol()!="vezifeli") {
	header("location:index.php?durum=izinsiz");
	exit;
};
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<script type="text/javascript">
	var genislik = $(window).width()   
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>
<div class="container">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">Sayt parametrləri</h5>   
		</div>
		<div class="card-body">
			<form action="islemler/islem.php" method="POST" enctype="multipart/form-data" data-parsley-validate>		
				<div class="form-row mb-3">
					<div class="file-loading">
						<input class="form-control" id="sitelogosu" name="sayt_logo" type="file">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Sayt Başlığı</label>
						<input type="text" required class="form-control" name="sayt_basliq" value="<?php echo $ayarcek['sayt_basliq'] ?>" placeholder="Site Başlığı">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Sayt Açıqlaması</label>
						<input type="text" required class="form-control" name="sayt_aciqlama" value="<?php echo $ayarcek['sayt_aciqlama'] ?>" placeholder="Sayt Açıqlaması (Ən çox 250 Simvol)">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label>Sayt Sahibi</label>
						<input type="text" required class="form-control" name="sayt_sahibi" value="<?php echo $ayarcek['sayt_sahibi'] ?>" placeholder="Site Sahibi">
					</div>
				</div>

				<button type="submit" name="genelparamsave" class="btn btn-primary">Save</button>
			</form>	

		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		$("#sitelogosu").fileinput({
			'theme': 'explorer-fas',
			'showUpload': false,
			minFileSize: 5,
			allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip"],
			initialPreview: [
			"<img src='<?php echo $ayarcek['sayt_logo'] ?>' style='height:90px' class='file-preview-image' alt='Logo' title='Logo'>"
			],
		});
	});
</script>
<script type="text/javascript">
	function parametrlerisave() {
		$.ajax({
        type: 'POST',   //post olarak belirledik
        url: 'islemler/mail.php',  //formdaki verilerin gidecegi adres
        data: $('form#mailformu').serialize(), //#form id li formumuzu bilesenlerine ayirdik
        success: function(gelen) { //islem basarili oldugunda yapilacak
        	$('#sonuc').html(gelen);
        }
    });
	}
</script>﻿
<?php include 'footer.php' ?>

<?php if (@$_GET['durum']=="no")  {?>  
	<script>
		Swal.fire({
			type: 'error',
			title: 'İşləm Uğursuz',
			text: 'Lütfən Təkrar Yoxlayın',
			showConfirmButton: true,
			confirmButtonText: 'Bağla'
		})
	</script>
<?php } ?>

<?php if (@$_GET['durum']=="ok")  {?>  
	<script>
		Swal.fire({
			type: 'success',
			title: 'İşlem Uğurli',
			text: 'İşləminiz Uğurla Yerinə Yetirildi',
			showConfirmButton: true,
			confirmButtonText: 'Bağla'
		})
	</script>
	<?php } ?>