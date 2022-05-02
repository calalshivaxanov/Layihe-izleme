<?php 
$host="localhost"; //Host adınızı girin varsayılan olarak Localhosttur eğer bilginiz yoksa bu şekilde bırakın
$db_name="layiheizleme"; //Veritabanı İsminiz
$istifadeci_adi="root"; //Veritabanı kullanıcı adınız
$db_pass="2352ceka20"; //Kullanıcı şifreniz şifre yoksa 123456789 yazan yeri silip boş bırakın

try {
	$db=new PDO("mysql:host=$host;dbname=$db_name;charset=utf8",$istifadeci_adi,$db_pass);
	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOExpception $e) {
	echo $e->getMessage();
}

?>
