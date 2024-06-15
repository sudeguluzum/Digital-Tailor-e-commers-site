<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if (isset($_SESSION['musteriLogin']['musteri_id'])) {
    $musteriLogin = $_SESSION['musteriLogin'];
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
    <link rel="stylesheet" href="musteri-css/musteri-bilgi.css">

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
                    <a href="satici-formu.php" class="navbar-link" data-nav-link>Tailor Crafts'ta Satış Yap</a>
                </li>

                

            </ul>

        </div>

        <div class="overlay" data-nav-toggler data-overlay></div>
    </div>

    <section class="main">
        
            <div class="fix-sidebar">
                <ul>
                    <li id="1"><a href="musteri-bilgi.php"><i class='bx bx-user'></i><span>Kullanıcı Bilgilerim</span></a></li>
                    <li id="2"><a href="musteri-adres.php"><i class='bx bx-map'></i><span>Adres Bilgilerim</span></a></li>
                    <li id="3"><a href="musteri-kart.php"><i class='bx bx-credit-card-alt'></i><span>Kart Bilgilerim</span></a></li>
                </ul>
            </div>

            <div class="right">
                <div id="member" class="member-form">
                    <h2>Kullanıcı Bilgilerim</h2>
                    <hr> <br>
                    <form action="update_userinfo.php" method="POST">
                        <label for="ad">Ad</label> <br>
                        <input type="text" id="ad" name="ad"><br>

                        <label for="soyad">Soyad</label> <br>
                        <input type="text" id="soyad" name="soyad"><br>

                        <label for="email">E-mail</label> <br>
                        <input type="email" id="email" name="email"><br>

                        <label for="telefon">Telefon Numarası</label> <br>
                        <input type="tel" id="telefon" name="telefon">
                        <br>

                        
                        <button class="buton">Güncelle</button>
                    </form>
                </div>


                <div class="password-form">
                    <h2>Parola Güncelle</h2>
                    <hr> <br>
                    <form action="password_update.php" method="POST">
                        <label for="password">Eski Parolan</label> <br>
                        <input type="password" id="oldpassword" name="oldpassword" required><br>

                        <label for="password">Yeni Parolan</label> <br>
                        <input type="password" id="newpassword" name="newpassword" required><br>

                        <label for="password">Yeni Parolan (Tekrar)</label> <br>
                        <input type="password" id="againpassword" name="againpassword" required><br>

                        <button class="buton">Güncelle</button>
                    </form>
                </div>
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