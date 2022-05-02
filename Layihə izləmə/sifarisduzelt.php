<?php 
include 'header.php' ;
if (vezifekontrol()!="vezifeli") {
	header("location:index.php?durum=izinsiz");
	exit;
}
if (isset($_POST['sifaris_id'])) {
	$kayitsor=$db->prepare("SELECT * FROM sifaris where sifaris_id=:id");
	$kayitsor->execute(array(
		'id' => guvenlik($_POST['sifaris_id'])
	));
	$kayitcek=$kayitsor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:sifarisler");
} 

?>
<!--<script src="ckeditor/ckeditor.js"></script>-->
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Sifariş Düzəltmə İşləmi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if (guvenlik($_GET['islem'])=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşləm Uğurlu</b>
								<?php } elseif (guvenlik($_GET['islem'])=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşləm Uğursuz</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST"  enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Ad Soyad</label>
									<input type="text" class="form-control" required name="musteri_ad" value="<?php echo $kayitcek['musteri_ad'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>E-Mail</label>
									<input type="email" class="form-control"  name="musteri_mail" value="<?php echo $kayitcek['musteri_mail'] ?>">
								</div>	
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Telefon Nömrəsi</label>
									<input type="number" class="form-control" name="musteri_telefon" value="<?php echo $kayitcek['musteri_telefon'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Sifariş Başlığı</label>
									<input type="text" class="form-control" required name="sifaris_basliq" value="<?php echo $kayitcek['sifaris_basliq'] ?>">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>Qiymət (AZN)</label>
									<input type="number" class="form-control" name="sifaris_qiymet" value="<?php echo $kayitcek['sifaris_qiymet'] ?>">
								</div>
								<?php $aciliyet=$kayitcek['sifaris_tecili']; ?>
								<div class="form-group col-md-6">
									<label>Təcili</label>
									<select id="inputState" name="sifaris_tecili" class="form-control">
										<option <?php if($aciliyet == 'Təcili'){echo("selected");}?> value="Acil">Təcili</option>
										<option <?php if($aciliyet == 'Normal'){echo("selected");}?> value="Normal">Normal</option>
										<option <?php if($aciliyet == 'Tələsmə Hələ'){echo("selected");}?> value="Tələsmə Hələ">Acelesi Yok</option>
									</select>
								</div>
							</div>
							
							<div class="form-row">	
								<div class="form-group col-md-6">
									<label>Təslim Tarixi</label>
									<input required type="date" class="form-control" name="sifaris_teslim_tarixi" value="<?php echo $kayitcek['sifaris_teslim_tarixi'] ?>">
								</div>
								<?php $durum=$kayitcek['sifaris_durum']; ?>
								<div class="form-group col-md-6">
									<label>Sifariş Durumu</label>
									<select id="inputState" name="sifaris_durum" class="form-control">
										<option <?php if($durum == 'Yeni Başladı'){echo("selected");}?> value="Yeni Başladı">Yeni Başladı</option>
										<option <?php if($durum == 'Devam Ediyor'){echo("selected");}?> value="Devam Ediyor">Davam Edir</option>
										<option <?php if($durum == 'Bitdi'){echo("selected");}?> value="Bitdi">Bitdi</option>
									</select>
								</div>
							</div>			
							<div class="form-row">
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="sipdosya" name="sip_dosya" >
									</div>
									<div class="custom-control custom-checkbox small mt-2">
										<input type="checkbox" class="custom-control-input" value="sil" id="dosya_sil" name="dosya_sil">
										<label class="custom-control-label" for="dosya_sil">Faylları Sil</label>
									</div>
								</div>

							</div>			
							<div class="form-row mt-2">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="sifaris_haqqinda" id="editor"><?php echo $kayitcek['sifaris_haqqinda']?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="sifaris_id" value="<?php echo $kayitcek['sifaris_id'] ?>">
							<button type="submit" name="sifarisguncelle" class="btn btn-success">Save</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php' ?>
	<script src="ckeditor/ckeditor.js"></script>
	<script>
		CKEDITOR.replace( 'editor' );
	</script>
	<?php 
	if (strlen($kayitcek['fayl_yolu'])>10) {?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['fayl_yolu'] ?>';
				$("#sipdosya").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="<?php echo $kayitcek['fayl_yolu'] ?>" style="height:90px" class="file-preview-image" alt="Dosya" title="Dosya">'
			],
			initialPreviewConfig: [
			{downloadUrl: url1,
				showRemove: false,
			},
			],
		});

			});
		</script>
	<?php } else { ?>
		<script>
			$(document).ready(function () {
				var url1='<?php echo $kayitcek['fayl_yolu'] ?>';
				$("#sipdosya").fileinput({
					'theme': 'explorer-fas',
					'showUpload': false,
					'showCaption': true,
					'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
		});

			});
		</script>
	<?php } ?>
