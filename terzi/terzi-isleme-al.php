<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if (isset($_POST['siparis_id'])) {
    $siparis_id = $_POST['siparis_id'];
    $yeni_durum_id = 2; // durum_id'yi 2 olarak güncelliyoruz

    $stmt = $conn->prepare("UPDATE siparisler SET durum_id = ? WHERE siparis_id = ?");
    
    if ($stmt) {
        $stmt->bind_param("ii", $yeni_durum_id, $siparis_id); 
        
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
            alert("Durum başarıyla güncellendi.");
            location.href = "terzi-siparis.php";
            </script>';
        } else {
            echo "Hata: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Hata: " . $conn->error;
    }
}

$conn->close();
?>
