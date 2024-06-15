<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "kullanici_adi";
$password = "sifre";
$database = "veritabani_adi";

// Bağlantı oluşturma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

// Oturum başlatma
session_start();

// Giriş yapmış terzi bilgilerini al
$terzi_id = $_SESSION['terzi_id']; // Terzi id'sini oturumdan alın

// Dosya yükleme işlemi
if(isset($_POST["submit"])) {
    $tailor_crafts_sozlesmesi = $_FILES['document']['name'][0];
    $vergi_levhasi = $_FILES['document']['name'][1];
    $imza_sirkuleri = $_FILES['document']['name'][2];
    
    // Dosya yollarını belirleme
    $tailor_crafts_sozlesmesi_yol = "uploads/" . basename($tailor_crafts_sozlesmesi);
    $vergi_levhasi_yol = "uploads/" . basename($vergi_levhasi);
    $imza_sirkuleri_yol = "uploads/" . basename($imza_sirkuleri);
    
    // Dosyaları belirlenen yere yükleme
    move_uploaded_file($_FILES['document']['tmp_name'][0], $tailor_crafts_sozlesmesi_yol);
    move_uploaded_file($_FILES['document']['tmp_name'][1], $vergi_levhasi_yol);
    move_uploaded_file($_FILES['document']['tmp_name'][2], $imza_sirkuleri_yol);
    
    // Veritabanına dosya yollarını kaydetme
    $sql = "INSERT INTO terzi (terzi_id, tailor_crafts_sozlesmesi, vergi_levhasi, imza_sirkuleri)
            VALUES ('$terzi_id', '$tailor_crafts_sozlesmesi_yol', '$vergi_levhasi_yol', '$imza_sirkuleri_yol')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Belgeler başarıyla yüklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
