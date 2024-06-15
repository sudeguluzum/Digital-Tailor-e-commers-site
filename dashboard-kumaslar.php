<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();
$admin_id = $_SESSION['adminLogin']['admin_id'];

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard-urunler.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>
    <div class="sidebar">
        <a href="index.html">
            <div class="sidebar-logo"><img src="img/tc.PNG" alt="Tailor Crafts"> </div>
        </a>
        <div class="liste">
            <ul>
                <li>
                    <div class="left-menu-item">
                        <img src="img/dashboard.png" width="30px" height="30px" alt=""><a href="dashboard.php">Dashboard</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item">
                        <img src="img/urunler.png" width="30px" height="30px" alt=""><a href="dashboard-urunler.php">Ürünler</a>
                    </div>
                </li>
                <li>
                    <div class="left-menu-item">
                        <img src="img/kumas.png" width="30px" height="30px" alt=""><a href="dashboard-kumaslar.php">Kumaşlar</a>
                    </div>
                </li>
               
                <li>
                    <div class="left-menu-item"><img src="img/terziler.png" width="30px" height="30px" alt=""><a href="dashboard-terzi.php">Terziler</a></div>
                </li>
                <hr>
                <li><a href="cikis.php"><i class='bx bx-log-out-circle'>Çıkış</i></a></li>
            </ul>
        </div>
    </div>
    <section>
        <header>
            <div class="hosgeldin">
                <h3>Hoşgeldin <span><?php

                                    if (isset($_SESSION['adminLogin']['admin_id'])) {
                                        echo $_SESSION['adminLogin']['ad'] . " " . $_SESSION['adminLogin']['soyad'];
                                    } else {
                                        echo "Giriş yapmış bir kullanıcı bulunamadı.";
                                    }
                                    ?></span></h3>
                <p>İşte bugün mağazanızda neler oluyor</p>
            </div>

            <div class="left-menu-item">
                <i class='bx bxs-user-circle'><span><?php

                                                    if (isset($_SESSION['adminLogin']['admin_id'])) {
                                                        echo $_SESSION['adminLogin']['ad'] . " " . $_SESSION['adminLogin']['soyad'];
                                                    } else {
                                                        echo "Giriş yapmış bir kullanıcı bulunamadı.";
                                                    }
                                                    ?></span></i>
            </div>


        </header>
        <article>
            <div class="genel-yazi">
                <h2>Ürünler</h2>

            </div>

            <div class="n-content">
                <?php
                $sql = "SELECT kumas_id, kumas_adi, fiyat FROM kumaslar";
                $fire = mysqli_query($conn, $sql);

                while ($result = mysqli_fetch_assoc($fire)) :
                ?>
                    <div class="row">
                        <div class="row-img" id="u<?php echo $result['kumas_id']; ?>">
                           <img src="img/kumaslar/<?php echo $result['kumas_id']; ?>.jpg" alt="Üst<?php echo $result['kumas_id']; ?>">
                        </div>

                        <h3><?php echo $result['kumas_adi']; ?></h3>
                        <div class="row-in">
                            <div class="row-left">
                                <h6><?php echo $result['fiyat'] . " TL". " / boy"; ?></h6>
                            </div>
                            <div class="row-right">
                                <a href="kumaslar.php?id=<?= $result['kumas_id'] ?>"></a>
                            </div>
                        </div>
                        <div class="tablo">
                        <form action="kumas-fiyat-guncelle.php" class="form" method="post">
                                <input type="hidden" name="kumas_id" value="<?php echo $result['kumas_id']; ?>">
                                <input type="text" name="fiyat" id="fiyat" required placeholder="Fiyatı Güncelle">
                                <button class="btn">Güncelle<i class='bx bx-edit-alt'></i></button>
                            </form>
                        </div>
                    </div>

                <?php endwhile ?>
            </div>


        </article>
    </section>


</body>

</html>