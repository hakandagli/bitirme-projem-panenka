<?php
    include '../baglan.php';
                    $yolla=1;
                    $arkadasId=$_POST['user1']."-".$_POST['user2'];
                    $user1=$_POST['user1'];
                    $user2=$_POST['user2'];

                    $arkadasEkle=$db->prepare("INSERT into arkadaslar set 
                        arkadaslar_id=:arkadaslar_id,
                        arkadaslar_user1=:arkadaslar_user1,
                        arkadaslar_user2=:arkadaslar_user2,
                        arkadas_user1_yolla=:arkadas_user1_yolla
                    ");
                    $insert=$arkadasEkle->execute(array(
                        'arkadaslar_id'=>$arkadasId,
                        'arkadaslar_user1'=>$user1,
                        'arkadaslar_user2'=>$user2,
                        'arkadas_user1_yolla'=>$yolla
                    ));
?> 