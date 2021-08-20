<?php
include '../../baglan.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="../../css/all.css">
    <link rel="stylesheet" href="../../css/navbar3.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/takimlar/takimlar6.css">                          
    <link rel="stylesheet" media="(max-width:992px)" href="../../css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="../../css/takimlar/tablet2.css">
    <link rel="stylesheet" media="(max-width:576px)" href="../../css/takimlar/mobile.css">     
</head>

    
<body>

    <?php include '../../header3.php'; ?>
   
    <?php
        $takimSor=$db->prepare("SELECT * FROM teams where team_id=:idd");
        $takimSor->execute(array(
            'idd'=>$_GET['id']
        ));
        $takimCek=$takimSor->fetch(PDO::FETCH_ASSOC);
        if($takimCek['team_admin']==$userCek['user_id']){
            $adminButon=1;
        }else{
            $adminButon=0;
        }
        $basvurular=$takimCek['team_takimbul'];
    ?>

    <?php
        $adminSor=$db->prepare("SELECT * FROM users where user_id=:id");
        $adminSor->execute(array(
            'id'=>$takimCek['team_admin']
        ));
        $adminCek=$adminSor->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php
        $kirli2="'"."%".$userCek['user_id']."%"."'";
        $oyuncuSor=$db->prepare("SELECT * FROM  teams where team_id=:team_idd AND team_uye LIKE $kirli2");
        $oyuncuSor->execute(array(
            'team_idd'=>$_GET['id']
        ));
        $teamAidiyet=$oyuncuSor->rowCount();
    ?>

    <?php
        $teamAdmin = $userCek['user_team_capacity'];
    ?>

    <?php
    // SEHİR-İLÇE-MAHALLE VERİLERİ
    //SEHİR
    $adresSor1=$db->prepare("SELECT * from sehir where sehir_key=:sehir");
    $adresSor1->execute(array(
        'sehir'=>$takimCek['team_city']
    ));
    $adresCek1=$adresSor1->fetch(PDO::FETCH_ASSOC);
    
    //İLÇE
    $adresSor2=$db->prepare("SELECT * from ilce where ilce_key=:ilce");
    $adresSor2->execute(array(
        'ilce'=>$takimCek['team_county']
    ));
    $adresCek2=$adresSor2->fetch(PDO::FETCH_ASSOC);
    
    //MAHALLE
    $adresSor3=$db->prepare("SELECT * from mahalle where mahalle_key=:mahalle");
    $adresSor3->execute(array(
        'mahalle'=>$takimCek['team_village']
    ));
    $adresCek3=$adresSor3->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php
    //String Düzenlemeler
    $metin=$takimCek['team_day'];
                                /*$dizi2=explode(",",$metin);*/
    $metin=str_replace("1","Pazartesi",$metin);
    $metin=str_replace("2","Salı",$metin);
    $metin=str_replace("3","Çarşamba",$metin);
    $metin=str_replace("4","Perşembe",$metin);
    $metin=str_replace("5","Cuma",$metin);
    $metin=str_replace("6","Cumartesi",$metin);
    $metin=str_replace("7","Pazar",$metin);
    
    $metin2=$takimCek['team_rakipbul'];
    $metin2=str_replace("0","Kapalı",$metin2);
    $metin2=str_replace("1","Açık",$metin2);

    $metin3=$takimCek['team_takimbul'];
    $metin3=str_replace("0","Kapalı",$metin3);
    $metin3=str_replace("1","Açık",$metin3);
    ?>

    <?php
    $kirli="'"."%".$userCek['user_id']."%"."'";
    $takimOyuncuSor=$db->prepare("SELECT * FROM teams WHERE team_uye LIKE $kirli AND team_id=:teamId");
    $takimOyuncuSor->execute(array(
        'teamId'=>$_GET['id']
    ));

    $basvuruButon=$takimOyuncuSor->rowCount();
    ?>

<section id="ana-section">
        <div id="takim">
            <div id="takim-name"><?php echo $takimCek['team_namee'];?></div>
            <div><img src="../../<?php echo $takimCek['team_foto'];?>" alt=""></div>
            <div>
                <div>Oyuncu Sayısı:<?php echo $takimCek['team_capacity'];?></div>
                <div>Konum:<?php echo $adresCek1['sehir_title']." ".$adresCek2['ilce_title']." ".$adresCek3['mahalle_title']; ?></div>
                <div>Maç günleri: <?php echo $metin;?></div>
                <div>Rakip Bul'da görünürlük: <?php echo $metin2?></div>
                <div>Başvurular:<?php echo $metin3?></div>
                <div>Kurucu:<?php echo $adminCek['user_nickname'];?></div>
            </div>
        </div>

    
    

    <div id="takim-buttons">
        <a href="#" class="takimb <?php if($basvuruButon==1 || $takimCek['team_takimbul']==0) echo "displayNone";?>">Başvuru</a>
        <a href="" class="takimb <?php if($basvuruButon==1 || $teamAdmin==0 || $takimCek['team_rakipbul']==0) echo "displayNone";?>">Maç İsteği Gönder</a>
        <a href="uyeler.php?id=<?php echo $_GET['id'];?>" class="takimb <?php if($teamAidiyet==0) echo "displayNone";?>">Üyeler</a>
        <a href="arkadasDavet.php?id=<?php echo $_GET['id'];?>" class="takimb <?php if($teamAidiyet==0) echo "displayNone";?>">Arkaşlarını Davet et</a>
        <a href="#" class="takimb <?php if($teamAidiyet==0 || $adminButon==1) echo "displayNone";?>">Çıkış Yap</a>
        <a href="takimAyarlari.php?id=<?php echo $_GET['id'];?>" class="takimb <?php if($adminButon==0) echo "displayNone";?>"><i class="fas fa-cogs"></i></a>
    </div>

</section>

</body>
</html>