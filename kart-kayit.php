<?php
session_start();
include("baglan.php");

// Veritabanı bağlantısını yap
$conn = mysqli_connect('localhost', 'root', '', 'dijital_terzi');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Eğer müşteri oturumu yoksa giriş sayfasına yönlendir
    if (!isset($_SESSION['musteriLogin'])) {
        header("Location: musteri-giris.php");
        exit();
    }

    // Müşteri ID'sini al
    $musteri_id = $_SESSION['musteriLogin']['musteri_id'];

    // Post verilerini al
    $kart_no = $_POST['kart_no'];
    $ad_soyad = $_POST['ad_soyad'];
    $ay = $_POST['ay'];
    $yil = $_POST['yil'];
    $CVV = $_POST['CVV'];
    
    // Kart bilgilerini veritabanına ekle
    $sql = "INSERT INTO kartlar (musteri_id, kart_no, ad_soyad, ay, yil, CVV) 
    VALUES ('$musteri_id', '$kart_no', '$ad_soyad', '$ay', '$yil', '$CVV')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Ödeme Başarılı.'); window.location.href='musteri-siparis.php';</script>";
    } else {
        echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
} else {
    echo "musteriLogin oturum değişkeni tanımlı değil.";
}
?>
