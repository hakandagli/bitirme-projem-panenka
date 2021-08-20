<?php
include '../baglan.php';
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="../image/logo.png">
    <title>Takım Menüsü</title>
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="../css/navbar3.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/takimMenusu/hakan4.css">                          
    <link rel="stylesheet" media="(max-width:992px)" href="../css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="../css/takimMenusu/tablet3.css">
    <link rel="stylesheet" media="(max-width:576px)" href="../css/takimMenusu/mobile.css">
</head>
<body>
    
    <?php include '../header.php'?>
    
    <?php
        $kirli="'"."%".$userCek['user_id']."%"."'";
        $takimSor=$db->prepare("SELECT * FROM teams WHERE team_uye LIKE $kirli");
        $takimSor->execute();
    ?>
    
    <section id="ana-container">
        <div id="takim-container">
            <div id="takimlarim">takımlarım</div>
            
            <div id="takim-list">
            <?php while($takimCek=$takimSor->fetch(PDO::FETCH_ASSOC)){?>
                <a href="takimlar/?id=<?php echo $takimCek['team_id'];?>"class="takimlar">
                    <img src="../<?php echo $takimCek['team_foto'];?>" alt="">
                    <div class="altalta">
                        <div><?php echo $takimCek['team_namee']; ?></div>
                        <div>Oyuncu Sayısı:<?php echo $takimCek['team_capacity'];?></div>
                    </div>
                </a>

            <?php } ?>

            </div>

        </div>

        <div id="button-team">
            <a href="takimOlustur.php" id="teamButton">Takım Oluştur</a>
            <a href="takimbul.php" id="teamButton">Takim Bul</a>
            <a href="takimIstekler.php" id="teamButton">Takim Istekleri</a>
        </div>
    </section>
</body>
</html>