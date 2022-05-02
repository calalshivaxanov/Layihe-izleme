<?php 
include 'header.php' ;

if (vezifekontrol()!="vezifeli") {
	header("location:index.php?durum=izinsiz");
	exit;
}

if (isset($_POST['layihe_id'])) {
	$layihesor=$db->prepare("SELECT * FROM layihe where layihe_id=:id");
	$layihesor->execute(array(
		'id' => guvenlik($_POST['layihe_id'])
	));
	$layihecek=$layihesor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:layiheler");
} 
?>
<?php
$layihenindetaymetni=$layihecek['layihe_haqqinda'];
$dosyayolu=$layihecek['fayl_yolu']
?>
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
					<h5 class="m-0 font-weight-bold text-primary">layihe Düzenleme İşlemi   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if ($_GET['islem']=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif ($_GET['islem']=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Uğursuz</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
						<form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>layihe Başlık</label>
									<input required type="text" class="form-control" name="layihe_basliq" value="<?php echo $layihecek['layihe_basliq'] ?>">
								</div>
								<div class="form-group col-md-6">
									<label>Bitirme Tarihi</label>
									<input required type="date" class="form-control" name="layihe_teslim_tarixi" value="<?php echo $layihecek['layihe_teslim_tarixi'] ?>">
								</div>
							</div>

							<div class="form-row">
								<?php $aciliyet=$layihecek['layihe_tecili']; ?>
								<div required class="form-group col-md-6">
									<label>Aciliyet</label>
									<select id="inputState" name="layihe_tecili" class="form-control">
										<option <?php if($aciliyet == 'Acil'){echo("selected");}?> value="Acil">Acil</option>
										<option <?php if($aciliyet == 'Normal'){echo("selected");}?> value="Normal">Normal</option>
										<option <?php if($aciliyet == 'Acelesi Yok'){echo("selected");}?> value="Acelesi Yok">Acelesi Yok</option>
									</select>
								</div>
								<?php $durum=$layihecek['layihe_durum']; ?>
								<div required class="form-group col-md-6">
									<label>layihe Durumu</label>
									<select name="layihe_durum" class="form-control">
										<option <?php if($durum == 'Yeni Başladı'){echo("selected");}?> value="Yeni Başladı">Yeni Başladı</option>
										<option <?php if($durum == 'Devam Ediyor'){echo("selected");}?> value="Devam Ediyor">Davam Edir</option>
										<option <?php if($durum == 'Bitdi'){echo("selected");}?> value="Bitdi">Bitdi</option>
									</select>
								</div>
							</div>

							<div class="form-row justify-content-center">	
								<div class="col-md-6">
									<div class="file-loading">
										<input type="file" class="form-control" id="layihedosya" name="layihe_dosya" >
									</div>
								</div>
							</div>					
							<div class="form-row">
								<div class="form-group col-md-12">
									<textarea class="ckeditor" name="layihe_haqqinda" id="editor"><?php echo $layihenindetaymetni; ?></textarea>
								</div>
							</div>
							<input type="hidden" class="form-control" name="layihe_id" value="<?php echo $_POST['layihe_id'] ?>">
							<button style="width: fit-content;" type="submit" name="layiheguncelle" class="btn btn-success">Save</button>
						</form>
					</div>
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
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#layihedosya").fileinput({
				'theme': 'explorer-fas',
				'showUpload': false,
				'showCaption': true,
				'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
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
			$("#layihedosya").fileinput({
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
