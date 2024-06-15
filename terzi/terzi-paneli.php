<?php
$conn = new mysqli('localhost', 'root', '', 'dijital_terzi');
session_start();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$durum_id = 0;
if (isset($_SESSION['login']['terzi_id'])) {
    $terzi_id = $_SESSION['login']['terzi_id'];
    $sql = "SELECT durum_id FROM terzi WHERE terzi_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $terzi_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $durum_id = $row['durum_id'];
        }
        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="terzi-css/terzi-paneli.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                <h3>Hoşgeldin Terzi,  <span>
                    <?php
                    if (isset($_SESSION['login']['ad'])) {
                        echo $_SESSION['login']['ad'];
                    } else {
                        echo "Giriş yapmış bir kullanıcı bulunamadı.";
                    }
                    ?>
                    </span> </h3>        
            </div>

            <div class="left-menu-item">
                <img src="terzi-img/terziler.png" width="30px" height="30px" alt=""> <span>Terzi Paneli</span>
            </div>
        </header>
        <article class="ust">
            <ul class="progressUL">
                <li class="progress">
                    <i class='bx bxs-file-plus'></i>
                    <div class="asama bir">  
                        <p class="text">-</p>           
                        <i class='uil bx bx-check'></i>
                    </div>
                    <p class="yazi ybir">Bilgilerini Tamamla</p>
                </li>
                <li class="progress">
                    <i class='bx bxs-file-export'></i>
                    <div class="asama iki">
                        <p class="text">-</p>  
                        <i class='uil bx bx-check'></i>
                    </div>
                    <p class="yazi yiki">Başvurun Alındı</p>
                </li>
                <li class="progress">
                    <i class='bx bxs-file-find'></i>
                    <div class="asama uc">
                        <p class="text">-</p>  
                        <i class='uil bx bx-check'></i>             
                    </div>
                    <p class="yazi yuc">Başvurun İnceleniyor</p>
                </li>
                <li class="progress">
                    <i class='bx bxs-badge-check'></i>
                    <div class="asama dort">
                        <p class="text">-</p>  
                        <i class='uil bx bx-check'></i>         
                    </div>
                    <p class="yazi ydort">Başvurun Onaylandı</p>
                </li>
            </ul>
        </article>
        <article class="alt-article">     
            <ul>
                <li>Başvurunun tamamlanması için <b>bilgi</b> ve <b>belgelerini</b> eksiksiz bir şekilde doldurman gerekli.</li>
                <li>Bilgilerim ve Belgelerim menülerine tıklayarak başvurunu tamamla.</li>
                <li>Başvurunla ilgili seni en kısa zamanda bilgilendireceğiz.</li>
            </ul>
        </article>
    </section>

    <script>
        const durum_id = <?php echo $durum_id; ?>;
        
        const bir = document.querySelector(".bir");
        const iki = document.querySelector(".iki");
        const uc = document.querySelector(".uc");
        const dort = document.querySelector(".dort");

        function updateProgress(durum_id) {
            if (durum_id >= 0) {
                bir.classList.add("active");
                document.querySelector(".ybir").style.fontWeight = "bold";
                document.querySelector(".ybir").style.color = "#000";
            }
            if (durum_id >= 1) {
                iki.classList.add("active");
                document.querySelector(".yiki").style.fontWeight = "bold";
                document.querySelector(".yiki").style.color = "#000";
            }
            if (durum_id >= 2) {
                uc.classList.add("active");
                document.querySelector(".yuc").style.fontWeight = "bold";
                document.querySelector(".yuc").style.color = "#000";
            }
            if (durum_id >= 3) {
                dort.classList.add("active");
                document.querySelector(".ydort").style.fontWeight = "bold";
                document.querySelector(".ydort").style.color = "#000";
            }
        }

        updateProgress(durum_id);
    </script>
</body>

</html>
