<?php
include 'baglan.php';
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hakanenka</title>
    <link rel="shorcut icon" href="image/logo.png">

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/userpanel/userpanel.css">
    <link rel="stylesheet" media="(max-width:992px)" href="css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/userpanel/tablet.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/userpanel/mobile.css">
    
</head>
<body>
<?php include 'header2.php';?>
    <section id="select-section">
        <div id="select-container">
            
            <a href="oyuncubul.php" class="select-item" id="oyuncubul">
                <div class="select-baslik">Oyuncu Bul</div>
                <div class="select-aciklama">Aradığın kriterde oyuncu bul</div>
            </a>
            <a href="sahabul.php" class="select-item" id="sahabul">
                
                <div class="select-baslik">Saha Bul</div>
                <div class="select-aciklama">Aradığın kriterde sahayı bul</div>
            </a>
            <a href="rakipbul.php"class="select-item" id="rakipbul">
                
                <div class="select-baslik">Rakip Bul</div>
                <div class="select-aciklama">Aynı rakiplerle maç yapmaktan bıktın mı ?</div>
            </a>
            
        </div>
    </section>
    <footer>
        <div id="footer-container">
              <div class="footer-button">
                        <div id="sosyal">
                            <div class="aciklama">Sosyal ağlarda bizi takip edin </div>
                            <ul>
                                <li><a href="https://www.facebook.com/profile.php?id=100006453999906" class="btn-social" target="_blank"><i class="fab fa-fw fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com/Hakan_Dagli" class="btn-social" target="_blank"><i class="fab fa-fw fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/hakan.dagli" class="btn-social" target="_blank"><i class="fab fa-fw fa-instagram"></i></a></li>  
                            </ul>
                        </div>
                    
                <div id="footer-diger">
                    <ul>
                        <li><a href="">Hakkımızda</a></li>
                        <li><a href="">İletişim</a></li>
                        <li><a href="">Gizlilik ilkeleri</a></li>
                        <li><a href="">Kullanıcı Sözleşmesi</a></li>
                    </ul>
                </div>
            </div>   
        </div>
        <div id="copyright">
            <div><small>Copyright © 2020 | Hiçbir Hakkı Saklı Değildir</small></div>
        </div>
    </footer>
</body>
</html>