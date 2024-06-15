<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if (isset($_POST['kiyafet_id']) && isset($_POST['fiyat'])) {
    $kiyafet_id = $_POST['kiyafet_id'];
    $fiyat = $_POST['fiyat'];
    echo $fiyat;
    // Veritabanında güncelleme yap
    $stmt = $conn->prepare("UPDATE kiyafet SET fiyat = ? WHERE kiyafet_id = ?");
    
    if ($stmt) {
        // Parametreleri bağla ("di" = double ve integer)
        $stmt->bind_param("di", $fiyat, $kiyafet_id); 
        
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
            alert("Fiyat başarıyla güncellendi.");
            location.href = "dashboard-urunler.php";
            </script>';
        } else {
            echo "Hata: " . $stmt->error;
        }
        
        $stmt->close(); // İfadeyi kapat
    } else {
        echo "Hata: " . $conn->error;
    }
}
$conn->close(); // Bağlantıyı kapat
?>
