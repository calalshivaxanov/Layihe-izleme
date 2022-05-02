<?php 
include 'header.php';
if (isset($_POST['user_id'])) {
  $kullanicisor=$db->prepare("SELECT * FROM istifadeciler where user_id=:id");
  $kullanicisor->execute(array(
    'id' => guvenlik($_POST['user_id'])
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
} else {
  $kullanicisor=$db->prepare("SELECT * FROM istifadeciler where session_mail=:mail");
  $kullanicisor->execute(array(
    'mail' => $_SESSION['user_mail']
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
}
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
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
<div class="container">
  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Ad Soyad</label>
        <input type="text" required class="form-control" value="<?php echo $kullanicicek['user_name'] ?>" name="user_name" placeholder="Ad">
      </div>
      <div class="form-group col-md-6">
        <label>E-Mail</label>
        <input type="email" required class="form-control" value="<?php echo $kullanicicek['user_mail'] ?>" name="user_mail" placeholder="E-Mail">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Telefon Nömrəsi</label>
        <input type="number" required class="form-control" value="<?php echo $kullanicicek['user_telefon'] ?>" name="user_telefon" placeholder="Telefon Nömrəsi">
      </div>
      <div class="form-group col-md-6">
        <label>Ünvanı</label>
        <input type="text" required class="form-control" value="<?php echo $kullanicicek['user_unvan'] ?>" name="user_unvan" placeholder="İstifadəçi Ünvanı/Vəzifəsi">
      </div>
    </div>
    <input type="hidden" name="user_id" value="<?php echo $kullanicicek['user_id'] ?>">
    <center>
      <div class="form-row col-md-6 justify-content-center mb-3">
        <label>Profil Rəsmi</label>
        <div class="file-loading">
          <input class="form-control" id="profilresmi" name="user_logo" type="file">
        </div>
      </div>
    </center>
    <div class="row ml-1">
     <button type="submit" name="profilguncelle" class="btn btn-primary">Save</button> 
   </form>
   <form class="ml-2" action="sifreguncelle.php" method="POST" accept-charset="utf-8">
    <input type="hidden" name="user_id" value="<?php echo $kullanicicek['user_id'] ?>">
    <button type="submit" name="xxx" class="btn btn-danger">Şifrə Sıfırla</button>
  </form> 
</div>
</div>
<hr>
<?php include 'footer.php' ?>
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
  $(document).ready(function () {
    $("#profilresmi").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showRemove': true,
      'showCaption': true,
      'showPreview':false,
     // 'showPreview':false,
     allowedFileExtensions: ["jpg", "png", "jpeg"],
   });
  });
</script>

<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşləm Uğursuz',
      text: 'Lütfən Təkrar Sınayın',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="eskisifrexeta")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşləm Uğursuz',
      text: 'Köhnə Şifrəniz xətalıdır. Lütfən bir daha sınayın',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="sifreleruyusmuyor")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşləm Uğursuz',
      text: 'Daxil etdiyiniz şifrələr eyni deyil. Lütfən bir daha sınayın',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>
<?php if (@$_GET['durum']=="ok")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşləm Uğurlu',
      text: 'İşləminiz Uğurla Gerçəkləşdirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="sifredegisti")  {?>  
  <script>
    Swal.fire({
      type: 'success',
      title: 'İşləm Uğurlu',
      text: 'İşləminiz Uğurlu Gerçəkləşdirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
  <?php } ?>
