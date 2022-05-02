<?php 
include 'header.php';
if (vezifekontrol()!="vezifeli") {
  header("location:index.php?durum=izinsiz");
  exit;
}
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Ad Soyad</label>
        <input type="text" class="form-control" required name="musteri_ad" placeholder="Müştəri Ad Soyad">
      </div>
      <div class="form-group col-md-6">
        <label>E-Mail</label>
        <input type="email" class="form-control" required name="musteri_mail" placeholder="Müştəri E-Mail">
      </div>
      
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Nömrəsi</label>
        <input type="number" class="form-control" required name="musteri_telefon" placeholder="Müştəri Telefon Nömrəsi">
      </div>
      <div class="form-group col-md-6">
        <label>Sifariş Başlığı</label>
        <input type="text" class="form-control" required name="sifaris_basliq" placeholder="İş-Sifariş Başlığı">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Sifariş Durumu</label>
        <select required name="sifaris_durum" class="form-control">
          <option>Yeni Başladı</option>
          <option>Davam Edir</option>
          <option>Bitdi</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Qiymət (AZN)</label>
        <input type="number" class="form-control" name="sifaris_qiymet" placeholder="Sifarişinizin Qiymətini Daxil edin">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Təslim Tarixi</label>
        <input type="date" class="form-control" required name="sifaris_teslim_tarixi" placeholder="Təslim Tarixi">
      </div>
      <div class="form-group col-md-6">
        <label>Təcili</label>
        <select required name="sifaris_tecili" class="form-control">
          <option>Təcili</option>
          <option>Normal</option>
          <option>Tələsmə hələ</option>
        </select>
      </div> 
    </div>
    <div class="form-row d-flex justify-content-center mb-3">
      <div class="col-md-6">
        <div class="file-loading">
          <input class="form-control" id="sip_dosya" name="sip_dosya" type="file">
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-12">
        <textarea class="ckeditor" name="sifaris_haqqinda" id="editor"></textarea>
      </div>
    </div>
    <button type="submit" name="sifarisyukle" class="btn btn-primary">Save</button>
  </form>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor' );
</script>
<!--İşlem sonucu açılan bildirim popupunu otomatik kapatma giriş-->
<script type="text/javascript">
  $('#islemsonucu').modal('show');
  setTimeout(function() {
    $('#islemsonucu').modal('hide');
  }, 3000);
</script>
<!--İşlem sonucu açılan bildirim popupunu otomatik kapatma çıkış-->
<script>
  $(document).ready(function () {
    $("#sip_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
      allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>
