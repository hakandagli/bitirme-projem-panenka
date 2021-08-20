<?php
    include '../baglan.php';
    $teamId=$_POST['teamId'];
    $userId=$_POST['userId'];
    $teamSil=$db->prepare("DELETE from takimlarim where t_user2=:userId AND t_team=:teamId");
    $siLL=$teamSil->execute(array(
    'teamId'=>$teamId,
    'userId'=>$userId
    ));

    if(isset($_POST['cikar'])){
        $teamSor=$db->prepare("SELECT * FROM teams where team_id=:idd");
        $teamSor->execute(array(
            'idd'=>$teamId
        ));
        $teamCek=$teamSor->fetch(PDO::FETCH_ASSOC);
        
        $metin=$teamCek['team_uye'];
        $ornekDizi = explode(",",$metin);
        $ornekDizi = array_values(array_diff($ornekDizi, array($userId)));

        $yeniUye=implode(",", $ornekDizi);
        
        //$teamCapacity=$teamCek['team_capacity'];

        $teamCapacity=$teamCek['team_capacity'];
        $teamCapacity--;

        $teamGuncelle=$db->prepare("UPDATE teams set
        team_uye=?,
        team_capacity=?
        where team_id=?
        ");

        $guncelle=$teamGuncelle->execute([
            $yeniUye, $teamCapacity,$teamId
        ]);
    }else{
        echo "1";
    }
?> 