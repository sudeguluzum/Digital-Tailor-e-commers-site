<?php
$conn= new mysqli('localhost','root','','dijital_terzi');
session_start();
include("baglan.php");

if(isset($_POST['submit'])){


    $terzi_id = $_SESSION['login']['terzi_id']; 
    
    // Formdan gelen verileri al
    $magaza_adi = $_POST['magaza_adi'];
    $il_id = $_POST['il_id'];
    $ilce = $_POST['ilce'];
    $mahalle = $_POST['mahalle'];
    $adres_detay = $_POST['adres_detay'];
    
    // Veritabanında güncelleme yap
    $stmt = $conn->prepare("INSERT INTO terzi_adres (terzi_id, magaza_adi, il_id, ilce, mahalle, adres_detay) 
    VALUES ('".$terzi_id."','".$magaza_adi."',".$il_id.",'".$ilce."','".$mahalle."','".$adres_detay."')");
    
    if ($stmt->execute()) {
        echo '<script type="text/javascript">
        alert("Bilgileriniz başarıyla kaydedildi.");
        location.href = "terzi-bilgi.php";
        </script>';
    } else {
        echo "Hata: " . $stmt->error;
    }
    
    // Sorguyu kapat
    $stmt->close();
    
    // Veritabanı bağlantısını kapatma
    $conn->close();

    
}




?>
