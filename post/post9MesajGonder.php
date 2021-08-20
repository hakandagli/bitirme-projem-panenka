<?php
include '../baglan.php';

$kaydet=$db->prepare("INSERT into mesajlar set 
    gonderici_id=:gonderici_id,
    alici_id=:alici_id,
    mesaj_text=:mesaj_text
");

$insert=$kaydet->execute(array(
    'gonderici_id'=>$_POST['gonderici_id'],
    'alici_id'=>$_POST['alici_id'],
    'mesaj_text'=>$_POST['mesaj']
));
?>