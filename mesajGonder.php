<?php
include 'baglan.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="image/logo.png">
    <title>Mesaj Gönder</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/mesajGonder/main.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/mesajGonder/mobile.css">
</head>
<body>
<?php include 'header2.php'?>

    <section id="mesaj-container">
        <div id="mesajlar">
            <?php /*
                $mesajSor=$db->prepare("SELECT * from mesajlar where gonderici_id=:gonderici_id OR alici_id=:alici_id ");
                $mesajSor->execute(array(
                    'gonderici_id'=>$userCek['user_id'],
                    'alici_id'=>$userCek['user_id']));
            
                while($mesajCek=$mesajSor->fetch(PDO::FETCH_ASSOC)){
                    if($userCek['user_id']==$mesajCek['alici_id']){
                        echo '<div class="mesaj ">'.$mesajCek['mesaj_text'].'</div>';   
                    }else{
                        echo '<div class="mesaj gonderici">'.$mesajCek['mesaj_text'].'</div>';   
                    }
                }*/
            ?>
        </div>
    </section>

    <section id="mesaj-control">
        <textarea name="mesaj" id="mesaj" cols="30" rows="10"></textarea>
        <input type="text" id="alici_id" name="alici_id" value="<?php echo $_GET['id']?>" hidden>
        <input type="text" id="gonderici_id" name="gonderici_id" value="<?php echo $userCek['user_id']?>" hidden>
        <button id="gonder-button" onclick="mesajKayit()"><i class="fab fa-telegram-plane"></i></button>
    </section>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
</script>

    <script>
        function mesajKayit(){
            $mesaj= document.getElementById("mesaj").value;
            $gonderici_id=document.getElementById("gonderici_id").value;
            $alici_id=document.getElementById("alici_id").value;

            $.post("post/post9MesajGonder.php",{mesaj:$mesaj,gonderici_id:$gonderici_id,alici_id:$alici_id});
        };

        
        setInterval(
            function(){
                $("#mesajlar").load("post/post10MesajGuncelle.php?alici_id=<?php echo $_GET['id']?>&gonderici_id=<?php echo $userCek['user_id'];?>");
            },1500
        )
        
    </script>
</body>
</html>