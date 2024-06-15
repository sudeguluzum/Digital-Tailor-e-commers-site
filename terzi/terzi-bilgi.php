<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();
// Banka bilgilerini veritabanından al
if (isset($_SESSION['login'])) {
    $terzi_id = $_SESSION['login']['terzi_id'];
    $sql = "SELECT terzi_adres.magaza_adi, iller.il_ad, terzi_adres.ilce, terzi_adres.mahalle, terzi_adres.adres_detay 
            FROM terzi_adres 
            INNER JOIN iller ON iller.il_id = terzi_adres.il_id 
            WHERE terzi_id = $terzi_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login']['magaza_adi'] = $row['magaza_adi'];
        $_SESSION['login']['il_ad'] = $row['il_ad'];
        $_SESSION['login']['ilce'] = $row['ilce'];
        $_SESSION['login']['mahalle'] = $row['mahalle'];
        $_SESSION['login']['adres_detay'] = $row['adres_detay'];
    }
} else {
    echo "Kayıtlı adres bulunmamaktadır.";
}

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="terzi-css/terzi-bilgi.css">

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
                        <img src="terzi-img/resume.png" width="30px" height="30px" alt=""><a href="terzi-bilgi.php">Bilgilerim</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item">
                        <img src="terzi-img/file.png" width="30px" height="30px" alt=""><a href="terzi-belge.php">Belgelerim</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item"><img src="terzi-img/siparisler.png" width="30px" height="30px" alt=""><a href="terzi-siparis.php">Siparişlerim</a></div>
                </li>
                <li>
                    <div class="left-menu-item"><img src="terzi-img/siparisler.png" width="30px" height="30px" alt=""><a href="terzi-analiz.php">Analiz</a></div>
                </li>



                <hr>
                <li><a href="cikis.php"><i class='bx bx-log-out-circle'>Çıkış</i></a></li>
            </ul>
        </div>
    </div>
    <section>
        <header>
            <div class="hosgeldin">
                <h4>Hoşgeldin Terzi, <span>
                        <?php
                        if (isset($_SESSION['login']['ad'])) {
                            echo $_SESSION['login']['ad'];
                        } else {
                            echo "Giriş yapmış bir kullanıcı bulunamadı.";
                        }
                        ?>
                    </span></h4>

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
                            <a href="terzi-bilgi.php" class="navbar-a">Adres Bilgileri</a>
                        </li>

                        <li>
                            <a href="iletisim.php" class="navbar-link has-after">İletişim Bilgileri</a>
                        </li>

                        <li>
                            <a href="terzi-vergi.php" class="navbar-link has-after">Vergi Bilgileri</a>
                        </li>
                        <li>
                            <a href="banka-bilgi.php" class="navbar-link has-after">Banka Bilgileri</a>
                        </li>

                    </ul>

                </div>

            </div>
            <div class="adres-bilgileri">
                <div class="adres-bilgi-yazi">
                    <h4>Adres Bilgileri</h4>
                </div>
                <div class="form">
                    <form action="terzi-adres-kontrol.php" class="form" method="post">


                        <input type="text" name="magaza_adi" required placeholder="Mağaza Adı" required>

                        <select id="il_id" name="il_id" required>
                            <option value="il" disabled selected hidden>İl</option>
                            <option value="1">Adana</option>
                            <option value="2">Adıyaman</option>
                            <option value="3">Afyonkarahisar</option>
                            <option value="4">Ağrı</option>
                            <option value="5">Amasya</option>
                            <option value="6">Ankara</option>
                            <option value="7">Antalya</option>
                            <option value="75">Ardahan</option>
                            <option value="8">Artvin</option>
                            <option value="9">Aydın</option>
                            <option value="10">Balıkesir</option>
                            <option value="74">Bartın</option>
                            <option value="72">Batman</option>
                            <option value="69">Bayburt</option>
                            <option value="11">Bilecik</option>
                            <option value="12">Bingöl</option>
                            <option value="13">Bitlis</option>
                            <option value="14">Bolu</option>
                            <option value="15">Burdur</option>
                            <option value="16">Bursa</option>
                            <option value="17">Çanakkale</option>
                            <option value="18">Çankırı</option>
                            <option value="19">Çorum</option>
                            <option value="20">Denizli</option>
                            <option value="21">Diyarbakır</option>
                            <option value="81">Düzce</option>
                            <option value="22">Edirne</option>
                            <option value="23">Elazığ</option>
                            <option value="24">Erzincan</option>
                            <option value="25">Erzurum</option>
                            <option value="26">Eskişehir</option>
                            <option value="27">Gaziantep</option>
                            <option value="28">Giresun</option>
                            <option value="29">Gümüşhane</option>
                            <option value="30">Hakkâri</option>
                            <option value="31">Hatay</option>
                            <option value="76">Iğdır</option>
                            <option value="32">Isparta</option>
                            <option value="34">İstanbul</option>
                            <option value="35">İzmir</option>
                            <option value="46">Kahramanmaraş</option>
                            <option value="78">Karabük</option>
                            <option value="70">Karaman</option>
                            <option value="36">Kars</option>
                            <option value="37">Kastamonu</option>
                            <option value="38">Kayseri</option>
                            <option value="79">Kilis</option>
                            <option value="71">Kırıkkale</option>
                            <option value="39">Kırklareli</option>
                            <option value="40">Kırşehir</option>
                            <option value="41">Kocaeli</option>
                            <option value="42">Konya</option>
                            <option value="43">Kütahya</option>
                            <option value="44">Malatya</option>
                            <option value="45">Manisa</option>
                            <option value="47">Mardin</option>
                            <option value="33">Mersin</option>
                            <option value="48">Muğla</option>
                            <option value="49">Muş</option>
                            <option value="50">Nevşehir</option>
                            <option value="51">Niğde</option>
                            <option value="52">Ordu</option>
                            <option value="80">Osmaniye</option>
                            <option value="53">Rize</option>
                            <option value="54">Sakarya</option>
                            <option value="55">Samsun</option>
                            <option value="56">Siirt</option>
                            <option value="57">Sinop</option>
                            <option value="58">Sivas</option>
                            <option value="63">Şanlıurfa</option>
                            <option value="73">Şırnak</option>
                            <option value="59">Tekirdağ</option>
                            <option value="60">Tokat</option>
                            <option value="61">Trabzon</option>
                            <option value="62">Tunceli</option>
                            <option value="64">Uşak</option>
                            <option value="65">Van</option>
                            <option value="77">Yalova</option>
                            <option value="66">Yozgat</option>
                            <option value="67">Zonguldak</option>
                        </select>

                        <input type="text" name="ilce" required placeholder="İlçe">
                        <input type="text" name="mahalle" required placeholder="Mahalle">

                        <input type="text" name="adres_detay" id="adres_detay" required placeholder="Adres Detay">

                        <input type="submit" name="submit" value="Kaydet" class="kayit-ol">


                    </form>
                </div>
                <div class="kayitli-bilgiler">
                    <h4>Kayıtlı Adres</h4>
                    <hr>
                    <span>
                        <?php
                        error_reporting(0);
                        if (isset($_SESSION['login']['terzi_id'])) {
                            echo "Mağaza Adı: " . $_SESSION['login']['magaza_adi'] . "<br>";
                            echo "İl : " . $_SESSION['login']['il_ad'] . "<br>";
                            echo "İlçe : " . $_SESSION['login']['ilce'] . "<br>";
                            echo "Mahalle : " . $_SESSION['login']['mahalle'] . "<br>";
                            echo "Adres Detay : " . $_SESSION['login']['adres_detay'] . "<br>";
                        } else {
                            echo "Kayıtlı adres bulunmamaktadır.";
                        }

                     ?>


                    </span>

                </div>
            </div>



        </article>
    </section>


</body>

</html>