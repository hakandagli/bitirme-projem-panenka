<?php include 'baglan.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="image/logo.png">
    <title>Sayfa Olustur</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="shorcut icon" href="./image/logo.png">
    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/kayit/kayit2.css">
    
    <link rel="stylesheet" media="(max-width:992px)" href="css/kayit/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/kayit/tablet.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/kayit/mobile.css">
    
</head>
<body>
    <nav>
        <div id="nav-container">
            <h1><a href="">panenka</a></h1>
            </div>
    </nav>
    
    <header></header>
    <section id="form-section">
        <div id="form-container">
            <div id="baslik">İŞLETME OLUSTUR</div>
            <hr>
            
            <div></div>
            
                <form action="islem.php" id="form-ana" method="POST">
                    <div class="ayir">
                        <input type="text" class="boyut-33"placeholder="Adınız" name="tesis_sahibi_ad">
                        <input type="text" class="boyut-33"placeholder="Soyadınınız" name="tesis_sahibi_soyad">
                    </div>
                
                    <input type="text" placeholder="İşletme adı" name="tesis_ad">
                    <input type="email" placeholder="E-posta adresiniz" name="tesis_mail">
                    <input type="tel" placeholder="Telefon numaranız" name="tesis_tel">
                    <input type="text" placeholder="Oluşturma Kodunuz" name="kod">
                    <input type="password" placeholder="Yeni şifre" name="tesis_sifre">
                    
                    <div class="margin-top-1">Bölge Seciniz</div>
                    <div class="ayir3">
                    
                            <select name="tesis_city" id="iller" class="bolge-item" required>
                                <option value="">İl seciniz</option>
                            <?php
                                $sehirSor=$db->prepare("SELECT * from sehir");
                                $sehirSor->execute();
                                while($sehirCek=$sehirSor->fetch(PDO::FETCH_ASSOC)){ ?>
                                <option value="<?php echo $sehirCek['sehir_key']?>"><?php echo $sehirCek['sehir_title']?></option>
                            <?php } ?>
                            </select>
                        

                       
                            <select name="tesis_county" id="ilceler" class="bolge-item" required>
                                <option value="0">İlçe Seçiniz</option>
                            </select>
                             
            
                       
                            <select name="tesis_village" id="mahalleler" class="bolge-item" required>
                                <option value="0">Mahalle Seçiniz</option>
                            </select>   
                    </div>
                    <div class="margin-top-1">Tesis Türlerini seçiniz</div>
                    <div class="mevkii ayir">
                        <div class="yaniyo"><div>Kapalı: </div><div><input type="checkbox" name="tesis_durum[]" value="1"></div> </div>
                        <div class=yaniyo><div>Açık: </div><div><input type="checkbox" name="tesis_durum[]" value="2"></div> </div>
                    </div>
                    
                    
                    <div class="yaniyo2">
                        <div>Tesis Sayısı:</div><div><input type="number" name="tesis_sayisi"></div>
                    </div>

                    

                    <div>
                        <textarea name="tesis_adres" id="" cols="30" rows="10" placeholder="Adres ve dilerseniz ek bilgi giriniz"></textarea>
                    </div>

                    <div >
                        
                        <div class="yaniyo3">
                        <div class="yaniyo4">Servis:</div>
                            <div class="yaniyo4"><div>Var </div><div><input type="radio" name="tesis_servis" value="1"></div></div>
                            <div class=yaniyo4><div>Yok </div><div><input type="radio" name="tesis_servis" value="0" checked></div></div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-1" name="tesis_kayit">Sayfa Oluştur</button>
                </form>
            
        </div>   
        <div class="etiket-container">Oluşturma kodu almak için <a href="sayfaolustur.html" class="etiket">iletişime</a> geçiniz</div>
    </section>


    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>

    <script>
        $(document).ready(function(){
            $('#iller').change(function(){
                $('#ilceler').empty();
                var deger=$(this).val();
                $.post("post.php",{il:deger},function(a){
                    $('#ilceler').append(a);
                })
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#ilceler').change(function(){
                $('#mahalleler').empty();
                var deger=$(this).val();
                $.post("post2.php",{ilce:deger},function(a){
                    $('#mahalleler').append(a);
                })
            });
        });
    </script>

</body>
</html>