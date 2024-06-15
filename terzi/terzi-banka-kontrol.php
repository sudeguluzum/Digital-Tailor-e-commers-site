<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();
include ("baglan.php");
if (isset($_POST['banka_id'])) {
    

    $terzi_id = $_SESSION['login']['terzi_id'];

    // Formdan gelen verileri al
    $banka_id = $_POST['banka_id'];
    $hesap_no = $_POST['hesap_no'];
    $iban = $_POST['iban'];

    // Veritabanında güncelleme yap
    $stmt = $conn->prepare("INSERT INTO banka_bilgileri (terzi_id, banka_id, hesap_no, iban) 
    VALUES ('".$terzi_id."',".$banka_id.",".$hesap_no.",".$iban.")");

    if ($stmt->execute()) {
        echo '<script type="text/javascript">
            alert("Bilgileriniz başarıyla eklendi.");
            location.href = "banka-bilgi.php";
            </script>';
    } else {
        echo "Hata: " . $stmt->error;
    }

    // Sorguyu kapat
    $stmt->close();

    // Veritabanı bağlantısını kapatma
    $conn->close();


}




