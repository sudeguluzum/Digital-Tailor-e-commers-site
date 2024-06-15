<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if (isset($_POST['terzi_id'])) {
    $terzi_id = $_POST['terzi_id'];

    $stmt = $conn->prepare("UPDATE terzi SET durum_id = 2 WHERE terzi_id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $terzi_id); 
        
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
