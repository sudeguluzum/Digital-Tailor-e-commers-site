<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();
$terzi_id = $_SESSION['login']['terzi_id'];
$sql = "SELECT * FROM siparisler, terzi WHERE siparisler.terzi_id=terzi.terzi_id and terzi_id = $terzi_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="terzi-css/terzi-siparis.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                    <div class="left-menu-item"><img src="terzi-img/accounting.png" width="30px" height="30px" alt=""><a href="terzi-analiz.php">Analiz</a></div>
                </li>
                <hr>
                <li><a href="cikis.php"><i class='bx bx-log-out-circle'>Çıkış</i></a></li>
            </ul>
        </div>
    </div>
    <section>
        <header>
            <div class="hosgeldin">
                <h3>Hoşgeldin Terzi, <span><?php

                                            if (isset($_SESSION['login']['ad'])) {
                                                echo $_SESSION['login']['ad'];
                                                
                                            } else {
                                                echo "Giriş yapmış bir kullanıcı bulunamadı.";
                                            }
                                            ?></span></h3>

            </div>

            <div class="left-menu-item">
                <img src="terzi-img/terziler.png" width="30px" height="30px" alt=""> <span>Terzi Paneli</span>
            </div>


        </header>
        <article>
            <div class="genel-yazi">
                <h2>Siparişlerim</h2>

            </div>
            <div class="container" id="container">
                <div class="row" id="tum-siparis-row">
                    <div class="resim"><img src="terzi-img/boxes.png" alt="">
                    </div>
                    <div class="yazi">
                        <h4>Tüm Siparişlerim</h4>
                        <h3> <?php
                                $sql = "SELECT COUNT(siparis_id) AS siparis_sayisi FROM siparisler WHERE terzi_id = $terzi_id";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo $row['siparis_sayisi'];
                                ?></h3>

                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="row" id="yeni-siparis-row">
                    <div class="resim"><img src="terzi-img/alindi.png" alt="">

                    </div>
                    <div class="yazi">
                        <h4>Yeni Siparişlerim</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) AS siparis_sayisi 
                                FROM siparisler 
                                LEFT JOIN siparis_durum ON siparisler.durum_id = siparis_durum.durum_id 
                                WHERE siparis_durum.durum_id = 1 
                                AND siparisler.terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>

                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="row" id="islemdeki-row">
                    <div class="resim"><img src="terzi-img/hazirlaniyor.png" alt=""> </div>
                    <div class="yazi">
                        <h4>İşleme Alınanlar</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) AS siparis_sayisi 
                                FROM siparisler 
                                LEFT JOIN siparis_durum ON siparisler.durum_id = siparis_durum.durum_id 
                                WHERE siparis_durum.durum_id = 2 
                                AND siparisler.terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="row" id="kargo-row">
                    <div class="resim"><img src="terzi-img/kargoda.png" alt=""> </div>
                    <div class="yazi">
                        <h4>Kargoya Verildi</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) AS siparis_sayisi 
                                FROM siparisler 
                                LEFT JOIN siparis_durum ON siparisler.durum_id = siparis_durum.durum_id 
                                WHERE siparis_durum.durum_id = 3 
                                AND siparisler.terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>
                <div class="row" id="kargo-teslim-row">
                    <div class="resim"><img src="terzi-img/teslim.png" alt=""> </div>
                    <div class="yazi">
                        <h4>Teslim Edilenler</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) AS siparis_sayisi 
                                FROM siparisler 
                                LEFT JOIN siparis_durum ON siparisler.durum_id = siparis_durum.durum_id 
                                WHERE siparis_durum.durum_id = 4 
                                AND siparisler.terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                    <i class='bx bx-chevron-down'></i>
                </div>

            </div>
            <hr class="container-hr">




            <div class="tum-siparis-tablo">
                <table>
                    <h4>Sipariş Detay</h4>
                    <thead>
                        <tr>
                            <th>Sipariş No</th>
                            <th>Model</th>
                            <th>Kumaş</th>
                            <th>Beden</th>
                            <th>Total Fiyat</th>
                            <th>Komisyon Kesintisi</th>
                            <th>Kazanç</th>
                            <th>Durum</th>
                            <th>Sipariş Tarihi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $terzi_id = $_SESSION['login']['terzi_id'];
                        $sql = "SELECT siparisler.siparis_id,kiyafet.kiyafet_id,kiyafet.detay,kumaslar.kumas_id,kumaslar.kumas_adi, beden.beden, siparisler.total_fiyat, ROUND(total_fiyat * 0.18, 2) AS komisyon_miktari, ROUND(total_fiyat - (total_fiyat * 0.18), 2) AS kazanc ,siparisler.siparis_tarihi, siparis_durum.durum_ad FROM siparisler,kiyafet,kumaslar, terzi,siparis_durum, beden WHERE siparisler.terzi_id=terzi.terzi_id and siparisler.kiyafet_id=kiyafet.kiyafet_id and siparisler.kumas_id=kumaslar.kumas_id and siparisler.durum_id=siparis_durum.durum_id and beden.beden_id=siparisler.beden_id and siparisler.terzi_id=$terzi_id";
                        $fire = mysqli_query($conn, $sql);
                        if ($fire) {
                            while ($result = mysqli_fetch_assoc($fire)) :
                        ?>
                                <tr>
                                    <td><?php echo $result['siparis_id']; ?></td>
                                    <td>
                                        <div class="ust-foto">

                                            <img src="terzi-img/kiyafetler/<?php echo $result['kiyafet_id']; ?>.png" alt="Kıyafet <?php echo $result['kiyafet_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['detay']; ?>
                                    </td>
                                    <td>
                                        <div class="kumas-foto">
                                            <img src="terzi-img/kumaslar/<?php echo $result['kumas_id']; ?>.jpg" alt="Kumaş <?php echo $result['kumas_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['kumas_adi']; ?>
                                    </td>
                                    <td><?php echo $result['beden']; ?></td>
                                    <td><?php echo $result['total_fiyat']; ?> TL</td>
                                    <td><?php echo $result['komisyon_miktari']; ?> TL</td>
                                    <td><?php echo $result['kazanc']; ?> TL</td>
                                    <td style="background-color:#dddbdb;"><?php echo $result['durum_ad']; ?></td>
                                    <td><?php echo $result['siparis_tarihi']; ?></td>

                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='10'>Hiçbir sipariş bulunamadı.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>


            </div>

            <div class="yeni-siparis-tablo" style="display: none;">
                <table>
                    <h4>Yeni Siparişlerim</h4>
                    <thead>
                        <tr>
                            <th>Sipariş No</th>
                            <th>Model</th>
                            <th>Kumaş</th>
                            <th>Beden</th>
                            <th>Total Fiyat</th>
                            <th>Komisyon Kesintisi</th>
                            <th>Kazanç</th>
                            <th>Durum</th>
                            <th>Sipariş Tarihi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $terzi_id = $_SESSION['login']['terzi_id'];
                        $sql = "SELECT siparisler.siparis_id,kiyafet.kiyafet_id,kumaslar.kumas_id,kiyafet.detay,kumaslar.kumas_adi, beden.beden, siparisler.total_fiyat, ROUND(total_fiyat * 0.18, 2) AS komisyon_miktari, ROUND(total_fiyat - (total_fiyat * 0.18), 2) AS kazanc ,siparisler.siparis_tarihi, siparis_durum.durum_ad FROM siparisler,kiyafet,kumaslar, terzi,siparis_durum, beden WHERE siparisler.terzi_id=terzi.terzi_id and siparisler.kiyafet_id=kiyafet.kiyafet_id and siparisler.kumas_id=kumaslar.kumas_id and beden.beden_id=siparisler.beden_id and siparisler.durum_id=siparis_durum.durum_id and siparisler.durum_id=1 and siparisler.terzi_id=$terzi_id";
                        $fire = mysqli_query($conn, $sql);
                        if ($fire) {
                            while ($result = mysqli_fetch_assoc($fire)) :
                        ?>
                                <tr>
                                    <td><?php echo $result['siparis_id']; ?></td>
                                    <td>
                                        <div class="ust-foto">

                                            <img src="terzi-img/kiyafetler/<?php echo $result['kiyafet_id']; ?>.png" alt="Kıyafet <?php echo $result['kiyafet_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['detay']; ?>
                                    </td>
                                    <td>
                                        <div class="kumas-foto">
                                            <img src="terzi-img/kumaslar/<?php echo $result['kumas_id']; ?>.jpg" alt="Kumaş <?php echo $result['kumas_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['kumas_adi']; ?>
                                    </td>
                                    <td><?php echo $result['beden']; ?></td>
                                    <td><?php echo $result['total_fiyat']; ?> TL</td>
                                    <td><?php echo $result['komisyon_miktari']; ?> TL</td>
                                    <td><?php echo $result['kazanc']; ?> TL</td>
                                    <td>
                                        <form action="terzi-isleme-al.php" class="form" method="post">
                                            <input type="hidden" name="siparis_id" value="<?php echo $result['siparis_id']; ?>">
                                            <button class="btn1">İşleme Al</button>
                                        </form>
                                    </td>
                                    <td><?php echo $result['siparis_tarihi']; ?></td>

                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='10'>Hiçbir sipariş bulunamadı.</td></tr>";
                        }
                        ?>


                    </tbody>
                </table>
            </div>

            <div class="islemdeki-tablo" style="display: none;">
                <table>
                    <h4>İşlemde Olan Siparişlerim</h4>
                    <thead>
                        <tr>
                            <th>Sipariş No</th>
                            <th>Model</th>
                            <th>Kumaş</th>
                            <th>Beden</th>
                            <th>Total Fiyat</th>
                            <th>Komisyon Kesintisi</th>
                            <th>Kazanç</th>
                            <th>Durum</th>
                            <th>Sipariş Tarihi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $terzi_id = $_SESSION['login']['terzi_id'];
                        $sql = "SELECT siparisler.siparis_id,kiyafet.kiyafet_id,kumaslar.kumas_id,kiyafet.detay,kumaslar.kumas_adi, siparisler.beden_id, siparisler.total_fiyat, ROUND(total_fiyat * 0.18, 2) AS komisyon_miktari, ROUND(total_fiyat - (total_fiyat * 0.18), 2) AS kazanc ,siparisler.siparis_tarihi, siparis_durum.durum_ad FROM siparisler,kiyafet,kumaslar, terzi,siparis_durum WHERE siparisler.terzi_id=terzi.terzi_id and siparisler.kiyafet_id=kiyafet.kiyafet_id and siparisler.kumas_id=kumaslar.kumas_id and siparisler.durum_id=siparis_durum.durum_id and siparisler.durum_id=2 and siparisler.terzi_id=$terzi_id";
                        $fire = mysqli_query($conn, $sql);
                        if ($fire) {
                            while ($result = mysqli_fetch_assoc($fire)) :
                        ?>
                                <tr>
                                    <td><?php echo $result['siparis_id']; ?></td>
                                    <td>
                                        <div class="ust-foto">

                                            <img src="terzi-img/kiyafetler/<?php echo $result['kiyafet_id']; ?>.png" alt="Kıyafet <?php echo $result['kiyafet_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['detay']; ?>
                                    </td>
                                    <td>
                                        <div class="kumas-foto">
                                            <img src="terzi-img/kumaslar/<?php echo $result['kumas_id']; ?>.jpg" alt="Kumaş <?php echo $result['kumas_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['kumas_adi']; ?>
                                    </td>
                                    <td><?php echo $result['beden_id']; ?></td>
                                    <td><?php echo $result['total_fiyat']; ?> TL</td>
                                    <td><?php echo $result['komisyon_miktari']; ?> TL</td>
                                    <td><?php echo $result['kazanc']; ?> TL</td>
                                    <td>
                                        <form action="terzi-kargoya-ver.php" class="form" method="post">
                                            <input type="hidden" name="siparis_id" value="<?php echo $result['siparis_id']; ?>">
                                            <button class="btn2">Kargoya Ver</button>
                                        </form>
                                    </td>
                                    </td>
                                    <td><?php echo $result['siparis_tarihi']; ?></td>

                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='10'>İşleme alınmış siparişiniz yok.</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <div class="kargodaki-tablo" style="display: none;">
                <table>
                    <h4>Kargoya Verilen Siparişlerim</h4>
                    <thead>
                        <tr>
                            <th>Sipariş No</th>
                            <th>Model</th>
                            <th>Kumaş</th>
                            <th>Beden</th>
                            <th>Total Fiyat</th>
                            <th>Komisyon Kesintisi</th>
                            <th>Kazanç</th>
                            <th>Durum</th>
                            <th>Sipariş Tarihi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $terzi_id = $_SESSION['login']['terzi_id'];
                        $sql = "SELECT siparisler.siparis_id,kiyafet.kiyafet_id,kumaslar.kumas_id,kiyafet.detay,kumaslar.kumas_adi, siparisler.beden_id, siparisler.total_fiyat, ROUND(total_fiyat * 0.18, 2) AS komisyon_miktari, ROUND(total_fiyat - (total_fiyat * 0.18), 2) AS kazanc ,siparisler.siparis_tarihi, siparis_durum.durum_ad FROM siparisler,kiyafet,kumaslar, terzi,siparis_durum WHERE siparisler.terzi_id=terzi.terzi_id and siparisler.kiyafet_id=kiyafet.kiyafet_id and siparisler.kumas_id=kumaslar.kumas_id and siparisler.durum_id=siparis_durum.durum_id and  siparisler.durum_id=3 and siparisler.terzi_id=$terzi_id";
                        $fire = mysqli_query($conn, $sql);
                        if ($fire) {
                            while ($result = mysqli_fetch_assoc($fire)) :
                        ?>
                                <tr>
                                    <td><?php echo $result['siparis_id']; ?></td>
                                    <td>
                                        <div class="ust-foto">

                                            <img src="terzi-img/kiyafetler/<?php echo $result['kiyafet_id']; ?>.png" alt="Kıyafet <?php echo $result['kiyafet_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['detay']; ?>
                                    </td>
                                    <td>
                                        <div class="kumas-foto">
                                            <img src="terzi-img/kumaslar/<?php echo $result['kumas_id']; ?>.jpg" alt="Kumaş <?php echo $result['kumas_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['kumas_adi']; ?>
                                    </td>
                                    <td><?php echo $result['beden_id']; ?></td>
                                    <td><?php echo $result['total_fiyat']; ?> TL</td>
                                    <td><?php echo $result['komisyon_miktari']; ?> TL</td>
                                    <td><?php echo $result['kazanc']; ?> TL</td>
                                    <td style="background-color:orange;"><?php echo $result['durum_ad']; ?></td>
                                    <td><?php echo $result['siparis_tarihi']; ?></td>

                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='10'>Kargoya verilen siparişiniz yok.</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <div class="kargo-teslim-tablo" style="display: none;">
                <table>
                    <h4>Teslim Edilen Siparişlerim</h4>
                    <thead>
                        <tr>
                            <th>Sipariş No</th>
                            <th>Model</th>
                            <th>Kumaş</th>
                            <th>Beden</th>
                            <th>Total Fiyat</th>
                            <th>Komisyon Kesintisi</th>
                            <th>Kazanç</th>
                            <th>Durum</th>
                            <th>Sipariş Tarihi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $terzi_id = $_SESSION['login']['terzi_id'];
                        $sql = "SELECT siparisler.siparis_id,kiyafet.kiyafet_id,kumaslar.kumas_id,kiyafet.detay,kumaslar.kumas_adi, siparisler.beden_id, siparisler.total_fiyat, ROUND(total_fiyat * 0.18, 2) AS komisyon_miktari, ROUND(total_fiyat - (total_fiyat * 0.18), 2) AS kazanc ,siparisler.siparis_tarihi, siparis_durum.durum_ad FROM siparisler,kiyafet,kumaslar, terzi,siparis_durum WHERE siparisler.terzi_id=terzi.terzi_id and siparisler.kiyafet_id=kiyafet.kiyafet_id and siparisler.kumas_id=kumaslar.kumas_id and siparisler.durum_id=siparis_durum.durum_id and siparisler.durum_id=4 and siparisler.terzi_id=$terzi_id";
                        $fire = mysqli_query($conn, $sql);
                        if ($fire) {
                            while ($result = mysqli_fetch_assoc($fire)) :
                        ?>
                                <tr>
                                    <td><?php echo $result['siparis_id']; ?></td>
                                    <td>
                                        <div class="ust-foto">

                                            <img src="terzi-img/kiyafetler/<?php echo $result['kiyafet_id']; ?>.png" alt="Kıyafet <?php echo $result['kiyafet_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['detay']; ?>
                                    </td>
                                    <td>
                                        <div class="kumas-foto">
                                            <img src="terzi-img/kumaslar/<?php echo $result['kumas_id']; ?>.jpg" alt="Kumaş <?php echo $result['kumas_id']; ?>">

                                        </div> <br>
                                        <?php echo $result['kumas_adi']; ?>
                                    </td>
                                    <td><?php echo $result['beden_id']; ?></td>
                                    <td><?php echo $result['total_fiyat']; ?> TL</td>
                                    <td><?php echo $result['komisyon_miktari']; ?> TL</td>
                                    <td><?php echo $result['kazanc']; ?> TL</td>
                                    <td style="background-color:green;"><?php echo $result['durum_ad']; ?></td>
                                    <td><?php echo $result['siparis_tarihi']; ?></td>

                                </tr>
                        <?php
                            endwhile;
                        } else {
                            echo "<tr><td colspan='10'>Teslim edilen siparişiniz yok.</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>



        </article>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(function() {
            $('#tum-siparis-row').click(function(e) {
                $('.yeni-siparis-tablo').hide();
                $('.islemdeki-tablo').hide();
                $('.kargodaki-tablo').hide();
                $('.kargo-teslim-tablo').hide();
                $('.tum-siparis-tablo').show();

            });

        })
    </script>
    <script>
        $(function() {
            $('#yeni-siparis-row').click(function(e) {
                $('.tum-siparis-tablo').hide();
                $('.islemdeki-tablo ').hide();
                $('.kargodaki-tablo').hide();
                $('.kargo-teslim-tablo').hide();
                $('.yeni-siparis-tablo').show();

            });

        })
    </script>
    <script>
        $(function() {
            $('#islemdeki-row').click(function(e) {
                $('.tum-siparis-tablo').hide();
                $('.yeni-siparis-tablo').hide();
                $('.kargodaki-tablo').hide();
                $('.kargo-teslim-tablo').hide();
                $('.islemdeki-tablo').show();

            });

        })
    </script>
    <script>
        $(function() {
            $('#kargo-row').click(function(e) {
                $('.tum-siparis-tablo').hide();
                $('.yeni-siparis-tablo').hide();
                $('.islemdeki-tablo').hide();
                $('.kargo-teslim-tablo').hide();
                $('.kargodaki-tablo').show();

            });

        })
    </script>
    <script>
        $(function() {
            $('#kargo-teslim-row').click(function(e) {
                $('.tum-siparis-tablo').hide();
                $('.yeni-siparis-tablo').hide();
                $('.islemdeki-tablo').hide();
                $('.kargodaki-tablo').hide();
                $('.kargo-teslim-tablo').show();

            });

        })
    </script>

    <script>
        $(document).ready(function() {
            $(".isleme-al").click(function() {
                var $row = $(this).closest("tr"), // Find the row
                    $tds = $row.find("td");

                $.post('isleme.php', {
                    siparis_id: $tds.eq(0).text()
                }, function(response) {
                    alert(response);
                });
            });
        });
    </script>

</body>

</html>