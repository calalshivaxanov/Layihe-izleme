<?php


@ob_start();
@session_start();
include 'baglan.php';
include '../funksiyalar.php';

//Site parametrlerını veritabanından çekme işlemi
$ayarsor=$db->prepare("SELECT * FROM parametrler");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

/********************************************************************************/

/*Oturum Açma İşlemi Giriş*/
if (isset($_POST['daxilol'])) {
	$user_mail=guvenlik($_POST['user_mail']);
	$user_password=md5($_POST['user_password']);
	$kullanicisor=$db->prepare("SELECT * FROM istifadeciler WHERE user_mail=:mail and user_password=:sifre");
	$kullanicisor->execute(array(
		'mail'=> $user_mail,
		'sifre'=> $user_password
	));
	$sonuc=$kullanicisor->rowCount();
	if ($sonuc==1) {
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$_SESSION['user_mail']=sifreleme($user_mail); //Session güvenliği için sessionumuzu üç aşamalı oalrak şifreliyoruz
		$_SESSION['user_id']=$kullanicicek['user_id'];

		$ipsave=$db->prepare("UPDATE istifadeciler SET
			ip_adresi=:ip_adresi, 
			session_mail=:session_mail WHERE 
			user_mail=:user_mail
			");

		$save=$ipsave->execute(array(
			'ip_adresi' => $_SERVER['REMOTE_ADDR'], //Güvenlik için işlemine karşı kullanıcının ip adresini veritabanına kayıt ediyoruz
			'session_mail' => sifreleme($user_mail),
			'user_mail' => $user_mail
		));
		header("location:../index.php");
		exit;
	} else {
		header("location:../login?durum=xeta");
	}
	exit;
}
/*Oturum Açma İşlemi Giriş*/


/*******************************************************************************/

if (isset($_POST['genelparamsave'])) {
  if (vezifekontrol()!="vezifeli") {
    header("location:../index.php");
    exit;
  }
 			$boyut = $_FILES['sayt_logo']['size'];//Dosya boyutumuzu alıp değişkene aktardık.
            if($boyut > 3145728)//Burada dosyamız 3 mb büyükse girmesini söyledik
            {
            //İsteyen arkadaslar burayı istediği gibi değiştirebilir size kalmış bir şey
                echo 'Dosya 3MB den büyük olamaz.';// 3 mb büyükse ekrana yazdıracağımız alan
              } else {

               if ($boyut < 20) {
                $genelparamsave=$db->prepare("UPDATE parametrler SET
                 sayt_basliq=:baslik,
                 sayt_aciqlama=:aciklama,
                 sayt_sahibi=:sahip,
                 mail_tesdiqi=:mail_tesdiqi,
                 xeberdarliq_tesdiqi=:xeberdarliq_tesdiqi where id=1
                 ");

                $ekleme=$genelparamsave->execute(array(
                 'baslik' => guvenlik($_POST['sayt_basliq']),
                 'aciklama' => guvenlik($_POST['sayt_aciqlama']),
                 'sahip' => guvenlik($_POST['sayt_sahibi']),
                 'mail_tesdiqi' => guvenlik($_POST['mail_tesdiqi']),
                 'xeberdarliq_tesdiqi' => guvenlik($_POST['xeberdarliq_tesdiqi'])
               ));

              } else {

                $yuklemeqovlugu = '../img';
                @$kecici_isim = $_FILES['sayt_logo']["tmp_name"];
                @$dosya_ismi = $_FILES['sayt_logo']["name"];
            		$benzersizsayi1=rand(100,10000); //Güvenlik için yüklenen dosyanın başına rastgele karakterler koyuyoruz
            		$benzersizsayi2=rand(100,10000); //Güvenlik için yüklenen dosyanın başına rastgele karakterler koyuyoruz
            		$isim=$benzersizsayi1.$benzersizsayi2.$dosya_ismi;
            		$resim_yolu=substr($yuklemeqovlugu, 3)."/".tum_bosluk_sil($isim);
            		@move_uploaded_file($kecici_isim, "$yuklemeqovlugu/$isim");

            		$genelparamsave=$db->prepare("UPDATE parametrler SET
            			sayt_basliq=:baslik,
            			sayt_aciqlama=:aciklama,
            			sayt_sahibi=:sahip,
            			mail_tesdiqi=:onay,
            			xeberdarliq_tesdiqi=:xeberdarliq_tesdiqi,
            			sayt_logo=:sayt_logo where id=1
            			");

            		$ekleme=$genelparamsave->execute(array(
            			'baslik' => guvenlik($_POST['sayt_basliq']),
            			'aciklama' => guvenlik($_POST['sayt_aciqlama']),
            			'sahip' => guvenlik($_POST['sayt_sahibi']),
            			'onay' => guvenlik($_POST['mail_tesdiqi']),
            			'xeberdarliq_tesdiqi' => guvenlik($_POST['xeberdarliq_tesdiqi']),
            			'sayt_logo' => $resim_yolu
            		));
            	}
            }

            if ($ekleme) {
            	header("location:../parametrler?durum=ok");
            } else {
            	header("location:../parametrler?durum=no");
            	exit;
            }            
          }

          /*******************************************************************************/

//layihe Ekleme Bölümü
          if (isset($_POST['layiheekle'])) {
            if (vezifekontrol()!="vezifeli") {
              header("location:../index.php");
              exit;
            }
//layihe detaylarını veritabanınına kayıt etme
            $layiheekle=$db->prepare("INSERT INTO layihe SET
             layihe_basliq=:baslik,
             layihe_haqqinda=:detay,
             layihe_teslim_tarixi=:teslim_tarihi,
             layihe_durum=:durum,
             layihe_tecili=:aciliyet
             ");

            $ekleme=$layiheekle->execute(array(
             'baslik' => guvenlik($_POST['layihe_basliq']),
             'detay' => $_POST['layihe_haqqinda'],
             'teslim_tarihi' => guvenlik($_POST['layihe_teslim_tarixi']),
             'durum' => guvenlik($_POST['layihe_durum']),
             'aciliyet' => guvenlik($_POST['layihe_tecili'])
           ));

            if ($_FILES['layihe_dosya']['error']=="0") {
              $yuklemeqovlugu = '../dosyalar';
              @$kecici_isim = $_FILES['layihe_dosya']["tmp_name"];
              @$dosya_ismi = $_FILES['layihe_dosya']["name"];
              $benzersizsayi1=rand(100000,999999);
              $isim=$benzersizsayi1.$dosya_ismi;
              $resim_yolu=substr($yuklemeqovlugu, 3)."/".tum_bosluk_sil($isim);
              @move_uploaded_file($kecici_isim, "$yuklemeqovlugu/$isim");   
              $son_eklenen_id=$db->lastInsertId();
              $dosyayukleme=$db->prepare("UPDATE layihe SET
               fayl_yolu=:fayl_yolu WHERE layihe_id=:layihe_id ");

              $yukleme=$dosyayukleme->execute(array(
               'fayl_yolu' => $resim_yolu,
               'layihe_id' => $son_eklenen_id
             ));
            }
            
            if ($ekleme) {
             header("location:../layiheler?durum=ok");
             exit;
           } else {
             header("location:../layiheler?durum=no");
             exit;
           }
           exit;
         }


         /********************************************************************************/

         if (isset($_POST['layiheguncelle'])) {
          if (vezifekontrol()!="vezifeli") {
            header("location:../index.php");
            exit;
          }
          $layiheguncelle=$db->prepare("UPDATE layihe SET
            layihe_basliq=:baslik,
            layihe_haqqinda=:detay,
            layihe_teslim_tarixi=:teslim_tarihi,
            layihe_durum=:durum,
            layihe_tecili=:aciliyet where layihe_id={$_POST['layihe_id']}");

          $guncelle=$layiheguncelle->execute(array(
            'baslik' => guvenlik($_POST['layihe_basliq']),
            'detay' => $_POST['layihe_haqqinda'],
            'teslim_tarihi' => guvenlik($_POST['layihe_teslim_tarixi']),
            'durum' => guvenlik($_POST['layihe_durum']),
            'aciliyet' => guvenlik($_POST['layihe_tecili'])
          ));
          if ($_FILES['layihe_dosya']['error']=="0") {

            $yuklemeqovlugu = '../dosyalar';
            @$kecici_isim = $_FILES['layihe_dosya']["tmp_name"];
            @$dosya_ismi = $_FILES['layihe_dosya']["name"];
            $benzersizsayi1=rand(10,1000);
            $isim1=$benzersizsayi1.$dosya_ismi;
            $isim=tum_bosluk_sil($isim1);
            $resim_yolu=substr($yuklemeqovlugu, 3)."/".$isim;
            @move_uploaded_file($kecici_isim, "$yuklemeqovlugu/$isim");   

            $dosyayukleme=$db->prepare("UPDATE layihe SET
              fayl_yolu=:fayl_yolu WHERE layihe_id=:layihe_id ");

            $yukleme=$dosyayukleme->execute(array(
              'fayl_yolu' => $resim_yolu,
              'layihe_id' => $_POST['layihe_id']
            ));

          };

          if ($guncelle) {
            header("location:../layiheler?durum=ok");
            exit;
          } else {
            header("location:../layiheler?durum=no");
            exit;
          }
          exit;
        }

       
        if (isset($_POST['sifarisyukle'])) {
          if (vezifekontrol()!="vezifeli") {
            header("location:../index.php");
            exit;
          }
          $sifarisyukle=$db->prepare("INSERT INTO sifaris SET
            musteri_ad=:isim,
            musteri_mail=:mail,
            musteri_telefon=:telefon,
            sifaris_basliq=:baslik,
            sifaris_teslim_tarixi=:teslim_tarihi,
            sifaris_tecili=:aciliyet,
            sifaris_durum=:durum,
            sifaris_qiymet=:ucret,
            sifaris_haqqinda=:detay
            ");

          $ekleme=$sifarisyukle->execute(array(
            'isim' => guvenlik($_POST['musteri_ad']),
            'mail' => guvenlik($_POST['musteri_mail']),
            'telefon' => guvenlik($_POST['musteri_telefon']),
            'baslik' => guvenlik($_POST['sifaris_basliq']),
            'teslim_tarihi' => guvenlik($_POST['sifaris_teslim_tarixi']),
            'aciliyet' => guvenlik($_POST['sifaris_tecili']),
            'durum' => guvenlik($_POST['sifaris_durum']),
            'ucret' => guvenlik($_POST['sifaris_qiymet']),
            'detay' => $_POST['sifaris_haqqinda']
          ));

          if ($_FILES['sip_dosya']["error"]=="0") {
           $yuklemeqovlugu = '../dosyalar';
           @$kecici_isim = $_FILES['sip_dosya']["tmp_name"];
           @$dosya_ismi = $_FILES['sip_dosya']["name"];
           $benzersizsayi1=rand(10,1000);
           $isim1=$benzersizsayi1.$dosya_ismi;
           $isim=tum_bosluk_sil($isim1);
           $resim_yolu=substr($yuklemeqovlugu, 3)."/".$isim;
           move_uploaded_file($kecici_isim, "$yuklemeqovlugu/$isim");



           $son_eklenen_id=$db->lastInsertId();

           $dosyayukleme=$db->prepare("UPDATE sifaris SET
            fayl_yolu=:fayl_yolu WHERE sifaris_id=:sifaris_id ");

           $yukleme=$dosyayukleme->execute(array(
            'fayl_yolu' => $resim_yolu,
            'sifaris_id' => $son_eklenen_id
          ));
         }
        

         if ($ekleme) {
          header("location:../sifarisler?durum=ok");
          exit;
        } else {
          header("location:../sifarisler?durum=no");
          exit;
        }
        exit;
      }


      /********************************************************************************/


      if (isset($_POST['sifarisguncelle'])) {
        if (vezifekontrol()!="vezifeli") {
          header("location:../index.php");
          exit;
        }
        $sifarisguncelle=$db->prepare("UPDATE sifaris SET
          musteri_ad=:isim,
          musteri_mail=:mail,
          musteri_telefon=:telefon,
          sifaris_basliq=:baslik,
          sifaris_teslim_tarixi=:teslim_tarihi,
          sifaris_tecili=:aciliyet,
          sifaris_durum=:durum,
          sifaris_haqqinda=:detay,
          sifaris_qiymet=:ucret 
          WHERE sifaris_id={$_POST['sifaris_id']}");

        $guncelle=$sifarisguncelle->execute(array(
          'isim' => guvenlik($_POST['musteri_ad']),
          'mail' => guvenlik($_POST['musteri_mail']),
          'telefon' => guvenlik($_POST['musteri_telefon']),
          'baslik' => guvenlik($_POST['sifaris_basliq']),
          'teslim_tarihi' => guvenlik($_POST['sifaris_teslim_tarixi']),
          'aciliyet' => guvenlik($_POST['sifaris_tecili']),
          'durum' => guvenlik($_POST['sifaris_durum']),
          'detay' => $_POST['sifaris_haqqinda'],
          'ucret' => guvenlik($_POST['sifaris_qiymet'])
        ));


        if ($_FILES['sip_dosya']['error']=="0") {

          $yuklemeqovlugu = '../dosyalar';
          @$kecici_isim = $_FILES['sip_dosya']["tmp_name"];
          @$dosya_ismi = $_FILES['sip_dosya']["name"];
          $benzersizsayi1=rand(10,1000);
          $isim1=$benzersizsayi1.$dosya_ismi;
          $isim=tum_bosluk_sil($isim1);
          $resim_yolu=substr($yuklemeqovlugu, 3)."/".$isim;
          @move_uploaded_file($kecici_isim, "$yuklemeqovlugu/$isim");   


          if ($_POST['dosya_sil']=="sil") {
            $fayl_yolu="";
          } else {
            $fayl_yolu=$resim_yolu;
          };

          $dosyayukleme=$db->prepare("UPDATE sifaris SET
            fayl_yolu=:fayl_yolu WHERE sifaris_id=:sifaris_id ");

          $yukleme=$dosyayukleme->execute(array(
            'fayl_yolu' => $fayl_yolu,
            'sifaris_id' => $_POST['sifaris_id']
          ));

        }
      
        if ($guncelle) {
          header("location:../sifarisler?durum=ok");
          exit;
        } else {
          echo "\nPDOStatement::errorInfo():\n";
          $arr = $guncelle->errorInfo();
          print_r($arr);
          exit;
        }
        exit;
      }



      /********************************************************************************/


      if (isset($_POST['sifreguncelle'])) {
        if (vezifekontrol()!="vezifeli") {
          header("location:../index.php");
          exit;
        }
        $eskisifre=guvenlik($_POST['eskisifre']);
        $yenisifre_bir=guvenlik($_POST['yenisifre_bir']); 
        $yenisifre_iki=guvenlik($_POST['yenisifre_iki']);

        $user_password=md5($eskisifre);

        $kullanicisor=$db->prepare("SELECT * FROM istifadeciler WHERE user_password=:sifre AND user_id=:id");
        $kullanicisor->execute(array(
          'id' => guvenlik($_POST['user_id']),
          'sifre' => $user_password
        ));

//dönen satır sayısını belirtir
        $say=$kullanicisor->rowCount();

        if ($say==0) {
          header("Location:../profil?durum=eskisifrexeta");
        } else {
//eski şifre doğruysa başla
          if ($yenisifre_bir==$yenisifre_iki) {
           if (strlen($yenisifre_bir)>=6) {
//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
            $sifre=md5($yenisifre_bir);
            $kullanici_yetki=0;
            $kullanicisave=$db->prepare("UPDATE istifadeciler SET
             user_password=:user_password
             WHERE user_id=:user_id");

            $insert=$kullanicisave->execute(array(
             'user_password' => $sifre,
             'user_id'=>guvenlik($_POST['user_id'])
           ));

            if ($insert) {
             header("Location:../profil.php?durum=sifredegisti");
//Header("Location:../production/genel-parametrler?durum=ok");
           } else {
             header("Location:../profil.php?durum=no");
           }

// Bitiş
         } else {
          header("Location:../profil.php?durum=eksiksifre");
        }

      } else {
       header("Location:../profil?durum=sifreleruyusmuyor");
       exit;
     }
   }
   exit;
   if ($update) {
    header("Location:../profil?durum=ok");

  } else {
    header("Location:../profil?durum=no");
  }
}


/********************************************************************************/


if (isset($_POST['profilguncelle'])) {
  if (vezifekontrol()!="vezifeli") {
    header("location:../index.php");
    exit;
  }
  if (isset($_SESSION['user_mail'])) {

			$boyut = $_FILES['user_logo']['size'];//Dosya boyutumuzu alıp değişkene aktardık.
            if($boyut > 3145728)//Burada dosyamız 3 mb büyükse girmesini söyledik
            {
            //İsteyen arkadaslar burayı istediği gibi değiştirebilir size kalmış bir şey
                echo 'Dosya 3MB den büyük olamaz.';// 3 mb büyükse ekrana yazdıracağımız alan
              } else {
               $yuklemeqovlugu = '../img';
               @$kecici_isim = $_FILES['user_logo']["tmp_name"];
               @$dosya_ismi = $_FILES['user_logo']["name"];
               $benzersizsayi1=rand(10000,99999);
               $benzersizsayi2=rand(10000,99999);
               $isim=$benzersizsayi1.$benzersizsayi2.$dosya_ismi;
               $resim_yolu=substr($yuklemeqovlugu, 3)."/".tum_bosluk_sil($isim);
               @move_uploaded_file($kecici_isim, "$yuklemeqovlugu/$isim");            	
             }

             $uzunluk=strlen($resim_yolu);
             if ($uzunluk<18) {
               $profilguncelle=$db->prepare("UPDATE istifadeciler SET
                user_name=:isim,
                user_mail=:mail,
                user_telefon=:telefon,
                user_unvan=:unvan WHERE session_mail=:session_mail");
               $ekleme=$profilguncelle->execute(array(
                'isim' => guvenlik($_POST['user_name']),
                'mail' => guvenlik($_POST['user_mail']),
                'telefon' => guvenlik($_POST['user_telefon']),
                'unvan' => guvenlik($_POST['user_unvan']),
                'session_mail' => $_SESSION['user_mail']
              ));
   
               if ($ekleme) {
                header("Location:../profil?durum=ok");
              } else {

                header("Location:../profil?durum=no");
              }
              exit;
            } else {
            	$profilguncelle=$db->prepare("UPDATE istifadeciler SET
            		user_name=:isim,
            		user_mail=:mail,
            		user_telefon=:telefon,
            		user_unvan=:unvan,
            		user_logo=:logo WHERE session_mail=:session_mail");
            	$ekleme=$profilguncelle->execute(array(
            		'isim' => guvenlik($_POST['user_name']),
            		'mail' => guvenlik($_POST['user_mail']),
            		'telefon' => guvenlik($_POST['user_telefon']),
            		'unvan' => guvenlik($_POST['user_unvan']),
            		'logo' => $resim_yolu,
            		'session_mail' => $_SESSION['user_mail']
            	));

            	if ($ekleme) {
            		header("Location:../profil?durum=ok");
            	} else {
            		header("Location:../profil?durum=noff");
            	}
            	exit;
            }

          }
          header("Location:../profil");
          exit;

        }


        /********************************************************************************/



        if (isset($_POST['sifarissilme'])) {
          if (vezifekontrol()!="vezifeli") {
            header("location:../index.php");
            exit;
          }
          $sil=$db->prepare("DELETE from sifaris where sifaris_id=:id");
          $kontrol=$sil->execute(array(
            'id' => guvenlik($_POST['sifaris_id'])
          ));

          if ($kontrol) {
//echo "kayıt başarılı";
            header("location:../sifarisler?durum=ok");
            exit;
          } else {
//echo "kayıt Uğursuz";
            header("location:../sifarisler?durum=no");
            exit;

          }
        }
    

        if (isset($_POST['layihesilme'])) {
          if (vezifekontrol()!="vezifeli") {
            header("location:../index.php");
            exit;
          }
          $sil=$db->prepare("DELETE from layihe where layihe_id=:id");
          $kontrol=$sil->execute(array(
            'id' => guvenlik($_POST['layihe_id'])
          ));

          if ($kontrol) {
//echo "kayıt başarılı";
            header("location:../layiheler?durum=ok");
            exit;
          } else {
//echo "kayıt Uğursuz";
            header("location:../layiheler?durum=no");
            exit;

          }
        }


        /********************************************************************************/



        ?>
