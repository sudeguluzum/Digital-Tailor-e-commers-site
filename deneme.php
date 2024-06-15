<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kıyafet Resmi</title>
</head>
<body>

<h1>Kıyafet Resmi</h1>

<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "dijital_terzi";

$conn = new mysqli($servername, $username, $password, $database);
// Bağlantı kontrolü
if ($conn->connect_error) {
  die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}
// kiyafet tablosundaki tüm resimleri al
$sql = "SELECT resim FROM kiyafet";
$result = $conn->query($sql);

// Eğer resimler varsa, her birini göster
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $resim_yolu = $row["resim"];
        echo '<img src="' . $resim_yolu . '" alt="kiyafet_resmi"><br>';
    }
} else {
    echo "Hiç resim bulunamadı.";
}
$conn->close();
?>


</body>
</html>
