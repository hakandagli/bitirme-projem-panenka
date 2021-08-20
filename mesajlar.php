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
    <link rel="stylesheet" href="css/mesajlar/main.css">
</head>

<body>
    <?php include 'header2.php' ?>

    <section id="mesaj-container">

        <?php
        $mesajSor = $db->prepare("SELECT * from mesajlar where alici_id=:alici_id GROUP BY gonderici_id");
        $mesajSor->execute(array(
            'alici_id' => $userCek['user_id']
        ));

        while ($mesajCek = $mesajSor->fetch(PDO::FETCH_ASSOC)) {

            $mesajGonderenSor = $db->prepare("SELECT * from users where user_id=:user_id");
            $mesajGonderenSor->execute(array(
                'user_id' => $mesajCek['gonderici_id']
            ));

            $mesajGonderenCek = $mesajGonderenSor->fetch(PDO::FETCH_ASSOC);

        ?>

            <a href="mesajGonder.php?id=<?php echo $mesajGonderenCek['user_id'] ?>" class="mesaj">
                <img src="<?php echo $mesajGonderenCek['user_img']; ?>" alt="">
                <div class="mesaj-gonderen"><?php echo $mesajGonderenCek['user_nickname']; ?></div>
            </a>
        <?php } ?>

    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</body>

</html>