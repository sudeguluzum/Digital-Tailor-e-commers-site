<?php
session_start();
include ("baglan.php");
if($baglan){
   if($_POST){ //postun gidip gitmediğini kontrol etmek
      $mail=strip_tags(trim($_POST["mail"]));
      $sifre=strip_tags(trim($_POST["sifre"]));
      $sorgu=mysqli_query($baglan,"SELECT * FROM musteriler WHERE mail='".$mail."' AND sifre='".$sifre."'");
      if(mysqli_num_rows($sorgu)>0){
         $row=mysqli_fetch_row($sorgu);
         $_SESSION['musteri_id']=$row[0];
         $_SESSION['ad']=$row[1];
         $_SESSION['soyad']=$row[2];
         $_SESSION['telno']=$row[3];
         $_SESSION['mail']=$row[4]; 
         $_SESSION['sifre']=$row[5];
         $_SESSION['d_tarihi']=$row[6]; 
         $_SESSION['uyelik_tarihi']=$row[7]; 

       header("Location: order.php"); 
      }else{

         echo '<script type="text/javascript">
         alert("E-posta ya da Şifre Hatalı");
         location.href = "login.html";
         </script>';
         exit;
      }
   }else{
      echo "Post Hatası";
   }
   }else{
      echo "Veritabanına Bağlanmadı";
   }
?>