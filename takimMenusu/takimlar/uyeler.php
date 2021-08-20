<?php
include '../../baglan.php';
session_start();
ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/navbar3.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/uyeler/uyeler5.css">
    <link rel="stylesheet" media="(max-width:992px)" href="../../css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="../../css/uyeler/tablet.css">
    <link rel="stylesheet" media="(max-width:576px)" href="../../css/uyeler/mobile.css">
</head>
<body>


    <?php include '../../header.php'?>

    <?php
        
        $takimSor=$db->prepare("SELECT * FROM teams where team_id=:idd");
        $takimSor->execute(array(
            'idd'=>$_GET['id']
        ));

        $takimCek=$takimSor->fetch(PDO::FETCH_ASSOC);
        //echo $takimCek['team_uye'];

        $metin=$takimCek['team_uye'];
        $dizi = explode(",",$metin);
        
        //print_r ($dizi);

        /*for($i = 0; $i<count($dizi); $i++) {
            //echo $dizi[$i]."-";
            $oyuncuSor=$db->prepare("SELECT * FROM users where user_id=:idd2");
            $oyuncuSor->execute(array(
                'idd2'=>$dizi[$i]
            ));
            $oyuncuCek=$oyuncuSor->fetch(PDO::FETCH_ASSOC);
            echo $oyuncuCek['user_nickname'];
        }*/
        
    ?>
    <section>
        <div id="ana-section">
                    <div class="mg-2"><h1><?php echo $takimCek['team_namee']?> üyeler</h1></div>
                        <?php
                            for($i = 0; $i<count($dizi); $i++) {
                                //echo $dizi[$i]."-";
                                if($i==0){
                                    continue;
                                }
                                $oyuncuSor=$db->prepare("SELECT * FROM users where user_id=:idd2");
                                $oyuncuSor->execute(array(
                                    'idd2'=>$dizi[$i]
                                ));
                                $oyuncuCek=$oyuncuSor->fetch(PDO::FETCH_ASSOC);
                                
                            ?>
                        <div class="player">
                            <a href="#" class="player-part1">
                                <div clas="imgdiv">
                                    <img src="../../<?php echo $oyuncuCek['user_img'];?>" alt="">
                                </div>
                                <div>
                                    <div>Kullanıcı adı: <?php echo $oyuncuCek['user_nickname'];?></div>
                                    <div>Mevkii: <?php 
                                    $metin2=$oyuncuCek['user_position'];
                                    $metin2=str_replace("1","Forvet",$metin2);
                                    $metin2=str_replace("2","Orta",$metin2);
                                    $metin2=str_replace("3","Defans",$metin2);
                                    $metin2=str_replace("4","Kaleci",$metin2);
                                    echo $metin2;
                                    ?></div>
                                </div>
                            </a>

                            <div class="player-part2">
                                <button class="button" value="<?php echo $oyuncuCek['user_id']?>">Takımdan Çıkar</button>
                            </div>
                        </div>
                         <?php } ?>               
                        
                    

        </div>
    </section>

    <script>
        $(".button").click(function(){
            $cikar=1;
            $userId=$(this).val();
            $takimId=<?php echo $_GET['id']?>;
            $.post( "../../post/post7TakimIstekSilme.php", { userId: $userId, teamId: $takimId, cikar:$cikar});
            $(this).parent().parent().toggleClass("displayNone");
            
        });
</script>
</body>
</html>