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

    <?php include '../../header3.php'?>


    <?php
        $takimSor=$db->prepare("SELECT * FROM teams where team_id=:idd");
        $takimSor->execute(array(
            'idd'=>$_GET['id']
        ));

        $takimCek=$takimSor->fetch(PDO::FETCH_ASSOC);
        
        $bir=1;
        $arkadasSor1=$db->prepare("SELECT * FROM arkadaslar where arkadas_user2_kabul=:bir AND (arkadaslar_user2=:idd OR arkadaslar_user1=:idd)");
        $arkadasSor1->execute(array(
        'idd'=>$userCek['user_id'],
         'bir'=>$bir
        ));
    ?>

    <section>
        <div id="ana-section">
                    <div class="mg-2"><h1><?php echo $takimCek['team_namee']?> takımına davet et</h1></div>
                    <?php
                        while($arkadasCek1=$arkadasSor1->fetch(PDO::FETCH_ASSOC)){
                            $goz=$arkadasCek1['arkadaslar_user1'];
                            if($arkadasCek1['arkadaslar_user1']==$userCek['user_id']){
                                $goz=$arkadasCek1['arkadaslar_user2'];
                            }
                            $arkadasSor2=$db->prepare("SELECT * FROM users where user_id=:idd");
                            $arkadasSor2->execute(array(
                                'idd'=>$goz
                            ));
                            $arkadasCek2=$arkadasSor2->fetch(PDO::FETCH_ASSOC);
                            //echo $arkadasCek2['user_id'];
                            //adam takımda var mı onun sorgusunu yapmak için kullanılıyor.
                            $takimSorgula=$db->prepare("SELECT * FROM takimlarim where t_team=:team_idd AND (t_user1=:idd1 OR t_user2=:idd1)");
                            $takimSorgula->execute(array(
                                'team_idd'=>$_GET['id'],
                                'idd1'=>$arkadasCek2['user_id']
                            ));
                            $say1=$takimSorgula->rowCount();
                            if($say1==0){
                    ?>
                        <div class="player">
                            <a href="#" class="player-part1">
                                <div clas="imgdiv">
                                    <img src="../../<?php echo $arkadasCek2['user_img'];?>" alt="">
                                </div>
                                <div>
                                    <div>Kullanıcı adı: <?php echo $arkadasCek2['user_nickname'];?></div>
                                    <div>Mevkii: <?php 
                                    $metin2=$arkadasCek2['user_position'];
                                    $metin2=str_replace("1","Forvet",$metin2);
                                    $metin2=str_replace("2","Orta",$metin2);
                                    $metin2=str_replace("3","Defans",$metin2);
                                    $metin2=str_replace("4","Kaleci",$metin2);
                                    echo $metin2;
                                    ?></div>
                                </div>
                            </a>

                            <div class="player-part2">
                                <button class="button" value="<?php echo $arkadasCek2['user_id']?>">Davet Et</button>
                            </div>
                        </div>
                         <?php }else{}
                        }?>          
        </div>
    </section>

    <script>
        $(".button").click(function(){
            $tuser1=<?php echo $userCek['user_id'];?>;
            $tuser2=$(this).val();
            $team1=<?php echo $_GET['id']?>;
            $.post( "post5TakimaEkleme.php", {tuser1: $tuser1, tuser2: $tuser2, team1:$team1});
        });
    </script>
</body>
</html>