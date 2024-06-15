<?php
$conn = mysqli_connect('localhost', 'root', '', 'dijital_terzi');
$kiyafet_id = $_GET['kiyafet_id'];
$kumas_id = $_GET['kumas_id'];


// Kiyafet bilgilerini al
$kiyafet_sorgu = "SELECT * FROM kiyafet WHERE kiyafet_id = $kiyafet_id";
$kiyafet_sonuc = mysqli_query($conn, $kiyafet_sorgu);
$kiyafet = mysqli_fetch_assoc($kiyafet_sonuc);

// Kumas bilgilerini al
$kumas_sorgu = "SELECT * FROM kumaslar WHERE kumas_id = $kumas_id";
$kumas_sonuc = mysqli_query($conn, $kumas_sorgu);
$kumas = mysqli_fetch_assoc($kumas_sonuc);


// Toplam fiyatı hesapla
$toplam_fiyat = $kiyafet['fiyat'] + $kumas['fiyat'];

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION["form_data"] = array(
    "selected_size" => $_POST["size"],
    "kumas_id" => $kumas['kumas_id'],
    "kiyafet_id" => $kiyafet['kiyafet_id']
  );
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tailor Crafts</title>

  <link rel="shortcut icon" type="image/x-icon" href="data:image/x-icon;,">
  <script type="importmap">
    {
        "imports": {
          "three": "https://unpkg.com/three@0.161.0/build/three.module.js",
          "three/addons/": "https://unpkg.com/three@0.161.0/examples/jsm/"
        }
      }
    </script>
  <link rel="stylesheet" href="styles.css" />
  <script>
    var kiyafet_id = <?= $_GET['kiyafet_id'] ?>;
    var kumas_id = <?= $_GET['kumas_id'] ?>;
  </script>
  <script type="module" src="main3.js"></script>


  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="detay.css">

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

        <a href="index.html" class="logo">
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
              <a href="index.html" class="navbar-link has-after">Anasayfa</a>
            </li>
            <li>
              <a href="#" class="navbar-link" data-nav-link>Tasarla</a>
              <ul>
                <li> <a href="ust-kiyafet.php" class="navbar-link has-after">Üst</a></li>
                <li> <a href="alt-kiyafet.php" class="navbar-link has-after">Alt</a></li>

              </ul>
            </li>

            <li>
              <a href="#terzi_brand" class="navbar-link has-after">Terziler</a>
            </li>

            <li>
              <a href="#shop" class="navbar-link has-after">İletişim</a>
            </li>

            <li>
              <a href="#offer" class="navbar-link has-after">Tailor Crafts'ta Satış Yap</a>
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

        <a href="#" class="logo">
          <img src="img/tc.PNG" width="179" height="26" alt="Tailor Crafts">
        </a>

        <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
          <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
        </button>
      </div>

      <ul class="navbar-list">

        <li>
          <a href="#home" class="navbar-link" data-nav-link>Anasayfa</a>
        </li>
        <li>
          <a href="#" class="navbar-link" data-nav-link>Tasarla</a>
        </li>

        <li>
          <a href="#terzi_brand" class="navbar-link" data-nav-link>Terziler</a>
        </li>

        <li>
          <a href="#shop" class="navbar-link" data-nav-link>İletişim</a>
        </li>

        <li>
          <a href="#offer" class="navbar-link" data-nav-link>Tailor Crafts'ta Satış Yap</a>
        </li>

        <li>
          <a href="#blog" class="navbar-link" data-nav-link>Satıcı Paneli</a>
        </li>

      </ul>

    </div>
  </div>

  <div class="container-alt">
    <div class="n-product">
      <div class="model">

      </div>


      <div class="detay">
        <form action="sepet.php" method="post">
          <div class="urun-hakkinda">
            <h3>Ürün Detay</h3>
            <p><?php echo $kiyafet['detay']; ?> : <?php echo $kiyafet['fiyat']; ?>TL </p>
            <p><?php echo $kumas['kumas_adi']; ?>: <?php echo $kumas['fiyat']; ?> TL</p>
          </div>
          <span class="fiyat"><?php echo $toplam_fiyat; ?> TL</span>
          <input type="hidden" name="kumas_id" value="<?php echo $kumas['kumas_id']; ?>">
          <input type="hidden" name="kiyafet_id" value="<?php echo $kiyafet['kiyafet_id']; ?>">

          <h3>Beden Seçiniz:</h3>
          <?php
          $sql = "SELECT * FROM beden";
          $fire = mysqli_query($conn, $sql);

          while ($result = mysqli_fetch_assoc($fire)) :
          ?>
            <div class="beden">

              <div class="row" id="<?php echo strtolower($result['beden']); ?>">
                <input type="radio" autocomplete="off" class="size-select" name="beden" value="<?php echo $result['beden_id']; ?>" <?php if (isset($_SESSION["selected_size"]) && $_SESSION["selected_size"] == $result['beden_id']) echo "checked"; ?>>
                <label class="size-select-p"><?php echo $result['beden']; ?></label>
              </div>
            <?php endwhile ?>
            </div>
            <div class="buton">
              <button type="submit">Şimdi Sipariş Ver</button>
            </div>
        </form>


      </div>
     <div class="olcuTablosu">
          <table>
            <tr>
              <th>Beden</th>
              <th>Göğüs (cm)</th>
              <th>Bel (cm)</th>
              <th>Basen (cm)</th>
              <th>Boy (cm)</th>
            </tr>
            <tr>
              <td>XXS</td>
              <td>80</td>
              <td>62</td>
              <td>90</td>
              <td>86</td>

            </tr>
            <tr>
              <td>XS</td>
              <td>84</td>
              <td>65</td>
              <td>92</td>
              <td>86</td>

            </tr>
            <tr>
              <td>S</td>
              <td>88</td>
              <td>69</td>
              <td>94</td>
              <td>86</td>

            </tr>
            <tr>
              <td>M</td>
              <td>90</td>
              <td>72</td>
              <td>98</td>
              <td>86</td>

            </tr>
            <tr>
              <td>L</td>
              <td>94</td>
              <td>75</td>
              <td>103</td>
              <td>86</td>

            </tr>
            <tr>
              <td>XL</td>
              <td>106</td>
              <td>87</td>
              <td>110</td>
              <td>86</td>

            </tr>

            <tr>
              <td>XXL</td>
              <td>112</td>
              <td>92</td>
              <td>118</td>
              <td>86</td>

            </tr>
          </table>
        </div> 
    </div>

  </div>



  <!-- <footer class="footer" data-section>
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

        <a href="#" class="logo">
          <img src="img/tc.PNG" width="179" height="26" loading="lazy" alt="Tailor Crafts">
        </a>

      </div>

    </div>
  </footer>  -->


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

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>




</body>

</html>