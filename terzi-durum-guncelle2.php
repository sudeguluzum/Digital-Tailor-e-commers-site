<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if (isset($_POST['terzi_id'])) {
    $terzi_id = $_POST['terzi_id'];

    // Hangi butona basıldığını kontrol et
    if (isset($_POST['btn1'])) {
        // btn1'e basıldığında durum_id=2 iken 3 olsun
        $new_durum_id = 3;
    } elseif (isset($_POST['btn2'])) {
        // btn2'ye basıldığında durum_id=2 iken 4 olsun
        $new_durum_id = 4;
    }

    // Durum ID'yi güncelle
    $stmt = $conn->prepare("UPDATE terzi SET durum_id = ? WHERE terzi_id = ?");
    
    if ($stmt) {
        $stmt->bind_param("ii", $new_durum_id, $terzi_id); 
        
        if ($stmt->execute()) {
            echo '<script type="text/javascript">
            alert("Durum başarıyla güncellendi.");
            location.href = "dashboard-terzi.php";
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
