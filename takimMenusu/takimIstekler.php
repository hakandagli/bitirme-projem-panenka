<?php
include '../baglan.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="../image/logo.png">
    <title>Takim İstekleri</title>
<!--Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<!--CSS -->
<link rel="stylesheet" href="../css/all.css">
<link rel="stylesheet" href="../css/navbar3.css">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/takimIstekler/takimIstekler2.css">
<link rel="stylesheet" media="(max-width:992px)" href="../css/tabletbuyuk.css">
<link rel="stylesheet" media="(max-width:768px)" href="../css/takimIstekler/tablet.css">
<link rel="stylesheet" media="(max-width:576px)" href="../css/takimIstekler/mobile.css">
</head>
<body>

    <?php include '../header.php'?>

    <?php
    $sifir=0;
    $takimSor=$db->prepare("SELECT * FROM takimlarim where t_user2=:idd AND t_user2_kabul=:sifir");
    $takimSor->execute(array(
        'idd'=>$userCek['user_id'],
        'sifir'=>$sifir
    ));
    ?>



    <section>
        <div>
            <div>İstekler</div>
            <div id="istek-container">
            <?php 
            while($takimCek=$takimSor->fetch(PDO::FETCH_ASSOC)){
                
                $takimSor2=$db->prepare("SELECT * FROM teams where team_id=:idd");
                $takimSor2->execute(array(
                    'idd'=>$takimCek['t_team']
                ));
                $takimCek2=$takimSor2->fetch(PDO::FETCH_ASSOC);
            
            ?>

                <a href="" class="istek-takim">
                    <div>
                        <img src="../<?php echo $takimCek2['team_foto']; ?>" alt="kadro">
                        <div><?php echo $takimCek2['team_namee'];?></div>
                        <div><?php echo $takimCek2['team_capacity'];?></div>
                    </div>

                    <div>
                        <button class="kabulButon" value="<?php echo $takimCek2['team_id']; ?>">Kabul et</button>
                        <button class="redButon" value="<?php echo $takimCek2['team_id']; ?>">Reddet</button>
                    </div>

                </a>
                <?php } ?>
            </div>
        </div>
                    
    
    </section>
    




    <script>
    $(".redButon").click(function(){
        $teamId=$(this).val();
        $userId=<?php echo $userCek['user_id'];?>;
        $.post("../post/post7TakimIstekSilme.php", { teamId: $teamId,userId:$userId});
        $(this).html ("Silindi");
    });
    </script>

    <script>
        $(".kabulButon").click(function(){
            $teamId=$(this).val();
            $userId=<?php echo $userCek['user_id'];?>;
            $.post("../post/post8TakimaKatil.php", { teamId: $teamId,userId:$userId});
            $(this).html ("Takıma Katıldınız");
        });
    </script>


</body>

    
</html>