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

    // Formdan gelen verileri al

    $terzi_id = $_POST['terzi_id'];
    $kiyafet_id = $_POST['kiyafet_id'];
    $kumas_id = $_POST['kumas_id'];
    $beden_id = $_POST['beden_id'];
    $total_fiyat = $_POST['total_fiyat'];
    $siparis_tarihi = date('Y-m-d H:i:s');
    $durum_id = 1; // Varsayılan durum ID'si

    // Siparişi veritabanına ekleme sorgusu
    $sql = "INSERT INTO siparisler (musteri_id, terzi_id, kiyafet_id, kumas_id, beden_id, total_fiyat, siparis_tarihi, durum_id) 
            VALUES ('$musteri_id', '$terzi_id', '$kiyafet_id', '$kumas_id', '$beden_id', '$total_fiyat', '$siparis_tarihi', '$durum_id')";

    if (mysqli_query($conn, $sql)) {
        // Sipariş başarılıysa sipariş sayfasına yönlendir
        header("Location: kart.php");
    } else {
        // Hata varsa hata mesajı göster
        echo "Hata: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Veritabanı bağlantısını kapat
    mysqli_close($conn);
}
?>
