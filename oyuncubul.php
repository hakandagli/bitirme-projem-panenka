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
    <title>Oyuncu Bul</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/oyuncubul/deneme13.css">                          
    <link rel="stylesheet" media="(max-width:992px)" href="css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/oyuncubul/tablet7.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/oyuncubul/mobile.css">                  
</head>
<body>
    <?php include 'header2.php'?>

    <section id="search">
        <div id="search-container">
            <form action="" method="GET" id="yan-yana23">
                <input type="text" placeholder="Kullanıcı adını giriniz" name="mero">
                <button type="submit" name="oyuncu-search" id="arama2">Ara</button>
            </form>
        </div>
    </section>

    <section id="ana-section">
        <div id="form-section">
        <form action="" method="GET">
            <div id="secim-container">
                <div id="kısım1" class="mg-bt-1">
                    <div id="bolgeler" class="mg-bt-1">
                        <div>
                            <select name="user_city" id="iller" class="bolge-item" required>
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
                            <select name="user_county" id="ilceler" class="bolge-item" required>
                                <option value="0">İlçe Seçiniz</option>
                            </select>
                        </div>      
            
                        <div>
                            <select name="user_village" id="mahalleler" class="bolge-item" required>
                                <option value="0">Mahalle Seçiniz</option>
                            </select>
                        </div>
                    </div>

                    <div id="yas-container">
                        <div class="min-max-yas">
                            <div>Yaş(max)</div>
                            <div><input type="number" name="max_yas" max="100" min="1"></div> 
                        </div>
                
                        <div class="min-max-yas">
                            <div>Yaş(min)</div>
                            <div><input type="number" name="min_yas" max=100 min="1" ></div>
                        </div>
                    </div>

                </div>
                
                <div id="kısım2">
                    <div>Mevkii Seçiniz</div>
                        <div id="mevkiler">
                            
                            <div class="mevki">
                                <div>Forvet:</div>
                                <div><input type="radio"  name="user_position" value="1" ></div>
                            </div>
                            <div class="mevki">
                                <div>Ortasaha:</div>
                                <div><input type="radio"  name="user_position" value="2"></div>       
                            </div>
                                
                            <div class="mevki">
                                <div>Defans:</div>
                                <div><input type="radio"  name="user_position" value="3"></div>
                                
                            </div>
                                
                            <div class="mevki">
                                <div>Kaleci:</div>
                                <div><input type="radio" name="user_position" value="4"></div>
                            </div>        
                        </div>
                </div>
            </div>

            <div>
            <button type="submit" name="oyuncu_ara" id="arama">Ara</button>     
            </div>
    </form>
    </div>
    <div id="player-list">
        <?php
            if(isset($_GET['oyuncu_ara'])){
            $zaman=2021;
            $select = array();
    
            if($_GET['user_village']!=0){
                $select[]="&& user_village=".$_GET['user_village'];
            }

            /*if(isset($_GET['user_position'])){
                $position=$_GET['user_position'];
                $positions=implode($position,",");
                $select[]= "AND user_position LIKE '%$positions%'";
            }*/

            if(isset($_GET['user_position'])){
                $position=$_GET['user_position'];
                $select[]="AND user_position LIKE '%$position%'";
            }

            if($_GET['max_yas']!=NULL){
            $min_years=$zaman-$_GET['max_yas'];
            $select[]="AND user_year>=$min_years";
            }
    
            if($_GET['min_yas']!=NULL){
            $max_years=$zaman-$_GET['min_yas'];
            $select[]="AND user_year<=$max_years";
            }

            if(count($select)>0){
                $hakanss=implode($select," ");
            }

            $oyuncuSor=$db->prepare("SELECT * FROM users where user_city=:user_city && user_county=:user_county $hakanss");
            $oyuncuSor->execute(array(
                'user_city'=>$_GET['user_city'],
                'user_county'=>$_GET['user_county']
            ));
            ?>
            
             <!--ara kısmı kodları-->
            
        
            <div class="player-container">
            <?php while($oyuncuCek=$oyuncuSor->fetch(PDO::FETCH_ASSOC)){?>
                    <a href="oyuncu.php?id=<?php echo $oyuncuCek['user_id'] ?>" class="player">
                        <div><img src="<?php echo $oyuncuCek['user_img']?>" alt=""></div>
                        <div> <?php echo $oyuncuCek['user_nickname']?></div>
                        <div>yaş: 
                            <?php
                                $userYas=$zaman-$oyuncuCek['user_year'];
                                echo $userYas;
                            ?>
                        </div>
                        <div class="mevki-list-2">
                            <?php 
                                $metin=$oyuncuCek['user_position'];
                                /*$dizi2=explode(",",$metin);*/
                                $metin=str_replace("1","Forvet",$metin);
                                $metin=str_replace("2","Orta",$metin);
                                $metin=str_replace("3","Defans",$metin);
                                $metin=str_replace("4","Kaleci",$metin);
                                echo $metin;
                                ?>
                        </div>
                    </a>    
            <?php }} ?>
            </div>

            <?php
                if(isset($_GET['oyuncu-search'])){
                    $oyuncuSor2=$db->prepare("SELECT * FROM users where user_nickname=:heromero");
                    $oyuncuSor2->execute(array(
                        'heromero'=>$_GET['mero']
                    ));
            ?>
                <div class="player-container">
                <?php while($oyuncuCek2=$oyuncuSor2->fetch(PDO::FETCH_ASSOC)){?>
                
                    
                    <a href="oyuncu.php?id=<?php echo $oyuncuCek2['user_id'] ?>" class="player">
                        <div><img src="<?php echo $oyuncuCek2['user_img']?>" alt=""></div>
                        <div> <?php echo $oyuncuCek2['user_nickname']?></div>
                        <div>yaş: 
                            <?php
                                $zaman=2021;
                                $userYas=$zaman-$oyuncuCek2['user_year'];
                                echo $userYas;
                            ?>
                        </div>
                        <div class="mevki-list-2">
                            <?php 
                                $metin=$oyuncuCek2['user_position'];
                                /*$dizi2=explode(",",$metin);*/
                                $metin=str_replace("1","Forvet",$metin);
                                $metin=str_replace("2","Orta",$metin);
                                $metin=str_replace("3","Defans",$metin);
                                $metin=str_replace("4","Kaleci",$metin);
                                echo $metin;
                                ?>
                        </div>
                    </a>     
            <?php }} ?>
            </div>   
        </div>
    </section>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>
    
    <script>
	    $('#nav-icon').click(function(){			
			$('#nav-container-2').toggleClass("display-none");
			return false;
		});
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