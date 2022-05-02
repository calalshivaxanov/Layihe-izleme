<?php 
include 'header.php';
?>
<div class="container">
 <div class="justify-content-center">
  <form action="islemler/islem.php" method="POST" accept-charset="utf-8">
    <center><div class="form-group col-md-6">
      <label>Eski Şifre</label>
      <input style="text-align: center;" type="password" required class="form-control" name="eskisifre" placeholder="Köhnə Şifrəniz">
    </div>
    <div class="form-group col-md-6">
      <label>Yeni Şifrə</label>
      <input style="text-align: center;" type="password" required class="form-control" name="yenisifre_bir" placeholder="Yeni Şifrəniz">
    </div>
    <div class="form-group col-md-6">
      <label>Yeni Şifrə Yoxla</label>
      <input style="text-align: center;" type="password" required class="form-control" name="yenisifre_iki" placeholder="Yeni Şifrənizi Təkrar Girin">
    </div>
    <input type="hidden" name="user_id" value="<?php echo guvenlik($_POST['user_id']) ?>">
    <button type="submit" name="sifreguncelle" class="btn btn-primary">Save</button></center>
  </form>
</div>
</div>
<?php include 'footer.php'; ?>