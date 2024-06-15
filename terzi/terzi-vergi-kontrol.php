<?php
$conn= new mysqli('localhost','root','','dijital_terzi');
session_start();
include("baglan.php");
if(isset( $_POST['vergi_no'])){

    $terzi_id = $_SESSION['login']['terzi_id']; 
    
    // Formdan gelen verileri al
    $vergi_no = $_POST['vergi_no'];
    $t_sicil_no = $_POST['t_sicil_no'];
    $mersis_no = $_POST['mersis_no'];
    
    // Veritabanında güncelleme yap
    $stmt = $conn->prepare("UPDATE terzi SET vergi_no=$vergi_no, t_sicil_no=$t_sicil_no, mersis_no=$mersis_no WHERE terzi_id=$terzi_id");
    
    if ($stmt->execute()) {
        echo '<script type="text/javascript">
        alert("Bilgileriniz başarıyla güncellendi.");
        location.href = "terzi-vergi.php";
        </script>';
    } else {
        echo "Hata: " . $stmt->error;
    }
    
    // Sorguyu kapat
    $stmt->close();
    
    // Veritabanı bağlantısını kapatma
    $conn->close();

    
}




?>
