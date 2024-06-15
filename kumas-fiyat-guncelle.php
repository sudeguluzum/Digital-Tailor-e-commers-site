<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if (isset($_POST['kumas_id']) && isset($_POST['fiyat'])) {
    $kumas_id = $_POST['kumas_id'];
    $fiyat = $_POST['fiyat'];
    echo $fiyat;
    // Veritabanında güncelleme yap
    $stmt = $conn->prepare("UPDATE kumaslar SET fiyat = ? WHERE kumas_id = ?");
    
    if ($stmt) {
        // Parametreleri bağla ("di" = double ve integer)
        $stmt->bind_param("di", $fiyat, $kumas_id); 
        
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
            alert("Fiyat başarıyla güncellendi.");
            location.href = "dashboard-kumaslar.php";
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
