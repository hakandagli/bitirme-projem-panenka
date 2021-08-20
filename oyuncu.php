<?php
include 'baglan.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shorcut icon" href="./image/logo.png">
    <title>Oyuncu Sayfası</title>

    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/player/player6.css">
    <link rel="stylesheet" media="(max-width:992px)" href="css/player/tabletbuyuk5.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/player/tablet5.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/player/mobile2.css">


</head>

<body>

    <?php include 'header2.php'; ?>

    <?php
    $arkadasId = $userCek['user_id'] . "-" . $_GET['id'];
    $arkadasId2 = $_GET['id'] . "-" . $userCek['user_id'];
    $arkadaslikSor = $db->prepare("SELECT * FROM arkadaslar where arkadaslar_id=:arkadas OR arkadaslar_id=:arkadas2");
    $arkadaslikSor->execute(array(
        'arkadas' => $arkadasId,
        'arkadas2' => $arkadasId2
    ));
    $say = $arkadaslikSor->rowCount();
    $aCek = $arkadaslikSor->fetch(PDO::FETCH_ASSOC);
    if ($say == 0) {
        $gonderiDurum = 0;
    } else {
        $gonderiDurum = 1;
    }
    ?>

    <?php
    if ($gonderiDurum == 1) {
        if ($aCek['arkadas_user2_kabul'] == 1) {
            $arkadaslikDurum = 1;
            $gonderiDurum = 0;
        }
    }
    ?>

    <?php
    $aadmin = $userCek['user_id'];
    $team_uye = "'" . "%" . $_GET['id'] . "%" . "'";
    $adminSor = $db->prepare("SELECT * FROM teams where team_admin=:adminn AND team_uye NOT LIKE $team_uye");
    $adminSor->execute(array(
        'adminn' => $aadmin
    ));

    $say3 = $adminSor->rowCount();
    if ($say3 == 0) {
        $takimloa = 0;
    } else {
        $takimloa = 1;
    }
    ?>

    <?php
    $kirli = "'" . "%" . $_GET['id'] . "%" . "'";
    $teamSor = $db->prepare("SELECT * FROM teams WHERE team_uye LIKE $kirli");
    $teamSor->execute();
    $say56 = $teamSor->rowCount();
    ?>
    <section id="ana-section">
        <div id="barismanco">
            <div id="arkadas-container">
                <div>
                    <div>Arkadaşlar</div>
                </div>
                
                <div id="arkadas-list">
                    <?php
                    $bir = 1;
                    $istekSor2 = $db->prepare("SELECT * FROM arkadaslar where arkadas_user2_kabul=:bir AND (arkadaslar_user2=:idd OR arkadaslar_user1=:idd)");
                    $istekSor2->execute(array(
                        'idd' => $_GET['id'],
                        'bir' => $bir
                    ));

                    $say5 = $istekSor2->rowCount();

                    while ($istekCek2 = $istekSor2->fetch(PDO::FETCH_ASSOC)) {
                        $goz = $istekCek2['arkadaslar_user1'];
                        if ($istekCek2['arkadaslar_user1'] == $_GET['id']) {
                            $goz = $istekCek2['arkadaslar_user2'];
                        }

                        $istekSor3 = $db->prepare("SELECT * FROM users where user_id=:idd");
                        $istekSor3->execute(array(
                            'idd' => $goz
                        ));

                        $kuzey = 0;
                        while ($istekCek3 = $istekSor3->fetch(PDO::FETCH_ASSOC)) { ?>
                            <a href="" class="arkadas">
                                <div><img src="<?php echo $istekCek3['user_img']; ?>" alt=""></div>
                                <div class="arkadas-nick"><?php echo $istekCek3['user_nickname']; ?></div>
                            </a>
                    <?php }} ?>
                </div>
            </div>

            <div id="takim-container">
                <div>
                    <div>Takımlar</div>
                </div>
                <div id="takim-list">
                    <?php while ($teamCek = $teamSor->fetch(PDO::FETCH_ASSOC)) { ?>
                        <a href="" class="takim">
                            <div><img src="<?php echo $teamCek['team_foto']; ?>" alt="2"></div>
                            <div><?php echo $teamCek['team_namee']; ?></div>
                        </a>
                    <?php } ?>
                </div>

            </div>
        </div>

        <?php
        $playerSor = $db->prepare("SELECT * FROM users where user_id=:player_id");
        $playerSor->execute(array(
            'player_id' => $_GET['id']
        ));
        $playerCek = $playerSor->fetch(PDO::FETCH_ASSOC);
        ?>

        <div id="user-container">
            <div id="kisim1">
                <div>
                    <img src="image/userFoto/futbolcu.png" alt="">
                </div>
                <div id="bilgiler">
                    <div>Kullanici adi: <?php echo $playerCek['user_nickname']; ?></div>
                    <div>ad soyad: <?php echo $playerCek['user_namee']; ?> <?php echo $playerCek['user_surname']; ?></div>
                    <div>mevkiler:
                        <?php
                        $metin = $playerCek['user_position'];
                        /*$dizi2=explode(",",$metin);*/
                        $metin = str_replace("1", "Forvet", $metin);
                        $metin = str_replace("2", "Orta", $metin);
                        $metin = str_replace("3", "Defans", $metin);
                        $metin = str_replace("4", "Kaleci", $metin);
                        echo $metin;
                        ?>
                    </div>
                    <div>
                        Konum:
                        <div id="konum">
                            <?php
                            $pSehirSor = $db->prepare("SELECT* FROM sehir where sehir_key=:sehir_key");
                            $pSehirSor->execute(array(
                                'sehir_key' => $playerCek['user_city']
                            ));

                            $pSehirCek = $pSehirSor->fetch(PDO::FETCH_ASSOC);
                            echo $pSehirCek['sehir_title'];
                            echo " ";
                            //
                            //ucwords($metin)

                            $pIlceSor = $db->prepare("SELECT* FROM ilce where ilce_key=:ilce_key");
                            $pIlceSor->execute(array(
                                'ilce_key' => $playerCek['user_county']
                            ));

                            $pIlceCek = $pIlceSor->fetch(PDO::FETCH_ASSOC);
                            echo $pIlceCek['ilce_title'];
                            echo " ";

                            $pMahalleSor = $db->prepare("SELECT* FROM mahalle where mahalle_key=:mahalle_key");
                            $pMahalleSor->execute(array(
                                'mahalle_key' => $playerCek['user_village']
                            ));

                            $pMahalleCek = $pMahalleSor->fetch(PDO::FETCH_ASSOC);
                            echo $pMahalleCek['mahalle_title'];

                            ?>
                        </div>
                    </div>
                 
                </div>
            </div>

            <div id="kisim2">
                <div></div>
            </div>

            <div id="kisim3">
                <a href="mesajGonder.php?id=<?php echo $_GET['id'] ?>" class="ilet" id="h1">Mesaj Gönder</a>

                <button class="ilet <?php if ($arkadaslikDurum == 1) {
                                        echo "displayNone";
                                    }
                                    ?>" id="h8">
                    <?php
                    if ($gonderiDurum == 0) {
                        echo "Arkadaş Ekle";
                    } else {
                        echo "İstek Gönderildi - İptal Et";
                    }
                    ?>
                </button>

                <button class="ilet <?php if ($arkadaslikDurum == 0) {
                                        echo "displayNone";
                                    } ?>" id="g1">
                    Arkadaşlarımdan Çıkar
                </button>

                <button class="ilet 
                    <?php
                    if ($userCek['user_team_capacity'] == 0) {
                        echo "displayNone";
                    }
                    /*if($takimloa!=1){
                            echo "displayNone";
                        } */
                    ?>" id="h9">Takıma Davet et</button>

            </div>

            <div id="takims" class="displayNone">
                <ul>
                    <?php while ($adminCek = $adminSor->fetch(PDO::FETCH_ASSOC)) { ?>

                        <?php
                        $teamPlayer = $_GET['id'];
                        $takimlarimSor = $db->prepare("SELECT * FROM takimlarim where t_user2=:teamPlayer AND t_team=:tt_team");
                        $takimlarimSor->execute(array(
                            'teamPlayer' => $teamPlayer,
                            'tt_team' => $adminCek['team_id']
                        ));
                        $say = $takimlarimSor->rowCount();
                        if ($say == 0) {
                            $teamDurum = 0;
                        } else {
                            $teamDurum = 1;
                        }
                        $takimlarimCek = $takimlarimSor->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <li>
                            <button class="teams-button" value="<?php echo $adminCek['team_id']; ?>">
                                <?php
                                if ($teamDurum == 1) {
                                    echo $adminCek['team_namee'] . " Takımına Davet Edildi";
                                } else {
                                    echo $adminCek['team_namee'];
                                }
                                ?>
                            </button>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        var gonderiDurum = <?php echo $gonderiDurum; ?>;
        $('#h8').click(function() {
            if (gonderiDurum == 0) {
                $user1 = <?php echo $userCek['user_id'] ?>;
                $user2 = <?php echo $_GET['id'] ?>;
                $.post("post/post3-ArkadasEkle.php", {
                    user1: $user1,
                    user2: $user2
                });
                $("#h8").html("İstek Gönderildi - İptal Et");
                gonderiDurum = 1;

            } else {
                $user1 = <?php echo $userCek['user_id'] ?>;
                $user2 = <?php echo $_GET['id'] ?>;
                $.post("post/post4IstekSilme.php", {
                    user1: $user1,
                    user2: $user2
                });
                $("#h8").html("Arkadaş Ekle");
                gonderiDurum = 0;
            }
        });
    </script>

    <script>
        $('#h9').click(function() {
            $('#takims').toggleClass("displayNone");
            return false;
        });
    </script>

    <script>
        $(".teams-button").click(function() {
            $tuser1 = <?php echo $userCek['user_id']; ?>;
            $tuser2 = <?php echo $playerCek['user_id']; ?>;
            $team1 = $(this).val();
            $(this).html("Davet Gönderildi");
            $.post("post/post5TakimaEkleme.php", {
                tuser1: $tuser1,
                tuser2: $tuser2,
                team1: $team1
            });
        });
    </script>

    <script>
        $("#g1").click(function() {
            $user1 = <?php echo $userCek['user_id'] ?>;
            $user2 = <?php echo $_GET['id'] ?>;
            $.post("post/post4IstekSilme.php", {
                user1: $user1,
                user2: $user2
            });
            $('#g1').toggleClass("displayNone");
            $('#h8').toggleClass("displayNone");
        });
    </script>
</body>

</html>