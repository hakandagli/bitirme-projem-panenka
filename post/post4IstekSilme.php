<?php
    include '../baglan.php';
    $arkadasId=$_POST['user1']."-".$_POST['user2'];
    $arkadasId2=$_POST['user2']."-".$_POST['user1'];
    $arkadaslikSil=$db->prepare("DELETE from arkadaslar where arkadaslar_id=:id OR arkadaslar_id=:id2");
    $siLL=$arkadaslikSil->execute(array(
        'id'=>$arkadasId,
        'id2'=>$arkadasId2
    ));
?> 