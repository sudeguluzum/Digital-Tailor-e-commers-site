<?php
include("baglan.php");
session_start();
if (!$baglan) {
    echo "Veritabanına Bağlanmadı";
    exit;
}
$mail= $_POST["mail"];
$sifre = $_POST["sifre"];
if (empty($mail) || empty($sifre)) {
    echo "<script>alert('Giriş yapmış bir kullanıcı bulunamadı.'); window.location.href='giris.html';</script>";
    exit;

}
else{

$musteri_sorgu = mysqli_query($baglan, "SELECT * FROM musteriler WHERE mail='".$mail."' AND sifre='".$sifre."' AND rol_id=3");
if (mysqli_num_rows($musteri_sorgu) > 0) {
    $row = mysqli_fetch_assoc($musteri_sorgu);

    $_SESSION['musteriLogin'] = array(
        "musteri_id" => $row["musteri_id"],
        "rol_id" => $row["rol_id"],
        "ad" => $row["ad"],
        "soyad" => $row["soyad"],
        "mail" => $row["mail"],
        "sifre" => $row["sifre"]
    );
    header("Location: musteri_index.php");
   
} 
else{
    echo "<script>alert('Kullanıcı bilgileri hatalıdır.'); window.location.href='giris.html';</script>";
   

}

$admin_sorgu = mysqli_query($baglan, "SELECT * FROM adminler WHERE mail='".$mail."' AND sifre='".$sifre."' AND rol_id=1");

if (mysqli_num_rows($admin_sorgu) > 0) {
    $row = mysqli_fetch_assoc($admin_sorgu);

    $_SESSION['adminLogin'] = array(
        "admin_id" => $row["admin_id"],
        "rol_id" => $row["rol_id"],
        "ad" => $row["ad"],
        "soyad" => $row["soyad"],
        "mail" => $row["mail"],
        "sifre" => $row["sifre"]
    );
    
    header("Location: dashboard.php");
   
} 

}
?>

