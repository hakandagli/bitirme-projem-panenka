<?php 
include 'baglan.php';
session_start();
ob_start();

/*KULLANICI KAYIT İŞLEMLERİ */
if(isset($_POST['kayitislemi'])){
    
    //Kullanıcı daha önce kayıt olmuş mu ?
    $playerSor=$db->prepare("SELECT * FROM users where user_nickname=:namee OR user_email=:maill");
    $playerSor->execute(array(
        'namee'=>$_POST['user_nickname'],
        'maill'=>$_POST['user_email']
    ));

    $say384=$playerSor->rowCount();
    if($say384==0){
        $user_img="image/userFoto/futbolcu.png";
        $kaydet=$db->prepare("INSERT into users set 
        user_namee=:user_namee,
        user_surname=:user_surname,
        user_nickname=:user_nickname,
        user_email=:user_email,
        user_password=:user_password,
        user_day=:user_day,
        user_month=:user_month,
        user_year=:user_year,
        user_city=:user_city,
        user_county=:user_county,
        user_village=:user_village,
        user_position=:user_position,
        user_img=:user_img
    ");
    
    $position=$_POST['user_position'];
    $positions=implode($position,",");
    
    $insert=$kaydet->execute(array(
        'user_namee'=>$_POST['user_namee'],
        'user_surname'=>$_POST['user_surname'],
        'user_nickname'=>$_POST['user_nickname'],
        'user_email'=>$_POST['user_email'],
        'user_password'=>md5($_POST['user_password']),
        'user_day'=>$_POST['user_day'],
        'user_month'=>$_POST['user_month'],
        'user_year'=>$_POST['user_year'],
        'user_city'=>$_POST['user_city'],
        'user_county'=>$_POST['user_county'],
        'user_village'=>$_POST['user_village'],
        'user_img'=>$user_img,
        'user_position'=>$positions
    ));
        if($insert){
            $_SESSION['user_nickname']=$_POST['user_nickname'];
            header("Location:userpanel.php");
            exit;
        }else{
            header("Location:kayit.php?durum=no");
            exit;
        }
    }else{
        header("Location:kayit.php?kayit=1");
        exit;
    }
    
}

//TESİS KAYIT İŞLEMLERİ
if(isset($_POST['tesis_kayit'])){
    $tesis_kod=333;
    if($_POST['kod']==$tesis_kod){
        
        $kaydet=$db->prepare("INSERT into tesisler set 
        tesis_ad=:tesis_ad,
        tesis_sahibi_ad=:tesis_sahibi_ad,
        tesis_sahibi_soyad=:tesis_sahibi_soyad,
        tesis_mail=:tesis_mail,
        tesis_tel=:tesis_tel,
        tesis_sifre=:tesis_sifre,
        tesis_city=:tesis_city,
        tesis_county=:tesis_county,
        tesis_village=:tesis_village,
        tesis_durum=:tesis_durum,
        tesis_sayisi=:tesis_sayisi,
        tesis_adres=:tesis_adres,
        tesis_servis=:tesis_servis
        ");

        $durum=$_POST['tesis_durum'];
        $tesis_durum=implode($durum,",");

        $insert=$kaydet->execute(array(
            'tesis_ad'=>$_POST['tesis_ad'],
            'tesis_sahibi_ad'=>$_POST['tesis_sahibi_ad'],
            'tesis_sahibi_soyad'=>$_POST['tesis_sahibi_soyad'],
            'tesis_mail'=>$_POST['tesis_mail'],
            'tesis_tel'=>$_POST['tesis_tel'],
            'tesis_sifre'=>md5($_POST['tesis_sifre']),
            'tesis_city'=>$_POST['tesis_city'],
            'tesis_county'=>$_POST['tesis_county'],
            'tesis_village'=>$_POST['tesis_village'],
            'tesis_durum'=>$tesis_durum,
            'tesis_sayisi'=>$_POST['tesis_sayisi'],
            'tesis_adres'=>$_POST['tesis_adres'],
            'tesis_servis'=>$_POST['tesis_servis']
        ));

        if($insert){
            header("Location:userpanel.php");
            exit;
        }else{
            header("Location:kayit.php?durum=no");
            exit;
        }
    }else{
        header("Location:kayit.php?durum=no2");
    }
}

//TEAM KAYIT İŞLEMLERİ
if(isset($_POST['teamCreate'])){
    if(isset($_POST['team_day'])){
        $tday=$_POST['team_day'];
        $tdays=implode($tday,",");
    }
    
    $user_id=$_POST['user_id'];
    $gelen_user_team_capacity=$_POST['user_team_capacity'];

    $dizin="image/teamFoto/";
    $geciciAd=$_FILES["team_foto"]["tmp_name"];

    $bul=$_FILES["team_foto"]["name"];
    $bulunacak = array('ç','Ç','ı','İ','ğ','Ğ','ü','ö','Ş','ş','Ö','Ü',',',' ','(',')','[',']'); 
    $degistir  = array('c','C','i','I','g','G','u','o','S','s','O','U','','-','','','',''); 
    $sonuc=str_replace($bulunacak, $degistir, $bul); 

    $_FILES["team_foto"]["name"];

    $orjinAd=str_replace("","",$orjinAd);
    $yeniAd=$dizin."user".$user_id."teamfoto".$gelen_user_team_capacity.$sonuc;

    if(move_uploaded_file($geciciAd,$yeniAd)){
        echo"resim yüklendi";
    }
    //Güncelleme KISMI
    $gelen_user_team_capacity++;
    $kaydet=$db->prepare("UPDATE users set
        user_team_capacity=:user_team_capacity
        where user_id={$_POST['user_id']}
    ");
    
    $insert=$kaydet->execute(array(
        'user_team_capacity'=>$gelen_user_team_capacity
    ));
    //Güncelleme sonu

    $team_capacity=1;

    $kaydet=$db->prepare("INSERT into teams set 
        team_namee=:team_namee,
        team_city=:team_city,
        team_county=:team_county,
        team_village=:team_village,
        team_admin=:team_admin,
        team_foto=:team_foto,
        team_day=:team_day,
        team_rakipbul=:team_rakipbul,
        team_takimbul=:team_takimbul,
        team_uye=:team_uye,
        team_capacity=:team_capacity
    ");

    $insert=$kaydet->execute(array(
    'team_namee'=>$_POST['team_namee'],
    'team_city'=>$_POST['team_city'],
    'team_county'=>$_POST['team_county'],
    'team_village'=>$_POST['team_village'],
    'team_admin'=>$_POST['user_id'],
    "team_foto"=>$yeniAd,
    "team_day"=>$tdays,
    "team_rakipbul"=>$_POST['team_rakipbul'],
    "team_takimbul"=>$_POST['team_takimbul'],
    "team_uye"=>$_POST['user_id'],
    "team_capacity"=>$team_capacity
    ));

    if($insert){
        header("Location:takimMenusu");
        exit;
    }else{
        header("Location:userpanel.php?durum=no");
        exit;
    }
}

/*Team Güncelleme */
if(isset($_POST['teamUpdate'])){
    $team_id=$_POST['team_id'];
    $teamSor2=$db->prepare("SELECT * FROM teams where team_id=:idd");
    $teamSor2->execute(array(
        'idd'=>$_POST['team_id']
    ));
    $teamCek2=$teamSor2->fetch(PDO::FETCH_ASSOC);
    
    if(isset($_POST['team_namee'])){
        $team_name=$_POST['team_namee'];
    }else{
        $team_name=$teamCek2['team_namee'];
    }

    if(isset($_POST['team_rakipbul'])){
        $team_rakipbul=$_POST['team_rakipbul'];
    }else{
        $team_rakipbul=$teamCek2['team_rakipbul'];
    }

    if(isset($_POST['team_takimbul'])){
        $team_takimbul=$_POST['team_takimbul'];
    }else{
        $team_takimbul=$teamCek2['team_takimbul'];
    }

    if(isset($_POST['team_day'])){
        $teamday=$_POST['team_day'];
        $team_day=implode($teamday,",");
    }else{
        $team_day=$teamCek2['team_day'];
    }

    $sifir=0;
    if($_POST['team_city']==$sifir){
        $team_city=$teamCek2['team_city'];
        $team_county=$teamCek2['team_county'];
        $team_village=$teamCek2['team_village'];
    }else{
        $team_city=$_POST['team_city'];
        $team_county=$_POST['team_county'];
        $team_village=$_POST['team_village'];
    }

   if (!file_exists($_FILES['team_foto']['tmp_name']) || !is_uploaded_file($_FILES['team_foto']['tmp_name'])){
        $team_foto=$teamCek2['team_foto'];
   }
   else{
        $user_id=$_POST['user_id'];
        $team_id=$_POST['team_id'];
        $dizin="image/teamFoto/";
        $geciciAd=$_FILES["team_foto"]["tmp_name"];

        $bul=$_FILES["team_foto"]["name"];
        $bulunacak = array('ç','Ç','ı','İ','ğ','Ğ','ü','ö','Ş','ş','Ö','Ü',',',' ','(',')','[',']'); 
        $degistir  = array('c','C','i','I','g','G','u','o','S','s','O','U','','-','','','',''); 
        $sonuc=str_replace($bulunacak, $degistir, $bul); 

        $_FILES["team_foto"]["name"];
        $orjinAd=str_replace("","",$orjinAd);
        $yeniAd=$dizin."user".$user_id."teamfoto".$team_id.$sonuc;
    
        if(move_uploaded_file($geciciAd,$yeniAd)){
            echo "resim yüklendi";
        }
        $team_foto=$yeniAd;
    }

    $kaydet2=$db->prepare("UPDATE teams set
        team_namee=:team_namee,
        team_rakipbul=:team_rakipbul,
        team_takimbul=:team_takimbul,
        team_day=:team_day,
        team_city=:team_city,
        team_county=:team_county,
        team_village=:team_village,
        team_foto=:team_foto
        where team_id={$_POST['team_id']}
    ");

    $insert2=$kaydet2->execute(array(
        'team_namee'=>$team_name,
        'team_rakipbul'=>$team_rakipbul,
        'team_takimbul'=>$team_takimbul,
        'team_day'=>$team_day,
        'team_city'=>$team_city,
        'team_county'=>$team_county,
        'team_village'=>$team_village,
        'team_foto'=>$team_foto
    ));

    if($insert2){
        Header("Location:takimlar.php?id=$team_id&durum=ok");
        exit;
    }else{
        Header("Location:takimlar.php?id=$team_id&durum=no");
        exit;
    }
}

/*GİRİŞ İŞLEMLERİ*/
if(isset($_POST['girisYap'])){
    $user_nickname=$_POST['user_nickname'];
    $user_password=md5($_POST['user_password']);

    $userSor=$db->prepare("SELECT * FROM users where user_nickname=:nickname and user_password=:parola");
    $userSor->execute(array(
        'nickname'=>$user_nickname,
        'parola'=>$user_password
    ));

    $say=$userSor->rowCount();
    if($say==1){
        $_SESSION['user_nickname']=$user_nickname;
        header("Location:userpanel.php");
        exit;
    }else{
        header("Location:index.php?durum=no");
        exit;
    }
 }
?>