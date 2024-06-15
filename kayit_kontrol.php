<?php
session_start();
include ("baglan.php");  
    if($baglan){
   if($_POST){ //postun gidip gitmediğini kontrol etmek
      $uye_id=mysqli_insert_id($baglan);
      $ad=trim($_POST["ad"]);
      $soyad=trim($_POST["soyad"]);
      $mail=trim($_POST["mail"]);
      $sifre=trim($_POST["sifre"]);
      $tel_no=trim($_POST["telno"]);  
      $d_tarihi=trim($_POST["d_tarihi"]);
      $rol_id = 3;
      $kayit_tarihi =date('Y-m-d H:i:s');
      $sorgu=mysqli_query($baglan,"INSERT INTO musteriler (rol_id,ad,soyad,tel_no,mail,sifre,d_tarihi,kayit_tarihi)
      VALUES ('".$rol_id."','".$ad."','".$soyad."','".$tel_no."','".$mail."','".$sifre."','".$d_tarihi."','".$kayit_tarihi."')");
      if($sorgu==TRUE){
         header('location:musteri_index.php');
      }else{
         echo "Hata:".$sorgu."</br>".$baglan->error;
      }
      
      mysqli_close($baglan);
     
   }else{
      echo "Post Hatası";
   }
}else{
      echo "Veritabanına Bağlanmadı";
   } 
 


?>