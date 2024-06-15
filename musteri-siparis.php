<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();
if (isset($_SESSION['musteriLogin'])) {
    $musteriLogin = $_SESSION['musteriLogin'];
    $musteri_id = $musteriLogin['musteri_id'];
} else {
    echo "musteriLogin oturum değişkeni tanımlı değil.";
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailor Crafts</title>

    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="musteri-css/musteri-siparis.css">

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">



</head>

<body id="top">

    <!-- 
    - #HEADER
  -->

    <header class="header">
        <div class="header-top" data-header>
            <div class="container">

                <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                    <span class="line line-1"></span>
                    <span class="line line-2"></span>
                    <span class="line line-3"></span>
                </button>

                <div class="input-wrapper">
                    <input type="search" name="search" placeholder="Aradığınız Ürün" class="search-field">

                    <button class="search-submit" aria-label="search">
                        <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
                    </button>
                </div>

                <a href="musteri_index.php" class="logo">
                    <img src="img/tc.PNG" width="179" height="26" alt="Tailor Crafts">
                </a>

                <div class="header-actions">

                    <a href="musteri-bilgi.php"> <button class="header-action-btn" aria-label="cart item">
                            <ion-icon name="person-outline" aria-hidden="true" aria-hidden="true"></ion-icon></button></a>

                    <a href="musteri-siparis.php"> <button class="header-action-btn" aria-label="cart item">
                            <ion-icon name="file-tray-stacked-outline"></ion-icon></button></a>
                    <a href="sepet.php"> <button class="header-action-btn" aria-label="cart item">
                            <ion-icon name="bag-handle-outline"></ion-icon></button> </a>

                    <a href="cikis.php"> <button class="header-action-btn" aria-label="cart item">
                            <ion-icon name="log-out-outline"></ion-icon></button></a>

                </div>

                <nav class="navbar">
                    <ul class="navbar-list">
                        <li>
                            <a href="musteri_index.php" class="navbar-link has-after">Anasayfa</a>
                        </li>
                        <li>
                            <a href="#" class="navbar-link" data-nav-link>Tasarla</a>
                            <ul>
                                <li> <a href="ust-kiyafet.php" class="navbar-link has-after">Üst</a></li>
                                <li> <a href="alt-kiyafet.php" class="navbar-link has-after">Alt</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="musteri_index.php" class="navbar-link has-after">Terziler</a>
                        </li>

                        <li>
                            <a href="musteri_index.php" class="navbar-link has-after">İletişim</a>
                        </li>

                        <li>
                            <a href="terzi/terzi-kayit.html" class="navbar-link has-after">Tailor Crafts'ta Satış Yap</a>
                        </li>



                    </ul>
                </nav>

            </div>
        </div>

    </header>

    <!-- 
    - #MOBILE NAVBAR
  -->

    <div class="sidebar">
        <div class="mobile-navbar" data-navbar>

            <div class="wrapper">

                <a href="musteri_index.php" class="logo">
                    <img src="img/tc.PNG" width="179" height="26" alt="Tailor Crafts">
                </a>

                <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                    <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                </button>
            </div>

            <ul class="navbar-list">

                <li>
                    <a href="musteri_index.php" class="navbar-link" data-nav-link>Anasayfa</a>
                </li>
                <li>
                    <a href="musteri_index.php" class="navbar-link" data-nav-link>Tasarla</a>
                </li>

                <li>
                    <a href="musteri_index.php" class="navbar-link" data-nav-link>Terziler</a>
                </li>

                <li>
                    <a href="musteri_index.php" class="navbar-link" data-nav-link>İletişim</a>
                </li>

                <li>
                    <a href="satici-formu.html" class="navbar-link" data-nav-link>Tailor Crafts'ta Satış Yap</a>
                </li>



            </ul>

        </div>

        <div class="overlay" data-nav-toggler data-overlay></div>
    </div>

    <section class="main">
        <h2>Tüm Siparişlerim</h2>

        <div class="sepet">
            <table>
                <thead style="height: 60px;">
                    <tr>
                        <th>Sipariş Numarası</th>
                        <th>Sipariş Tarihi</th>
                        <th>Kıyafet Detayı</th>
                        <th>Kumaş Detayı</th>
                        <th>Toplam Fiyat</th>
                        <th>Sipariş Durumu</th>
                    </tr>
                </thead>
                <tbody style="height: 200px;">
                    <?php
                    $sql = "SELECT 
                    siparisler.siparis_id, 
                    kiyafet.kiyafet_id, 
                    kiyafet.detay, 
                    kumaslar.kumas_id, 
                    kumaslar.kumas_adi, 
                    siparisler.beden_id, 
                    concat(terzi.ad,' ',terzi.soyad) as terzi, 
                    siparisler.total_fiyat, 
                    siparisler.siparis_tarihi, 
                    siparis_durum.durum_ad 
                FROM 
                    siparisler, 
                    kumaslar, 
                    kiyafet, 
                    siparis_durum, 
                    terzi 
                WHERE 
                    siparisler.kumas_id=kumaslar.kumas_id 
                    AND siparisler.durum_id=siparis_durum.durum_id
                    AND siparisler.kiyafet_id=kiyafet.kiyafet_id 
                    AND terzi.terzi_id=siparisler.terzi_id 
                    AND musteri_id = $musteri_id 
                    
                GROUP BY 
                    siparisler.siparis_id";
                    $fire = mysqli_query($conn, $sql);

                    if ($fire === false) {
                        echo "SQL sorgusu çalıştırılırken bir hata oluştu: " . mysqli_error($conn);
                    }

                    while ($result = mysqli_fetch_assoc($fire)) :
                    ?>
                        <tr>
                            <td><?php echo $result['siparis_id']; ?></td>
                            <td><?php echo $result['siparis_tarihi']; ?></td>
                            <td><?php echo $result['detay']; ?></td>
                            <td> <?php echo $result['kumas_adi']; ?></td>
                            <td><?php echo $result['total_fiyat']; ?>TL</td>
                            <td><?php echo $result['durum_ad']; ?></td>
                        </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- 
    - #FOOTER
  -->

    <footer class="footer" data-section>
        <div class="container">

            <div class="footer-top">

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">İletişim</p>
                    </li>


                    <li>
                        <p class="footer-list-text bold">+90 535 256 45 93</p>
                    </li>

                    <li>
                        <p class="footer-list-text">sudeguluzum@gmail.com</p>
                    </li>

                </ul>

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Tailor Crafts</p>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Hakkımızda</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Hesabım</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Politikalarımız</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Taiolor Crafts'ta Satış Yap</a>
                    </li>

                </ul>

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Yardım</p>
                    </li>

                    <li>
                        <a href="#" class="footer-link">Sıkça Sorulan Sorular</a>
                    </li>

                    <li>
                        <a href="#" class="footer-link">İptal ve İade Prosedürü</a>
                    </li>
                </ul>

                <ul class="footer-list">

                    <li>
                        <p class="footer-list-title">Güvenli Alışveriş</p>
                    </li>

                    <li>
                        <img src="img/mastercard.png" width="30" height="28" alt="available all payment method">
                    </li>

                    <li>
                        <img src="img/visa.png" width="30" height="28" alt="available all payment method">
                    </li>
                </ul>

            </div>

            <div class="footer-bottom">

                <div class="wrapper">
                    <p class="copyright">
                        &copy; 2024 by Sude Gül ÜZÜM
                    </p>

                    <ul class="social-list">

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a>
                        </li>

                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-youtube"></ion-icon>
                            </a>
                        </li>

                    </ul>
                </div>

                <a href="index.html" class="logo">
                    <img src="img/tc.PNG" width="179" height="26" loading="lazy" alt="Tailor Crafts">
                </a>

            </div>

        </div>
    </footer>

    <!-- 
    - #BACK TO TOP
  -->

    <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="arrow-up" aria-hidden="true"></ion-icon>
    </a>

    <!-- 
    - custom js link
  -->
    <script src="script.js" defer></script>

    <!-- 
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>