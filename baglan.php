<?php

try{
    $db=new PDO("mysql:host=localhost;dbname=halisaha;charset=utf8",'root','feardede1');
    //echo "veritabanı bağlantısı başarılı";
}catch(PDOExpception $e){
    echo $e->getMessage();
}
?>