<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();
// Banka bilgilerini veritabanından al
$terzi_id = $_SESSION['login']['terzi_id'];
$sql = "SELECT bankalar.banka_adi, banka_bilgileri.hesap_no, banka_bilgileri.iban FROM bankalar, banka_bilgileri WHERE bankalar.banka_id=banka_bilgileri.banka_id and terzi_id = $terzi_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['login']['banka_adi'] = $row['banka_adi'];
    $_SESSION['login']['hesap_no'] = $row['hesap_no'];
    $_SESSION['login']['iban'] = $row['iban'];
}

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="terzi-css/banka-bilgi.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>



</head>

<body>
    <div class="sidebar">
        <a href="terzi-paneli.php">
            <div class="sidebar-logo"><img src="terzi-img/tc.PNG" alt="Tailor Crafts"> </div>
        </a>
        <div class="liste">
            <ul>
                <li>
                    <div class="left-menu-item">
                        <img src="terzi-img/resume.png" width="30px" height="30px" alt=""><a
                            href="terzi-bilgi.php">Bilgilerim</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item">
                        <img src="terzi-img/file.png" width="30px" height="30px" alt=""><a
                            href="terzi-belge.php">Belgelerim</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item"><img src="terzi-img/siparisler.png" width="30px" height="30px" alt=""><a
                            href="terzi-siparis.php">Siparişlerim</a></div>
                </li>
                <li>
                    <div class="left-menu-item"><img src="terzi-img/siparisler.png" width="30px" height="30px" alt=""><a
                            href="terzi-analiz.php">Analiz</a></div>
                </li>
                <hr>
                <li><a href="cikis.php"><i class='bx bx-log-out-circle'>Çıkış</i></a></li>
            </ul>
        </div>
    </div>
    <section>
        <header>
            <div class="hosgeldin">
                <h4>Hoşgeldin Terzi, <span><?php
                if (isset($_SESSION['login']['ad'])) {
                    echo $_SESSION['login']['ad'];
                } else {
                    echo "Giriş yapmış bir kullanıcı bulunamadı.";
                }
                ?></span></h4>

            </div>

            <div class="left-menu-item">
                <img src="terzi-img/terziler.png" width="30px" height="30px" alt=""> <span>Terzi Paneli</span>
            </div>


        </header>
        <article>
            <div class="yazi">
                <h2>Bilgilerim</h2>
                <div class="navbar">
                    <ul>
                        <li>
                            <a href="terzi-bilgi.php" class="navbar-">Adres Bilgileri</a>
                        </li>

                        <li>
                            <a href="iletisim.php" class="navbar-">İletişim Bilgileri</a>
                        </li>

                        <li>
                            <a href="terzi-vergi.php" class="navbar-">Vergi Bilgileri</a>
                        </li>
                        <li>
                            <a href="banka-bilgi.php" class="navbar-a">Banka Bilgileri</a>
                        </li>
                        
                    </ul>

                </div>

            </div>
            <div class="adres-bilgileri">
                <div class="adres-bilgi-yazi">
                    <h4>Banka Bilgileri</h4>
                </div>
                <div class="form">
                    <form action="terzi-banka-kontrol.php" class="form" method="post">
                        <select id="banka_id" name="banka_id">
                            <option disabled selected>Banka Adı</option>
                            <option value="1">Akbank</option>
                            <option value="2">Denizbank</option>
                            <option value="3">Garanti Bankası</option>
                            <option value="4">Halkbank</option>
                            <option value="5">HSBC Bankası</option>
                            <option value="6">İş Bankası</option>
                            <option value="7">Şekerbank</option>
                            <option value="8">Vakıfbank</option>
                            <option value="9">Yapı Kredi</option>
                            <option value="10">Ziraat Bankası</option>
                            <option value="11">QNB Finansbank</option>
                            
                        </select>           
                        <input type="number" name="hesap_no" required placeholder="Hesap Numarası">
                        <input type="number" name="iban" required placeholder="IBAN">
                        <input type="submit" name="submit" value="Güncelle" class="kayit-ol">


                    </form>
                </div>
                <div class="kayitli-bilgiler">
                    <h4>Banka Bilgileri</h4>
                    <hr>
                    <span>
                    <?php
error_reporting(0);
if (isset($_SESSION['login'])) {
    echo "Banka Adı : " . $_SESSION['login']['banka_adi'] . "<br>";
    echo "Hesap Numarası : " . $_SESSION['login']['hesap_no'] . "<br>";
    echo "IBAN : " . $_SESSION['login']['iban'] . "<br>";
} else {
    echo "Giriş yapmış bir kullanıcı bulunamadı.";
}
?>

                    </span>

                </div>
            </div>



        </article>
    </section>


</body>

</html>