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
    <link rel="stylesheet" href="terzi-css/terzi-belge.css">

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
                    <div class="left-menu-item"><img src="terzi-img/siparisler.png" width="30px" height="30px" alt=""><a
                            href="terzi-analiz.php">Analiz</a></div>
                </li>
                </li>
                <hr>
                <li><a href="cikis.php"><i class='bx bx-log-out-circle'>Çıkış</i></a></li>
            </ul>
        </div>
    </div>
    <section>
        <header>
            <div class="hosgeldin">
                <h4>Hoşgeldin Terzi, <span><?php
                if (isset($_SESSION['login']['ad'])) {
                    echo $_SESSION['login']['ad'];
                } else {
                    echo "Giriş yapmış bir kullanıcı bulunamadı.";
                }
                ?></span></h4>

            </div>

            <div class="left-menu-item">
                <img src="terzi-img/terziler.png" width="30px" height="30px" alt=""> <span>Terzi Paneli</span>
            </div>


        </header>
        <article>
            <div class="yazi">
                <h2>Belgelerim</h2>
               <div class="bilgilendirme">
                <h4>Bilgilendirme</h4>
                <ul>
                    <li>Sözleşme ve diğer evraklarınızın tamamı yüklendikten sonra Tailor Crafts tarafından kontrol edilecektir.</li>
                    <li>Tüm evraklarınız onayladıktan sonra hesabınız aktifleştirilecektir.</li>
                    <li>Süreci Terzi Satış Panlei anasayfasından takip edebilirsiniz.</li>
                </ul>
                
               </div>
                

            </div>
            <div class="adres-bilgileri">
                <div class="adres-bilgi-yazi">
                    <h4>Belgelerim </h4>
                    
                </div>
                <div class="form">
                    
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <th><span>Tailor Crafts Satış Sözleşmesi</span></th>
                                <td> <input type="file" id="document" name="document" required ></td>
                            </tr>
                            <tr>
                                <th><span>Vergi Levhası</span></th>
                                <td> <input type="file" id="document" name="document" required ></td>
                            </tr>
                            <tr>
                                <th><span>İmza Sirküleri</span></th>
                                <td><input type="file" id="document" name="document" required ></td>
                            </tr>
                            
                        </table>
                       
                        
                       

                        <input type="submit" name="submit" value="Kaydet" class="kayit-ol">


                    </form>
                </div>
              
            </div>



        </article>
    </section>


</body>

</html>