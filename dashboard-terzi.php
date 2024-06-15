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
    <link rel="stylesheet" href="css/dashboard-terzi.css">
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
                <h2>Terziler</h2>

            </div>
            <div class="container">
                <div class="row">
                    <div class="yazi">
                        <h4>Toplam Terzi Sayısı</h4>
                        <h3><?php
                            $sql = "SELECT count(terzi_id)as terzi_sayisi from terzi";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['terzi_sayisi'];
                            ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Onaylanmış Terzi Sayısı</h4>
                        <h3><?php
                            $sql = "SELECT count(terzi_id)as terzi_sayisi from terzi WHERE terzi.durum_id=3";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['terzi_sayisi'];
                            ?> </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>İncelenen Terzi Sayısı</h4>
                        <h3><?php
                            $sql = "SELECT count(terzi_id)as terzi_sayisi from terzi WHERE terzi.durum_id=2";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['terzi_sayisi'];
                            ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Yeni Başvuru Sayısı</h4>
                        <h3><?php
                            $sql = "SELECT count(terzi_id)as terzi_sayisi from terzi WHERE terzi.durum_id=1";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['terzi_sayisi'];
                            ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Onaylanmayan Terzi</h4>
                        <h3><?php
                            $sql = "SELECT count(terzi_id)as terzi_sayisi from terzi WHERE terzi.durum_id=4";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['terzi_sayisi'];
                            ?></h3>
                    </div>
                </div>
            </div>

            <div class="n-content">
                <div class="tablo">
                    <table>
                        <h4>Yeni Başvuru Yapan Terziler</h4>
                        <thead>
                            <tr>
                                <th>TC No</th>
                                <th>Ad Soyad</th>
                                <th>Telefon Numarası</th>
                                <th>Mail</th>
                                <th>Doğum Tarihi</th>
                                <th>Durum</th>
                                <th>Başvuru Tarihi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT terzi.terzi_id, terzi.tc, concat(terzi.ad,' ',terzi.soyad)as ad_soyad, terzi.tel_no, terzi.mail, terzi.d_tarihi, terzi.vergi_no, terzi.t_sicil_no,terzi.mersis_no, terzi.kayit_tarihi FROM terzi WHERE durum_id=1";
                            $fire = mysqli_query($conn, $sql);
                            if ($fire) {
                                while ($result = mysqli_fetch_assoc($fire)) :
                            ?>
                                    <tr>
                                        <td><?php echo $result['tc']; ?></td>
                                        <td><?php echo $result['ad_soyad']; ?></td>
                                        <td><?php echo $result['tel_no']; ?></td>
                                        <td><?php echo $result['mail']; ?></td>
                                        <td><?php echo $result['d_tarihi']; ?></td>
                                        <td>
                                            <form action="terzi-durum-guncelle.php" class="form" method="post">
                                                <input type="hidden" name="terzi_id" value="<?php echo $result['terzi_id']; ?>">
                                                <button class="btn" style="background-color:rgba(255, 124, 54, 0.8); width:100px; height:30px;">İncele<i class='bx bx-search-alt-2'></i></button>
                                            </form>
                                        </td>
                                        <td><?php echo $result['kayit_tarihi']; ?></td>



                                    </tr>
                            <?php
                                endwhile;
                            } else {
                                echo "<tr><td colspan='10'>Yeni Başvuru Yapan Terzi Yok.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="tablo">
                    <table>
                        <h4>İncelenen Terziler</h4>
                        <thead>
                            <tr>
                                <th>TC No</th>
                                <th>Ad Soyad</th>
                                <th>Mail</th>
                                <th>Doğum Tarihi</th>
                                <th>Vergi No</th>
                                <th>T. Sicil No</th>
                                <th>Mersis No</th>
                                <th>Durum</th>
                                <th>Başvuru Tarihi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT terzi.terzi_id, terzi.tc, concat(terzi.ad,' ',terzi.soyad)as ad_soyad, terzi.mail, terzi.d_tarihi, terzi.vergi_no, terzi.t_sicil_no,terzi.mersis_no, terzi.kayit_tarihi FROM terzi WHERE durum_id=2";
                            $fire = mysqli_query($conn, $sql);
                            if ($fire) {
                                while ($result = mysqli_fetch_assoc($fire)) :
                            ?>
                                    <tr>
                                        <td><?php echo $result['tc']; ?></td>
                                        <td><?php echo $result['ad_soyad']; ?></td>
                                        <td><?php echo $result['mail']; ?></td>
                                        <td><?php echo $result['d_tarihi']; ?></td>
                                        <td><?php echo $result['vergi_no']; ?></td>
                                        <td><?php echo $result['t_sicil_no']; ?></td>
                                        <td><?php echo $result['mersis_no']; ?></td>
                                        <td>
                                            <form action="terzi-durum-guncelle2.php" class="form" method="post">
                                                <input type="hidden" name="terzi_id" value="<?php echo $result['terzi_id']; ?>">
                                                <button class="btn1" name="btn1" style="background-color:rgba(6, 206, 6, 0.8); width:100px; height:30px;" >Onayla<i class='bx bx-user-check'></i></button> <br>
                                                <br>
                                                <button class="btn2" name="btn2" style="background-color:rgba(255, 0, 0, 0.8); width:100px; height:30px;">Onaylama<i class='bx bx-user-x'></i></button>
                                            </form>
                                        </td>
                                        <td><?php echo $result['kayit_tarihi']; ?></td>



                                    </tr>
                            <?php
                                endwhile;
                            } else {
                                echo "<tr><td colspan='10'>İncelenen Terzi Yok.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="tablo" style="background-color: rgba(6, 206, 6, 0.3);">
                    <table>
                        <h4>Onaylanan Terziler</h4>
                        <thead>
                            <tr>
                                <th>TC No</th>
                                <th>Ad Soyad</th>
                                <th>Mail</th>
                                <th>Doğum Tarihi</th>
                                <th>Vergi No</th>
                                <th>T. Sicil No</th>
                                <th>Mersis No</th>
                                <th>Durum</th>
                                <th>Başvuru Tarihi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT terzi.terzi_id, terzi.tc, concat(terzi.ad,' ',terzi.soyad)as ad_soyad, terzi.mail, terzi.d_tarihi, terzi.vergi_no, terzi.t_sicil_no,terzi.mersis_no, terzi.kayit_tarihi, terzi_durum.durum_ad FROM terzi, terzi_durum WHERE terzi.durum_id=terzi_durum.durum_id and terzi.durum_id=3";
                            $fire = mysqli_query($conn, $sql);
                            if ($fire) {
                                while ($result = mysqli_fetch_assoc($fire)) :
                            ?>
                                    <tr>
                                        <td><?php echo $result['tc']; ?></td>
                                        <td><?php echo $result['ad_soyad']; ?></td>
                                        <td><?php echo $result['mail']; ?></td>
                                        <td><?php echo $result['d_tarihi']; ?></td>
                                        <td><?php echo $result['vergi_no']; ?></td>
                                        <td><?php echo $result['t_sicil_no']; ?></td>
                                        <td><?php echo $result['mersis_no']; ?></td>
                                        <td style="background-color:#06ce06;"><?php echo $result['durum_ad']; ?></td>
                                        <td><?php echo $result['kayit_tarihi']; ?></td>



                                    </tr>
                            <?php
                                endwhile;
                            } else {
                                echo "<tr><td colspan='10'>Onaylanan Terzi Yok.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="tablo" style="background-color: rgba(255, 0, 0, 0.5);">
                    <table>
                        <h4>Onaylanmayan Terziler</h4>
                        <thead>
                            <tr>
                                <th>TC No</th>
                                <th>Ad Soyad</th>
                                <th>Mail</th>
                                <th>Doğum Tarihi</th>
                                <th>Vergi No</th>
                                <th>T. Sicil No</th>
                                <th>Mersis No</th>
                                <th>Durum</th>
                                <th>Başvuru Tarihi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT terzi.terzi_id, terzi.tc, concat(terzi.ad,' ',terzi.soyad)as ad_soyad, terzi.mail, terzi.d_tarihi, terzi.vergi_no, terzi.t_sicil_no,terzi.mersis_no, terzi.kayit_tarihi, terzi_durum.durum_ad FROM terzi, terzi_durum WHERE terzi.durum_id=terzi_durum.durum_id and terzi.durum_id=4";
                            $fire = mysqli_query($conn, $sql);
                            if ($fire) {
                                while ($result = mysqli_fetch_assoc($fire)) :
                            ?>
                                    <tr>
                                        <td><?php echo $result['tc']; ?></td>
                                        <td><?php echo $result['ad_soyad']; ?></td>
                                        <td><?php echo $result['mail']; ?></td>
                                        <td><?php echo $result['d_tarihi']; ?></td>
                                        <td><?php echo $result['vergi_no']; ?></td>
                                        <td><?php echo $result['t_sicil_no']; ?></td>
                                        <td><?php echo $result['mersis_no']; ?></td>
                                        <td style="background-color:#FF0000;"><?php echo $result['durum_ad']; ?></td>
                                        <td><?php echo $result['kayit_tarihi']; ?></td>



                                    </tr>
                            <?php
                                endwhile;
                            } else {
                                echo "<tr><td colspan='10'>Onaylanmayan Terzi Yok.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>




        </article>
    </section>


</body>

</html>