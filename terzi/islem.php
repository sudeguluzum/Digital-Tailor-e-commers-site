<?php
// Veritabanı bağlantısı
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');

// Hata kontrolü
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// POST ile gelen sipariş ID'sini al
$siparis_id = $_POST['siparis_id'];

// Siparişin durumunu güncelle
$sql = "UPDATE siparisler SET durum_id = 2 WHERE siparis_id = $siparis_id";

if ($conn->query($sql) === TRUE) {
    echo "Sipariş işleme alındı.";
} else {
    echo "Sipariş işleme alınamadı: " . $conn->error;
}

// Bağlantıyı kapat
$conn->close();
?>
