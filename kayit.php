<?php include 'baglan.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayit Sayfasi</title>
    <link rel="shorcut icon" href="./image/logo.png">
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    
    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/alert.css">
    <link rel="stylesheet" href="css/kayit/kayit2.css">
    <link rel="stylesheet" media="(max-width:992px)" href="css/kayit/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/kayit/tablet.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/kayit/mobile.css">
    
</head>
<body>
    <nav>
        <div id="nav-container">
            <h1><a href="index.php">panenka</a></h1>
            </div>
    </nav>

    <header>

    </header>
    <section id="form-section">
        <div id="form-container">
            <div id="baslik">KAYDOL</div>
            <hr>
            
            <div></div>
            
                <form action="islem.php" method="POST" id="form-ana">
                    
                    <?php if(isset($_GET['kayit'])){
                            echo '<div class="alert-red">Bu kullanıcı adı veya e-posta alınmış !'.' </div> ';
                    }
                    ?>
                    <div class="ayir">
                        <input type="text" id="name" name="user_namee"class="boyut-33"placeholder="Adın" required>
                        <input type="text" id="surname"  name="user_surname" class="boyut-33"placeholder="Soyadın"required>
                    </div>
                
                    <input type="text" id="nickname" name="user_nickname" placeholder="Kullanıcı adın"required>
                    <input type="email" id="email" name="user_email" placeholder="E-posta adresin"required>
                    <input type="password" id="password" name="user_password" placeholder="Yeni şifre"required>
                    
                    <div class="margin-top-1">Doğum tarihi</div>
                    <div class="ayir ayir-2">
                    <select name="user_day" id="gun"required >
                            <?php 
                            for( $say=1;$say<=31;$say++){
                                echo '<option value="'.$say.'">'.$say.'</option>';
                            }
                            ?>
                    </select>
                    
                    <select name="user_month" id="ay"required>
                            <option value="1">Ocak</option>
                            <option value="2">Şubat</option>
                            <option value="3">Mart</option>
                            <option value="4">Nisan</option>
                            <option value="5">Mayıs</option>
                            <option value="6">Haziran</option>
                            <option value="7">Temmuz</option>
                            <option value="8">Ağustos</option>
                            <option value="9">Eylül</option>
                            <option value="10">Ekim</option>
                            <option value="11">Kasım</option>
                            <option value="12">Aralık</option>
                    </select>
                        <select name="user_year" id="yil"required>
                        <?php 
                            for( $say=2010;$say>=1960;$say--){
                                echo '<option value="'.$say.'">'.$say.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="margin-top-1">Bölge Seciniz</div>
                    <div class="ayir3">
                        <select name="user_city" id="iller" required>
                            <option value="">İl seciniz</option>
                            <?php
                                $sehirSor=$db->prepare("SELECT * from sehir");
                                $sehirSor->execute();
                                while($sehirCek=$sehirSor->fetch(PDO::FETCH_ASSOC)){ ?>
                                <option value="<?php echo $sehirCek['sehir_key']?>"><?php echo $sehirCek['sehir_title']?></option>
                                <?php } ?>
                        </select>
                        
                            <select name="user_county" id="ilceler"required>
                                <option value="">İlçe Seçiniz</option>
                            </select>
                            <select name="user_village" id="mahalleler"required>
                                <option value="">Mahalle Seçiniz</option>
                            </select>                        
                    </div>
                    <div class="margin-top-1">Mevkii Seciniz:</div>
                    <div class="mevkii ayir">
                        <div class="yaniyo"><div>Forvet:</div> <div><input type="checkbox"  name="user_position[]" value="1" ></div></div>
                        <div class="yaniyo"><div>Orta Saha:</div><div><input type="checkbox"  name="user_position[]" value="2"></div></div>
                        <div class="yaniyo"><div>Defans:</div><div><input type="checkbox"  name="user_position[]" value="3"></div></div>
                        <div class="yaniyo"><div>Kaleci:</div><div><input type="checkbox" name="user_position[]" value="4"></div></div> 
                    </div>

                    
                    <button type="submit" class="btn btn-1" name="kayitislemi">Kaydol</button>
                </form>
            
        </div>   
        <div class="etiket-container">İşletmen için <a href="sayfaolustur.php" class="etiket">sayfa oluştur</a></div> 
    </section>



    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>

    <!--SEHİR SECME-->
    <script>
        $(document).ready(function(){
            $('#iller').change(function(){
                $('#ilceler').empty();
                var deger=$(this).val();
                $.post("post/post1-ilce-cek.php",{il:deger},function(a){
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
                $.post("post/post2-mahalle-cek.php",{ilce:deger},function(a){
                    $('#mahalleler').append(a);
                })
            });
        });
    </script>

</body>
</html>