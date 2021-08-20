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
    <title>Saha Bul</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/sahabul/hakan7.css">                          
    <link rel="stylesheet" media="(max-width:992px)" href="css/sahabul/tablet8.css">
    
    <link rel="stylesheet" media="(max-width:576px)" href="css/sahabul/mobile.css"> 
</head>
<body>

<?php include 'header2.php';?>

<section id="ana-section">
    <div id="form-container">
        <form action="" method="GET">
            <div id="bolgeler" class="mgb-1">
                <div class="bolge-item">
                    <select name="tesis_city" id="iller" class="sehir-item" required>
                        <option value="">İl seciniz</option>
                        <?php
                            $sehirSor=$db->prepare("SELECT * from sehir");
                            $sehirSor->execute();
                            while($sehirCek=$sehirSor->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?php echo $sehirCek['sehir_key']?>"><?php echo $sehirCek['sehir_title']?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="bolge-item">
                    <select name="tesis_county" id="ilceler" class="sehir-item" required>
                        <option value="0">İlçe Seçiniz</option>
                    </select>
                </div class="bolge-item">      
            
                <div class="bolge-item">
                    <select name="tesis_village" id="mahalleler" class="sehir-item" required>
                        <option value="0">Mahalle Seçiniz</option>
                    </select>
                </div>
            
            </div>

            <div class="mgb-1">
                
                    <div class="tesis-tur-container">
                        <div class="">Tesis türleri:</div>
                        <div id="yolcu">
                            <div class="tesis-tur">
                                <div>Kapalı</div>
                                <div><input type="checkbox" name="tesis_durum[]" value="1"> </div>
                            </div>
                            <div class="tesis-tur">
                                <div>Açık</div>
                                <div><input type="checkbox" name="tesis_durum[]" value="2"> </div>
                            </div>
                        </div>
                    </div>
            
            </div>

            <div class="mgb-1" id="servis-container">
                <div>Servis:</div>
                <div class="var-yok">
                    <div class="var-yok hd1">
                        <div>var</div>
                        <div class="var-yok"><input type="radio" name="tesis_servis" value="1"></div>
                    </div>
                    <div class="var-yok hd1">
                        <div>yok</div>
                        <div class="var-yok"><input type="radio" name="tesis_servis" value="0"></div>
                    </div>
                </div>           
            </div>

            <div id="tesis-sayisi" class="mgb-1">
                <div>Saha sayisi(en az)</div>
                <div><input type="number" name="tesis_sayisi" min="1"max="10"></div>
            
            </div>

            <div>
                <button type="submit" name="saha_ara" id="arama">Ara</button>
            </div>
        
        
        </form>
    </div>


    <div id="saha-container">
        
            <?php
                if(isset($_GET['saha_ara'])){
                    $select = array();
    
                    if($_GET['tesis_village']!=0){
                        $select[]="&& tesis_village=".$_GET['tesis_village'];
                    }

                    if(isset($_GET['tesis_durum'])){
                        $durum=$_GET['tesis_durum'];
                        $durums=implode($durum,",");
                        $select[]= "AND tesis_durum LIKE '%$durums%'";
                    }

                    if($_GET['tesis_sayisi']!=NULL){
                        $tesis_sayisi=$_GET['tesis_sayisi'];
                        $select[]="AND tesis_sayisi>=$tesis_sayisi";
                    }

                    if($_GET['tesis_servis']!=NULL){
                        $tesis_servis=$_GET['tesis_servis'];
                        $select[]="AND tesis_servis=$tesis_servis";
                    }

                    if(count($select)>0){
                        $hakanss=implode($select," ");
                    }

                    $tesisSor=$db->prepare("SELECT * FROM tesisler where tesis_city=:tesis_city && tesis_county=:tesis_county $hakanss");
                    $tesisSor->execute(array(
                        'tesis_city'=>$_GET['tesis_city'],
                        'tesis_county'=>$_GET['tesis_county']
                    ));
            ?>
        
        <?php while($tesisCek=$tesisSor->fetch(PDO::FETCH_ASSOC)){?>           
        <div class="saha">
                <div>
                    <img src="image/halisaha.jpg" alt="" >
                </div>
                <div class="saha-icerik">
                    <div><div class="saha-title"><?php echo $tesisCek['tesis_ad'];?></div></div>
                    <div>
                        <div class="hakans2">Saha Türü:</div>
                        <?php 
                            $ayirici = $tesisCek['tesis_durum'];
                            $ayirici=str_replace("1","Kapalı",$ayirici);
                            $ayirici=str_replace("2","Açık",$ayirici);
                            echo $ayirici;
                        ?> 
                    </div>
                    <div>
                        <div class="hakans2">Servis:</div>
                        <?php 
                        $ayirici2 = $tesisCek['tesis_servis'];
                        $ayirici2 = str_replace("0","Yok",$ayirici2);
                        $ayirici2 = str_replace("1","Var",$ayirici2);
                        echo $ayirici2;
                        ?> 
                    </div>
                    <div><div class="hakans2">Tesis sayısı:</div> <?php echo $tesisCek['tesis_sayisi'];?></div>
                    <div><div class="hakans2">Tel:</div> <a href="tel://<?php echo $tesisCek['tesis_tel'];?>"><?php echo $tesisCek['tesis_tel'];?></a></div>
                    <div><div class="hakans2">Adres:</div> <?php echo $tesisCek['tesis_adres'];?></div>
                </div>
        </div>
        <?php }} ?>      
    </div>
</section>

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