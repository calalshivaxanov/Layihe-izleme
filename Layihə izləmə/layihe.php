<?php 
include 'header.php' ;
if (isset($_POST['layihe_bak'])) {
	if (is_numeric($_POST['layihe_id'])) {

		$layihesor=$db->prepare("SELECT * FROM layihe where layihe_id=:id");
		$layihesor->execute(array(
			'id' => guvenlik($_POST['layihe_id'])
		));
		$layihecek=$layihesor->fetch(PDO::FETCH_ASSOC);
	} else {
		header("location:layiheler?durum=xeta");
	}

} else {
	header("location:layiheler.php");
} 
?>

<?php
$layihenindetaymetni=$layihecek['layihe_haqqinda'];
$dosyayolu=$layihecek['fayl_yolu'];
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
					<h5 class="m-0 font-weight-bold text-primary"><?php echo $layihecek['layihe_basliq'] ?></h5>
				</div>
				<div class="card-body">
					<form action="islemler/islem.php" method="POST">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label>layihe Başlık</label>
								<input disabled type="text" class="form-control" name="layihe_basliq" value="<?php echo $layihecek['layihe_basliq'] ?>">
							</div>
							<div class="form-group col-md-6">
								<label>Bitirme Tarihi</label>
								<input disabled type="date" class="form-control" name="layihe_teslim_tarixi" value="<?php echo $layihecek['layihe_teslim_tarixi'] ?>">
							</div>
						</div>

						<div class="form-row">
							<?php $aciliyet=$layihecek['layihe_tecili']; ?>
							<div disabled class="form-group col-md-6">
								<label>Təcili</label>
								<input disabled type="text" class="form-control" value="<?php echo $aciliyet ?>">
							</div>
							<?php $durum=$layihecek['layihe_durum']; ?>
							<div disabled class="form-group col-md-6">
								<label>Layihe Durumu</label>
								<input disabled type="text" class="form-control" value="<?php echo $durum ?>">
							</div>
						</div>								
						<div class="form-row">
							<div class="form-group col-md-12">
								<textarea disabled class="ckeditor" id="editor"><?php echo $layihenindetaymetni; ?></textarea>
							</div>
						</div>
						<?php if (strlen($dosyayolu)>10) { ?>
							<div class="form-row mt-2">
								<div class="col-md-6">
									<div class="file-loading">
										<input class="form-control" id="layihedosyalari" name="layihe_dosya" type="file">
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
	CKEDITOR.replace('editor',{
	});
</script>

<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#layihedosyalari").fileinput({
				'theme': 'explorer-fas',
				showBrowse: false,
				showUpload: false,
				showCaption: false,
				showClose: false,
				showCaption: false,
				//	'initialPreviewAsData': true,
				
				initialPreview: [
				'<img src="<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
				],
				initialPreviewConfig: [
				{downloadUrl: url1,
					showRemove: false},
					],
				});
		});
	</script>
<?php } ?>
