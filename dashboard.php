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
  <link rel="stylesheet" href="css/dashboard.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
      var data = google.visualization.arrayToDataTable([
        ['Gün', 'Sipariş Sayısı'],
        <?php
        $sorgu = "SELECT DATE(siparis_tarihi) as gun, COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE siparis_tarihi >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) GROUP BY DATE(siparis_tarihi)";
        $ilk = mysqli_query($conn, $sorgu);
        while ($sonuc = mysqli_fetch_assoc($ilk)) {
          echo "['" . $sonuc['gun'] . "', " . $sonuc['siparis_sayisi'] . "],";
        }
        ?>
      ]);

      var options = {
        title: 'Siparişlerin Günlere Göre Dağılımı (Son 7 Gün)',
        vAxis: {
          title: 'Sipariş Sayısı'
        },
        hAxis: {
          title: 'Gün'
        },
        seriesType: 'bars',
        series: {
          1: {
            type: 'line'
          }
        }
      };

      var chart = new google.visualization.ComboChart(document.getElementById('hafta'));
      chart.draw(data, options);
    }
  </script>


  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Gün');
      data.addColumn('number', 'Sipariş Sayısı');
      data.addRows([
        <?php
        $sql = "SELECT DATE(siparis_tarihi) as gun, COUNT(siparis_id) as siparis_sayisi FROM siparisler WHERE siparis_tarihi >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) GROUP BY DATE(siparis_tarihi)";
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
        <h2>İstatistikler</h2>

      </div>
      <div class="container">
        <div class="row">
          <div class="yazi">
            <h4>Toplam Sipariş Sayısı</h4>
            <h3><?php
                $sql = "SELECT count(siparis_id)as siparis_sayisi from siparisler";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['siparis_sayisi'];
                ?></h3>
          </div>
        </div>
        <div class="row">
          <div class="yazi">
            <h4>Toplam Kazanç</h4>
            <h3><?php
                $sql = "SELECT 
                                ROUND(SUM(total_fiyat), 2) AS kazanc 
                            FROM 
                                siparisler 
                           
                            ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['kazanc'];
                ?> TL</h3>
          </div>
        </div>
        <div class="row">
          <div class="yazi">
            <h4>Komisyon Toplamı</h4>
            <h3><?php
                $sql = "SELECT 
                            ROUND(SUM(total_fiyat * 0.18),2) AS net_ciro FROM  siparisler;";
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
      <div class="alt-container">
        <div class="small-row">
          <div class="resim"><img src="img/alindi.png" alt=""></div>
          <div class="yazi">
            <h4>Toplam Sipariş Sayısı</h4>
            <h3><?php
                $sql = "SELECT count(siparis_id)as siparis_sayisi from siparisler";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['siparis_sayisi'];
                ?></h3>
          </div>
        </div>
        <div class="small-row">
          <div class="resim"><img src="img/hazirlaniyor.png" alt=""></div>
          <div class="yazi">
            <h4>Hazırlanan Siparişler</h4>
            <h3><?php
                $sql = "SELECT count(siparis_id)as siparis_sayisi from siparisler WHERE siparisler.durum_id=2";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['siparis_sayisi'];
                ?></h3>
          </div>
        </div>
        <div class="small-row">
          <div class="resim"><img src="img/kargoda.png" alt=""></div>
          <div class="yazi">
            <h4>Kargodaki Siparişler</h4>
            <h3><?php
                $sql = "SELECT count(siparis_id)as siparis_sayisi from siparisler WHERE siparisler.durum_id=3";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['siparis_sayisi'];
                ?></h3>
          </div>
        </div>
        <div class="small-row">
          <div class="resim"><img src="img/teslim.png" alt=""></div>
          <div class="yazi">
            <h4>Teslim Edilen Siparişler</h4>
            <h3><?php
                $sql = "SELECT count(siparis_id)as siparis_sayisi from siparisler WHERE siparisler.durum_id=3";
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
      <div class="kiyafet-container">
        <table>
          <h4>Tüm Zamanların En Çok Tercih Edilen Kıyafetleri</h4>
          <thead>
            <tr>
              <th>Kıyafet</th>
              <th>Kıyafet Adı</th>
              <th>Fiyat</th>
              <th>Toplam Sipariş Sayısı</th>
            </tr>
          </thead>
          <tbody>
    <?php
    $sql = "SELECT kiyafet.kiyafet_id, kiyafet.detay, kiyafet.fiyat, COUNT(siparisler.kiyafet_id) AS toplam_siparis 
            FROM siparisler 
            INNER JOIN kiyafet ON siparisler.kiyafet_id = kiyafet.kiyafet_id 
            GROUP BY siparisler.kiyafet_id 
            ORDER BY toplam_siparis DESC 
            LIMIT 3";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) :
        $kiyafet_id = $row['kiyafet_id'];
        $detay = $row['detay'];
        $fiyat = $row['fiyat'];
        $toplam_siparis = $row['toplam_siparis'];
        $resim_yolu = "img/kiyafetler/" . $kiyafet_id . ".png"; // Resmin yolunu oluştur

        // Eğer resim dosyası yoksa, bir varsayılan resim göster
        if (!file_exists($resim_yolu)) {
            $resim_yolu = "img/kiyafetler/default.png";
        }
    ?>
        <tr>
            <td>
                <img src="<?php echo $resim_yolu; ?>" alt="<?php echo $detay; ?>" width="70" height="70">
                
            </td>
            <td><?php echo $detay; ?></td>
            <td><?php echo $fiyat; ?> TL</td>
            <td><?php echo $toplam_siparis; ?></td>
        </tr>
    <?php endwhile; ?>
</tbody>

        </table>
      </div>



      <div class="kumas-container">
        <table>
          <h4>Tüm Zamanların En Çok Tercih Edilen Kumaşları</h4>
          <thead>
            <tr>
              <th>Kumaş</th>
              <th>Kumaş Detay</th>
              <th>Fiyat</th>
              <th>Toplam Sipariş Sayısı</th>

            </tr>
          </thead>
          <tbody>
    <?php
    $sql = "SELECT kumaslar.kumas_id, kumaslar.kumas_adi, kumaslar.fiyat, COUNT(siparisler.kumas_id) AS toplam_siparis 
            FROM siparisler 
            INNER JOIN kumaslar ON siparisler.kumas_id = kumaslar.kumas_id 
            GROUP BY siparisler.kumas_id 
            ORDER BY toplam_siparis DESC 
            LIMIT 3";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) :
        $kumas_id = $row['kumas_id'];
        $kumas_adi = $row['kumas_adi'];
        $fiyat = $row['fiyat'];
        $toplam_siparis = $row['toplam_siparis'];
        $resim_yolu = "img/kumaslar/" . $kumas_id . ".jpg"; // Resmin yolunu oluştur

        // Eğer resim dosyası yoksa, bir varsayılan resim göster
        if (!file_exists($resim_yolu)) {
            $resim_yolu = "img/kumaslar/default.jpg";
        }
    ?>
        <tr>
            <td>
                <img src="<?php echo $resim_yolu; ?>" alt="<?php echo $kumas_adi; ?>" width="70" height="70">
                
            </td>
            <td><?php echo $kumas_adi; ?></td>
            <td><?php echo $fiyat; ?> TL</td>
            <td><?php echo $toplam_siparis; ?></td>
        </tr>
    <?php endwhile; ?>
</tbody>

        </table>

      </div>

    </article>
  </section>


</body>

</html>