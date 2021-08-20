<?php
    include '../baglan.php';
    $ilceSor=$db->prepare("SELECT * from ilce where ilce_sehirkey=:il");
    $ilceSor->execute(array(
        'il'=>$_POST['il']
    ));
    while($ilceCek=$ilceSor->fetch(PDO::FETCH_ASSOC)){
        echo '<option value="'.$ilceCek["ilce_key"].'">'.$ilceCek['ilce_title'].'</option>';
    }
?>