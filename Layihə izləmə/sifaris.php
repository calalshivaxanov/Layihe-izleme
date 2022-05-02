<?php 
include 'header.php' ;

if (isset($_POST['sifaris_bak'])) {
	if (is_numeric($_POST['sifaris_id'])) {
		$sifarissor=$db->prepare("SELECT * FROM sifaris where sifaris_id=:id");
		$sifarissor->execute(array(
			'id' => guvenlik($_POST['sifaris_id'])
		));
		$sifariscek=$sifarissor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:sifarisler?durum=xeta");
	}
} else {
	header("location:sifarisler.php");
} 
?>
<?php
$sifarisdetaymetni=$sifariscek['sifaris_haqqinda'];
$dosyayolu=$sifariscek['fayl_yolu'];
?>
<style type="text/css" media="screen">
	.file-details-cell {
		display: none
	}
</style>
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
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $sifariscek['sifaris_basliq'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>İsim Soyisim</label>
								<input disabled="" type="text" class="form-control" name="musteri_ad" value="<?php echo $sifariscek['musteri_ad'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>E-Posta</label>
								<input disabled="" type="email" class="form-control" name="musteri_mail" value="<?php echo $sifariscek['musteri_mail'] ?>">
							</div>	
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Telefon Numarası</label>
								<input disabled="" type="number" class="form-control" name="musteri_telefon" value="<?php echo $sifariscek['musteri_telefon'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Sipariş Başlığı</label>
								<input disabled="" type="text" class="form-control" name="sifaris_basliq" value="<?php echo $sifariscek['sifaris_basliq'] ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>Ücret (TL)</label>
								<input disabled="" type="text" class="form-control" name="sifaris_qiymet" value="<?php echo $sifariscek['sifaris_qiymet'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Bitirme Tarihi</label>
								<input disabled type="date" class="form-control" name="sifaris_teslim_tarixi" value="<?php echo $sifariscek['sifaris_teslim_tarixi'] ?>">
							</div>
						</div>

						<div class="form-row">
							<?php $aciliyet=$sifariscek['sifaris_tecili']; ?>
							<div disabled class="form-group col-md-6">
								<label>Təcili</label>
								<input disabled type="text" class="form-control" value="<?php echo $aciliyet ?>">
							</div>
							<?php $durum=$sifariscek['sifaris_durum']; ?>
							<div disabled class="form-group col-md-6">
								<label>Sifariş Durumu</label>
								<input disabled type="text" class="form-control" value="<?php echo $durum ?>">
							</div>
						</div>

											
						<div class="form-row">
							<div class="form-group col-md-12">
								<textarea disabled class="ckeditor" id="editor">
									<?php echo $sifarisdetaymetni; ?>
								</textarea>
							</div>
						</div>
						<?php if (strlen($dosyayolu)>10) { ?>
							<div class="form-row mt-2">
								<div class="col-md-6">
									<div class="file-loading">
										<input class="form-control" id="sifarisdosyalari" name="sip_dosya" type="file">
									</div>
								</div>
							</div>	
						<?php } ?>						
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
	CKEDITOR.replace('editor');
</script>


<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#sifarisdosyalari").fileinput({
				'theme': 'explorer-fas',
				showRemove: false,
				showBrowse: false,
				showUpload: false,
				showCaption: false,
				showClose: false,
				showCaption: false,
				
				//	'initialPreviewAsData': true,
				allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
				initialPreview: [
				'<img src="<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Önizleme Yok" title="Ön izləmə Yoxdur">',
				],
				initialPreviewConfig: [
				{downloadUrl: url1,
					showRemove: false,
					showBrowse: false,
					showUpload: false,
					width: '120px'
				},
				],
			});
		});
	</script>
	<?php } ?>