<?php
    include '../baglan.php';
    $bir=1;
    $userId=$_POST['userId'];
    $teamId=$_POST['teamId'];

    //Takım Kısmı
    $takimSor=$db->prepare("SELECT * FROM teams where team_id=:teamId");
    $takimSor->execute(array(
        'teamId'=>$_POST['teamId']
    ));
    $takimCek=$takimSor->fetch(PDO::FETCH_ASSOC);
    
    $yeniKullanici=$takimCek['team_uye'].",".$userId;
    $teamCapacity=$takimCek['team_capacity'];
    $teamCapacity++;

    $teamGuncelle=$db->prepare("UPDATE teams set
        team_uye=?,
        team_capacity=?
        where team_id=?
    ");

    $guncelle=$teamGuncelle->execute([
        $yeniKullanici, $teamCapacity,$teamId
    ]);

    //İstek Kısmı
    
    /*$istekSor=$db->prepare("SELECT * FROM takimlarim where t_user2=:userId");
    $istekSor->execute(array(
        'userId'=>$userId
    ));*/

    $istekGuncelle=$db->prepare("UPDATE takimlarim set
    t_user2_kabul=?
    where t_user2=? AND t_team=?
    ");

    $guncelle2=$istekGuncelle->execute([
        $bir, $userId, $teamId
    ]);
?> 