<?php
session_start();
include("baglan.php");

if ($baglan) {
    if ($_POST) { //postun gidip gitmediğini kontrol etmek
        $ad = trim($_POST["ad"]);
        $soyad = trim($_POST["soyad"]);
        $mail = trim($_POST["mail"]);
        $sifre = trim($_POST["sifre"]);
        $tel_no = trim($_POST["telno"]);
        $tc = trim($_POST["tc"]);
        $d_tarihi = trim($_POST["d_tarihi"]);
        $rol_id = 2;
        $kayit_tarihi =date('Y-m-d H:i:s');
        $durum_id = 1;
        $vergi_no = NULL;
        $t_sicil_no	= NULL;
        $mersis_no = NULL;

        $sorgu=mysqli_query($baglan,"INSERT INTO terzi (rol_id,tc,ad,soyad,tel_no,mail,sifre,d_tarihi,vergi_no,t_sicil_no,mersis_no,kayit_tarihi,durum_id)
        VALUES ('".$rol_id."',".$tc.",'".$ad."','".$soyad."','".$tel_no."','".$mail."','".$sifre."','".$d_tarihi."','".$vergi_no."','".$t_sicil_no."','".$mersis_no."','".$kayit_tarihi."','".$durum_id."')");
        
        if($sorgu==TRUE){
            header('location:terzi-giris.html');
         
        }else{
            echo "Hata:".$sorgu."</br>".mysqli_error($baglan);
        }
        
        mysqli_close($baglan);
       
    }else{
        echo "Post Hatası";
    }
}else{
    echo "Veritabanına Bağlanmadı";
} 
?>
