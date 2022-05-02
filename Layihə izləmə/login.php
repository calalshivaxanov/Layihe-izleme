<?php include 'islemler/baglan.php' ;
$ayarsor=$db->prepare("SELECT * FROM parametrler");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $ayarcek['sayt_aciqlama'] ?>">
  <meta name="author" content="<?php echo $ayarcek['sayt_sahibi'] ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo $ayarcek['sayt_logo'] ?>">

  <title><?php echo $ayarcek['sayt_basliq'] ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container align-items-center" style="margin-top: 7%">
    <div class="row justify-content-center align-content-center">
      <div class="card o-hidden border-0 shadow-md" style="min-width: 45%">
       <div class="p-5">
        <div class="text-center">
          <h2 class="h2 text-gray-900 mb-4">Xoşgeldin</h2>
        </div>
        <form class="user" action="islemler/islem.php" method="POST">
          <div class="form-group">
            <input name="user_mail" required type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder=" E-Mail ">
          </div>
          <div class="form-group">
            <input type="password" required name="user_password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Şifre">
          </div>
          <button name="daxilol" type="submit" class="btn text-white btn-primary btn-user btn-block">Daxil ol</button>
          <hr>           
          <p class="text-muted text-center"><?php echo $ayarcek['sayt_basliq'] ?></p>
        </form>
      </div>
    </div>
  </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<script src="vendor/sweetalert/sweetalert2.all.min.js"></script>
<?php if (@$_GET['durum']=="xeta")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'Daxil olma İşləmi Uğursuz',
      text: 'Daxil etdiyiniz Məlumatları Bir daha yoxlayın',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="izinsiz")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'Giriş İcazəniz Yoxdur',
      text: 'Səhifəni Açmaq üçün Lütfən Məlumatları Doldurun',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="suphe")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'Şüphəli Hərəkət',
      text: 'Şüphəli Bir Hərəkət Aşkarlandı... Lütfən Təkrar Daxil olun',
      showConfirmButton: true,
      confirmButtonText: 'Kapat'
    })
  </script>
<?php } ?>


