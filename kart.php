<?php 
$conn= new mysqli('localhost','root','','dijital_terzi');
session_start();
if(isset($_SESSION['musteriLogin'])) {
    $musteriLogin = $_SESSION['musteriLogin'];
} else {
    echo "musteriLogin oturum değişkeni tanımlı değil.";
}

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailor Crafts</title>
    <link rel="stylesheet" href="kart-style.css">
        <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="card-container">
            <div class="front">
                <div class="image">
                    <img src="img/chip.png" alt="">
                </div>
                <div class="card-number-box">################</div>
                <div class="flexbox">
                    <div class="box">
                        <span>Kart Sahibi</span>
                        <div class="card-holder-name"></div>
                    </div>
                    <div class="box">
                        <span>Son Kullanma Tarihi </span>
                        <div class="expiration">
                            <span class="exp-month">AA /</span>
                            <span class="exp-year">YY</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="back">
                <div class="stripe"></div>
                <div class="box">
                    <span>CVV</span>
                    <div class="cvv-box"></div>
                    <img src="img/visa2.png" alt="">
                    <img src="img/mastercard.png" alt="">
                </div>
            </div>

        </div>

        <form action="kart-kayit.php" method="post">
            <div class="inputBox">
                <span>Kart No</span>
                <input type="text" maxlength="16" id="kart_no" name="kart_no" required class="card-number-input">
            </div>
             <div class="inputBox">
                <span>Kart Sahibi</span>
                <input type="text" id="ad_soyad" name="ad_soyad" required class="card-holder-input">
            </div>  
            <div class="flexbox">
                <div class="inputBox">
                    <span style="width:250px;">Son Kullanma Tarihi</span>
                    <select id="ay" name="ay" class="month-input" style="width: 160px;">
                        <option value="month" selected disabled>Ay</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="inputBox" style="margin-top: 42px; margin-left:-90px; width:250px;">
                   
                    <select id="yil" name="yil" class="year-input">
                        <option value="year" selected disabled>Yıl</option>
                        <option value="2024">2024</option>>
                        <option value="2025">2025</option>>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>>
                        <option value="2029">2029</option>>
                        <option value="2030">2030</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>CVV</span>
                    <input type="text" maxlength="3" id="CVV" name="CVV" required class="cvv-input">
                </div>
            </div>
            <input type="submit" value="Ödeme Yap" class="submit-btn">

        </form>
    </div>

</body>
<script>
    document.querySelector('.card-number-input').oninput = () => {
        document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
    }
    document.querySelector('.card-holder-input').oninput = () => {
        document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
    }

    document.querySelector('.month-input').oninput = () => {
        document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
    }
    document.querySelector('.year-input').oninput = () => {
        document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
    }
   
    document.querySelector('.cvv-input').onmouseenter = () => {
        document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
        document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
    }
    document.querySelector('.cvv-input').onmouseleave = () => {
        document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
        document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
    }
    document.querySelector('.cvv-input').oninput = () => {
        document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
    }

</script>

</html>