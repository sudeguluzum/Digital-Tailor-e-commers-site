<?php
$conn= new mysqli('localhost','root','','dijital_terzi');
session_start();
include("baglan.php");

if(isset($_POST['submit'])){

    
    
    $musteri_id = $_SESSION['musteriLogin']['musteri_id']; 
    
    $il_id = $_POST['il_id'];
    $ilce = $_POST['ilce'];
    $mahalle_ad = $_POST['mahalle_ad'];
    $acik_adres = $_POST['acik_adres'];
    
     // Veritabanında güncelleme yap
     $stmt = $conn->prepare("INSERT INTO adres (musteri_id, il_id, ilce, mahalle_ad, acik_adres) 
     VALUES ('".$musteri_id."',".$il_id.",'".$ilce."','".$mahalle_ad."','".$acik_adres."')");

    if ($stmt->execute()) {
        echo '<script type="text/javascript">
        alert("Bilgileriniz başarıyla kaydedildi.");
        location.href = "sepet.php";
        </script>';
        header("Location: sepet.php");
        exit;
    } else {
        echo "Hata: " . $stmt->error;
    }
    
    // Sorguyu kapat
    $stmt->close();
    
    // Veritabanı bağlantısını kapatma
    $conn->close();

    
}




?>
