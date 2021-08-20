<?php
include '../baglan.php';

$mahalleSor=$db->prepare("SELECT * from mahalle where mahalle_ilcekey=:ilce");
$mahalleSor->execute(array(
    'ilce'=>$_POST['ilce']
));
echo '<option value="'.'0'.'">'.'Mahalle seciniz'.'</option>';
while($mahalleCek=$mahalleSor->fetch(PDO::FETCH_ASSOC)){
    echo '<option value="'.$mahalleCek["mahalle_key"].'">'.$mahalleCek['mahalle_title'].'</option>';
}


?>
