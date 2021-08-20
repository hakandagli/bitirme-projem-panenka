<?php
    include '../baglan.php';
    $arkadasId=$_POST['fuser1']."-".$_POST['fuser2'];
    $bir=1;

    $arkadasEkle=$db->prepare("UPDATE arkadaslar set
        arkadas_user2_kabul=?
        where arkadaslar_id=?
    ");

    $guncelle=$arkadasEkle->execute([
        $bir, $arkadasId
    ]);
?> 