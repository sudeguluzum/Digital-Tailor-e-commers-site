<?php
include("baglan.php");

// İl seçildiğinde
if(isset($_POST["il"])){
    $il_id = $_POST["il"];

    // İlçeleri veritabanından getir
    $ilce_sorgu = mysqli_query($baglan, "SELECT * FROM ilceler WHERE il_id = $il_id");

    // Eğer ilçe varsa
    if(mysqli_num_rows($ilce_sorgu) > 0){
        echo "<option value=''>İlçe Seçiniz</option>";
        while($ilce = mysqli_fetch_assoc($ilce_sorgu)){
            echo "<option value='".$ilce['ilce_id']."'>".$ilce['ilce_ad']."</option>";
        }
    }else{
        echo "<option value=''>İlçe bulunamadı</option>";
    }
}
?>



