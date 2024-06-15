<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if (isset($_SESSION['login']['terzi_id'])) {
    $terzi_id = $_SESSION['login']['terzi_id'];

    $sql = "SELECT * FROM siparisler, terzi WHERE siparisler.terzi_id=terzi.terzi_id and terzi_id = $terzi_id";
    $result = $conn->query($sql);
} else {
    // Kullanıcı girişi yapılmamışsa yapılacak işlemler
    echo "Kullanıcı girişi yapılmamış!";
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="terzi-css/terzi-analiz.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        var data = google.visualization.arrayToDataTable([
            ['Gün', 'Sipariş Sayısı'],
            <?php 
                $sorgu = "SELECT DATE(siparis_tarihi) as gun, COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE terzi_id=$terzi_id AND siparis_tarihi >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY DATE(siparis_tarihi)";
                $ilk = mysqli_query($conn, $sorgu);
                while ($sonuc = mysqli_fetch_assoc($ilk)) {
                    echo "['" . $sonuc['gun'] . "', " . $sonuc['siparis_sayisi'] . "],";
                }
            ?>
        ]);

        var options = {
            title: 'Siparişlerin Günlere Göre Dağılımı (Son 7 Gün)',
            vAxis: {title: 'Sipariş Sayısı'},
            hAxis: {title: 'Gün'},
            seriesType: 'bars',
            series: {1: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('hafta'));
        chart.draw(data, options);
    }
</script>

    
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Gün');
        data.addColumn('number', 'Sipariş Sayısı');
        data.addRows([
            <?php
            $sql = "SELECT DATE(siparis_tarihi) as gun, COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE terzi_id = $terzi_id AND siparis_tarihi >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) GROUP BY DATE(siparis_tarihi)";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "['" . $row['gun'] . "', " . $row['siparis_sayisi'] . "],";
            }
            ?>
        ]);
        var options = {
            'title': 'Son Bir Ayın Satış Miktarı',
            'width': 500,
            'height': 300
        };
        var chart = new google.visualization.LineChart(document.getElementById('aylik'));
        chart.draw(data, options);
    }
</script>




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
                <h2>Genel Performansım</h2>

            </div>
            <div class="container">
                <div class="row">
                    <div class="yazi">
                        <h4>Kazanç</h4>
                        <h3><?php
                            $sql = "SELECT 
                                ROUND(SUM(total_fiyat),2) AS toplam_tutar 
                            FROM 
                                siparisler 
                            WHERE 
                                terzi_id = $terzi_id;
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['toplam_tutar'];
                            ?> TL</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Komisyon Kesintisi</h4>
                        <h3><?php
                            $sql = "SELECT 
                                 ROUND(SUM(total_fiyat) * 0.18, 2) AS komisyon_tutari 
                            FROM 
                                siparisler 
                            WHERE 
                                terzi_id = $terzi_id;
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['komisyon_tutari'];
                            ?> TL</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Net Ciro</h4>
                        <h3><?php
                            $sql = "SELECT 
                                ROUND(SUM(total_fiyat) * 0.82, 2) AS net_ciro 
                            FROM 
                                siparisler 
                            WHERE 
                                terzi_id = $terzi_id;
                            ";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['net_ciro'];
                            ?> TL</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Komisyon Oranı</h4>
                        <h3>%18</h3>
                    </div>
                </div>

            </div>
            <hr class="container-hr">
            <div class="yazi">
                <h2>Satış Performansım</h2>

            </div>
            <div class="container">
                <div class="row">
                    <div class="yazi">
                        <h4>Bugünkü Satış Adedim</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE DATE(siparis_tarihi) = CURDATE() 
                                and terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Dünkü Satış Adedim</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE DATE(siparis_tarihi) = DATE(DATE_SUB(CURDATE(), INTERVAL 1 DAY)) 
                                and terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Son 1 Haftalık Satış Adedim</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE DATE(siparis_tarihi) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 WEEK) AND CURDATE() 
                                and terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="yazi">
                        <h4>Son 30 Günlük Satış Adedim</h4>
                        <h3><?php
                            $sql = "SELECT COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE DATE(siparis_tarihi) BETWEEN DATE_SUB(CURDATE(), INTERVAL 1 MONTH) AND CURDATE() 
                                and terzi_id = $terzi_id;";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['siparis_sayisi'];
                            ?></h3>
                    </div>
                </div>

            </div>
            <div class="alt-container">
                <div class="small-row">
                    <div class="resim"><img src="terzi-img/alindi.png" alt=""></div>
                    <div class="yazi">
                        <h4>Toplam Siparişlerim</h4>
                        <h3><?php
                                $sql = "SELECT COUNT(siparis_id) AS siparis_sayisi FROM siparisler WHERE terzi_id = $terzi_id";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo $row['siparis_sayisi'];
                                ?></h3>
                    </div>
                </div>
                <div class="small-row">
                    <div class="resim"><img src="terzi-img/hazirlaniyor.png" alt=""></div>
                    <div class="yazi">
                        <h4>Hazırlanan Siparişler</h4>
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
                </div>
                <div class="small-row">
                    <div class="resim"><img src="terzi-img/kargoda.png" alt=""></div>
                    <div class="yazi">
                        <h4>Kargodaki Siparişler</h4>
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
                </div>
                <div class="small-row">
                    <div class="resim"><img src="terzi-img/teslim.png" alt=""></div>
                    <div class="yazi">
                        <h4>Teslim Edilen Siparişler</h4>
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
                </div>
            </div>

            <div class="alt-alt-container">
                <div class="row">
                    <h4> Günlere Göre Satış Miktarı</h4>
                    <div class="yazi" id="hafta">

                    </div>
                </div>
                <div class="row">
                    <h4>Aylık Satış Miktarı</h4>
                    <div class="yazi" id="aylik">

                    </div>
                </div>

            </div>

        </article>
    </section>


</body>

</html>