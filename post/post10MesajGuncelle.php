<?php
    include '../baglan.php';

    $mesajSor=$db->prepare("SELECT * from mesajlar where (gonderici_id=:gonderici_id AND alici_id=:alici_id) OR (gonderici_id=:alici_id AND alici_id=:gonderici_id)");
    $mesajSor->execute(array(
        'gonderici_id'=>$_GET['gonderici_id'],
        'alici_id'=>$_GET['alici_id']
    ));

    while($mesajCek=$mesajSor->fetch(PDO::FETCH_ASSOC)){
        if($mesajCek['gonderici_id']==$_GET['gonderici_id']){
            echo '<div class="mesaj gonderici">'.$mesajCek['mesaj_text'].'</div>';
        }else{
            echo '<div class="mesaj">'.$mesajCek['mesaj_text'].'</div>';
        }
    }

    
?>