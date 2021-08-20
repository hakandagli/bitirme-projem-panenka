<?php
include '../baglan.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="../image/logo.png">
    <title>Takım Olustur</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/navbar3.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/takimOlustur/hakan10.css">                          
    <link rel="stylesheet" media="(max-width:992px)" href="../css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="../css/takimOlustur/tablet2.css">
    <link rel="stylesheet" media="(max-width:576px)" href="../css/takimOlustur/mobile.css">
</head>
<body>

<?php include '../header.php'?>
<section id="ana-section">

    <div >
        <form action="../islem.php" id="takimOlustur" method="POST" enctype="multipart/form-data"  >
            <div><input type="text" class="inputItem" placeholder="takım adı giriniz" name="team_namee" ></div>
            <input type="number" hidden value="<?php echo $userCek['user_id'];?>" name="user_id">
            <input type="number"  hidden value="<?php echo $userCek['user_team_capacity'];?>" name="user_team_capacity">
            <div>
                
                <div>
                    <select name="team_city" id="iller" class="bolge-item inputItem" required>
                        <option value="">İl seciniz</option>
                        <?php
                            $sehirSor=$db->prepare("SELECT * from sehir");
                            $sehirSor->execute();
                            while($sehirCek=$sehirSor->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?php echo $sehirCek['sehir_key']?>"><?php echo $sehirCek['sehir_title']?></option>              
                        <?php } ?>
                    </select>
                </div>
            

                <div>
                    <select name="team_county" id="ilceler" class="bolge-item inputItem" required>
                        <option value="0">İlçe Seçiniz</option>
                    </select>
                </div>      
            
                <div>
                    <select name="team_village" id="mahalleler" class="bolge-item inputItem" required>
                        <option value="0">Mahalle Seçiniz</option>
                    </select>
                </div>  
            
            </div>

            <div class="itemmt2">
                <div>Maç günlerini seçin</div>
                <div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="1">Pazartesi</div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="2">Salı</div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="3">Çarşamba</div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="4">Perşembe</div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="5">Cuma</div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="6">Cumartesi</div>
                    <div class="ortala"><input type="checkbox" name="team_day[]" value="7">Pazar</div>
                </div>
            </div>

            <div class="itemmt2">
                <div>RakipBul'da görünürlük</div>
                <div class="yanyana">
                    <div class="ortala">Açık<input type="radio" name="team_rakipbul" value="1" checked></div>
                    <div class="ortala">Kapalı<input type="radio" name="team_rakipbul" value="0"></div>
                </div>
            </div>

            <div class="itemmt2">
                <div>Başvurular</div>
                <div class="yanyana">
                    <div class="ortala">Açık<input type="radio" name="team_takimbul" value="1" checked></div>
                    <div class="ortala">Kapalı<input type="radio" name="team_takimbul" value="0"></div>
                </div>
            </div>



            <div id="fotos">
                <div>Resim Sec</div>
                <div><input type="file" id="fotoss" name="team_foto" accept="image/png, image/jpeg"></div>
            </div>

            <div>
            <button type="submit" id="takimbutton" name="teamCreate">Oluştur</button>
            </div>
        </form>
    </div>

</section>



    <script>
        $(document).ready(function(){
            $('#iller').change(function(){
                $('#ilceler').empty();
                var deger=$(this).val();
                $.post("../post/post1-ilce-cek.php",{il:deger},function(a){
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
                $.post("../post/post2-mahalle-cek.php",{ilce:deger},function(a){
                    $('#mahalleler').append(a);
                })
            });
        });
    </script>
</body>
</html>