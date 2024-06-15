<?php
$conn= new mysqli('localhost','root','','dijital_terzi');
session_start();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="terzi-css/vergi.css">

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
                        <img src="terzi-img/file.png" width="30px" height="30px" alt=""><a href="terzi-belge.php">Belgelerim</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item"><img src="terzi-img/siparisler.png" width="30px" height="30px" alt=""><a
                            href="terzi-siparis.php">Siparişlerim</a></div>
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
                     if(isset($_SESSION['login']['ad'])) {
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
                            <a href="terzi-bilgi.php" class="navbar-">Adres Bilgileri</a>
                        </li>

                        <li>
                            <a href="iletisim.php" class="navbar-">İletişim Bilgileri</a>
                        </li>

                        <li>
                            <a href="terzi-vergi.php" class="navbar-a">Vergi Bilgileri</a>
                        </li>
                        <li>
                            <a href="banka-bilgi.php" class="navbar-">Banka Bilgileri</a>
                        </li>
                        
                    </ul>

                </div>

            </div>
            <div class="adres-bilgileri">
                <div class="adres-bilgi-yazi">
                    <h4>Vergi Bilgileri</h4>
                </div>
                <div class="form">
                    <form action="terzi-vergi-kontrol.php" class="form" method="post">

                    <input type="number" name="vergi_no" required placeholder="Vergi Numarası">
                    <input type="text" name="t_sicil_no" required placeholder="Ticari Sicil No" >
                    <input type="text" name="mersis_no" required placeholder="Mersis No" >  
                    <input type="submit" name="submit" value="Kaydet" class="kayit-ol">


                    </form>
                </div>
                <div class="kayitli-bilgiler">
                    <h4>Vergi Bilgileri</h4> <hr> 
                    <span>
                     <?php
                     if(isset($_SESSION['login'])) {
                        echo "Vergi No: " . $_SESSION['login']['vergi_no'] . "<br>";
                        echo "Ticaret Sicil No: " . $_SESSION['login']['t_sicil_no'] . "<br>";
                        echo "Mersis No: " . $_SESSION['login']['mersis_no'] . "<br>";
                                               
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