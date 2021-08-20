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
    <link rel="shorcut icon" href="image/logo.png">
    <title>Panenka Giris</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/anasayfa/anasayfa2.css">
    <link rel="stylesheet" media="(max-width:992px)" href="css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/anasayfa/tablet.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/anasayfa/mobile.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!--Slider Dosyaları /// yapılış linki https://www.youtube.com/watch?v=25hyyRoywsQ-->
    <link rel="stylesheet" href="animasyon/slider/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="animasyon/slider/owlcarousel/assets/owl.theme.default.min.css">


</head>

<body>
    <nav></nav>

    <header>
        <div id="header-container">
            <div id="baslik-container">
                <div id="baslik">Panenka</div>
                <div class="aciklama">Panenka halısaha kültürünü internetin gücü ile birleştirerek;<br>rakip, oyuncu ve saha bulmanıza yardımcı olur.</div>
            </div>
        </div>
    </header>

    <section id="ana-container">

        <div id="slider" data-aos="fade-right">
            <div class="owl-carousel owl-theme">
                <div class="item">
                    <div class="img-class"><img src="image/kralex.jpg" alt=""></div>
                </div>
                <div class="item">
                    <div class="img-class"><img src="image/sneijder.jpg" alt=""></div>
                </div>
                <div class="item">
                    <div class="img-class"><img src="image/quaresma.jpg" alt=""></div>
                </div>
            </div>
        </div>


        <div id="login-form-container" data-aos="fade-left">
            <h2>Hoş Geldiniz</h2>
            <form action="islem.php" method="POST" id="login-form">
                <div class="form-group">
                    <input type="text" id="name" name="user_nickname" placeholder="Kullanıcı adı veya E-posta">
                </div>

                <div class="form-group">
                    <input type="password" placeholder="Parola" name="user_password">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-1" name="girisYap">Giriş Yap</button>
                </div>
                <div class="form-group">
                    <a href="">Şifreni mi unuttun ?</a>
                </div>
                <hr>
                <br>
                <div class="form-group">
                    <a class="btn btn-2" href="kayit.php" id="kayit-button">Kayıt Ol</a>
                </div>
            </form>
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>

    <!--<script>
	    $('#kayit-button').click(function(){			
			window.open('kayit.php','_blank');
		});
    </script>-->


    <!-- Slider javascript -->
    <script src="animasyon/slider/owlcarousel/jquery.min.js"></script>
    <script src="animasyon/slider/owlcarousel/owl.carousel.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: false,
            autoplay: true,
            autoplayTimeout: 2000,


            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    </script>
    <!--Animasyon-->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>