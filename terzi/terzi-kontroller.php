<?php
session_start();
include ("baglan.php");

if ($baglan) {
    echo $_POST["mail"];
    if (isset($_POST["mail"], $_POST["sifre"])) { // POST isteği var mı?
        $mail = strip_tags(trim($_POST["mail"]));
        $sifre = strip_tags(trim($_POST["sifre"]));

        if (!empty($mail) && !empty($sifre)) { // Mail ve şifre boş değil mi?
            // Terzi sorgusu
            $terzi_sorgu = mysqli_query($baglan, "SELECT * FROM terzi WHERE mail='" . $mail . "' AND sifre='" . $sifre . "' AND rol_id=2");


            print_r($terzi_sorgu);
            if (mysqli_num_rows($terzi_sorgu) > 0) {
                $row = mysqli_fetch_assoc($terzi_sorgu);

                $_SESSION['login'] = array(
                    "terzi_id" => $row["terzi_id"],
                    "rol_id" => $row["rol_id"],
                    "tc" => $row["tc"],
                    "ad" => $row["ad"],
                    "soyad" => $row["soyad"],
                    "tel_no" => $row["tel_no"],
                    "mail" => $row["mail"],
                    "sifre" => $row["sifre"],
                    "d_tarihi" => $row["d_tarihi"],
                    "magaza_adi" => $row["magaza_adi"],
                    "vergi_no" => $row["vergi_no"],
                    "t_sicil_no" => $row["t_sicil_no"],
                    "mersis_no" => $row["mersis_no"]
                );


                header("Location: terzi-paneli.php");
                exit;
            }




            // Eğer hiçbir kullanıcı eşleşmiyorsa
            echo '<script type="text/javascript">
                alert("E-posta ya da Şifre Hatalı");
                location.href = "terzi-giris.html";
                </script>';
            exit;
        } else {
            echo "E-posta ya da şifre boş olamaz";
            exit;
        }
    } else {
        echo "Post Hatası";
        exit;
    }
} else {
    echo "Veritabanına Bağlanmadı";
    exit;
}
?>