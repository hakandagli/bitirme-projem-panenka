<?php
include 'baglan.php';
session_start();
ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="./image/logo.png">
    <title>Arkadaşlar</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/arkadaslar/arkadaslar3.css">
    <link rel="stylesheet" media="(max-width:1200px)" href="css/arkadaslar/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/arkadaslar/tablet2.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/arkadaslar/mobile1.css">     
</head>
<body>
    <?php include 'header2.php';?>
    <section id="ana-section">
        <div id="ana-container">
            <div>
                <div><button id="istekbuton">Arkadaşlık İsteklerini Görüntüle</button></div>
            </div>
            <?php
            $bir=1;
            $istekSor2=$db->prepare("SELECT * FROM arkadaslar where arkadas_user2_kabul=:bir AND arkadaslar_user2=:idd OR arkadaslar_user1=:idd");
            $istekSor2->execute(array(
            'idd'=>$userCek['user_id'],
             'bir'=>$bir
            ));

            $say5=$istekSor2->rowCount();

            if($say5==0){
                echo "arkadas bulunamadı";
            }else{
                echo "arkadas bulundu";
            }
            ?>
            <div id="user-friend">
                <div id="player-container">
                    <div id="arkadaslar">Arkadaşlar</div>
                    <div id="player-container2">
                    <?php while($istekCek2=$istekSor2->fetch(PDO::FETCH_ASSOC)){?>
                        <?php
                        $goz=$istekCek2['arkadaslar_user1'];
                        if($istekCek2['arkadaslar_user1']==$userCek['user_id']){
                            $goz=$istekCek2['arkadaslar_user2'];
                        }
                        $istekSor3=$db->prepare("SELECT * FROM users where user_id=:idd");
                        $istekSor3->execute(array(
                        'idd'=>$goz
                        ));

                        while($istekCek3=$istekSor3->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <a href="oyuncu.php?id=<?php echo $istekCek3['user_id'];?>" class="player">
                            <div><img src="<?php echo $istekCek3['user_img']?>" alt=""></div>
                            <div><?php echo $istekCek3['user_nickname'];?></div>
                            
                            <div class="mevki-list-2">
                            <?php 
                                $metin=$istekCek3['user_position'];
                                /*$dizi2=explode(",",$metin);*/
                                $metin=str_replace("1","Forvet",$metin);
                                $metin=str_replace("2","Orta",$metin);
                                $metin=str_replace("3","Defans",$metin);
                                $metin=str_replace("4","Kaleci",$metin);
                                echo $metin;
                                ?>
                            </div>
                        </a>
                    <?php }}?>
                    </div>
                </div>

               <?php
               $sifirdegiskeni=0;
               $istekSor=$db->prepare("SELECT * FROM arkadaslar where arkadaslar_user2=:idd AND arkadas_user2_kabul=:sifir");
               $istekSor->execute(array(
               'idd'=>$userCek['user_id'],
                'sifir'=>$sifirdegiskeni
               ));
               $say384=$istekSor->rowCount();
               ?>
                <div id="hakanmero" class="displayNone"> 
                    <div>Arkadaşlık İstekleri</div>

                    <div id="istek-container">
                        <?php while($istekCek=$istekSor->fetch(PDO::FETCH_ASSOC)){?>
                        <div class="istek-atanlar">
                            <div class="istek-kafa">
                            <?php 
                            $oyuncuSor2=$db->prepare("SELECT * FROM users where user_id=:id2");
                            $oyuncuSor2->execute(array(
                                'id2'=>$istekCek['arkadaslar_user1']
                            ));

                            $oyuncuCek2=$oyuncuSor2->fetch(PDO::FETCH_ASSOC);
                        
                            ?>
                            <div><img src="<?php echo $oyuncuCek2['user_img']?>" alt=""></div>
                            <div><?php echo $oyuncuCek2['user_nickname']?></div>


                            </div>
                            <div class="butonlar5">
                                <button class="kabulbuton" value="<?php echo $oyuncuCek2['user_id']?>">Kabul et</button>
                                <button class="redbuton" value="<?php echo $oyuncuCek2['user_id']?>">Sil</button>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>

    <script>
	    $('#nav-icon').click(function(){			
			$('#nav-container-2').toggleClass("display-none");
            $('#navi2').toggleClass("display-none");
            $('#navi').toggleClass("display-none");
			return false;
		});
    </script>

        <script>
        $namik=0;
	    $('#istekbuton').click(function(){
            			
		   $('#hakanmero').toggleClass("displayNone");
           $('#player-container').toggleClass("displayNone");
           $namik++;
           if($namik%2==1){
            $(this).html ("Arkadaşları Görüntüle");
           }else{
            $(this).html ("Arkadaşlık İsteklerini Görüntüle"); 
           }
           
		});
    </script>

    <script>
    $('#nav-icon2').click(function(){			
        $('#nav-container-2').toggleClass("display-none");
        $('#navi2').toggleClass("display-none");
        $('#navi').toggleClass("display-none");
        return false;
    });
    </script>
    
    <script>
    $(".kabulbuton").click(function() {
        $fuser1=$(this).val();
        $fuser2=<?php echo $userCek['user_id'];?>;
        $.post( "post/post6ArkadasKabul.php", { fuser1: $fuser1,fuser2:$fuser2});
        $(this).html ("Kabul edildi");
    });
    </script>

    <script>
    $(".redbuton").click(function(){
        $fuser1=$(this).val();
        $fuser2=<?php echo $userCek['user_id'];?>;
        $.post("post/post4IstekSilme.php", { user1: $fuser1,user2:$fuser2});
        $(this).html ("Silindi");
    });
    </script>


</body>
</html>