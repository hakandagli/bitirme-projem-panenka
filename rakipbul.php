<?php
include 'baglan.php';
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rakip Bul</title>
    <link rel="shorcut icon" href="./image/logo.png">
    <!--Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/navbar3.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/rakipbul/rakipbul3.css">                          
    <link rel="stylesheet" media="(max-width:992px)" href="css/tabletbuyuk.css">
    <link rel="stylesheet" media="(max-width:768px)" href="css/rakipbul/tablet2.css">
    <link rel="stylesheet" media="(max-width:576px)" href="css/sahabul/mobile.css"> 
</head>
<body>

<?php include 'header2.php'?>
<section id="ana-section">
    <div id="form-container">
        <form action="" method="GET">
            <div id="bolgeler" class="mgb-1">
                <div class="bolge-item">
                    <select name="team_city" id="iller" class="sehir-item" required>
                        <option value="">İl seciniz</option>
                        <?php
                            $sehirSor=$db->prepare("SELECT * from sehir");
                            $sehirSor->execute();
                            while($sehirCek=$sehirSor->fetch(PDO::FETCH_ASSOC)){ ?>
                            <option value="<?php echo $sehirCek['sehir_key']?>"><?php echo $sehirCek['sehir_title']?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="bolge-item">
                    <select name="team_county" id="ilceler" class="sehir-item" required>
                        <option value="0">İlçe Seçiniz</option>
                    </select>
                </div class="bolge-item">      
            
                <div class="bolge-item">
                    <select name="team_village" id="mahalleler" class="sehir-item" required>
                        <option value="0">Mahalle Seçiniz</option>
                    </select>
                </div>
            
            </div>

            <div>
                <div class="colorw">Maç yapmak istediğiniz gün</div>
                <div class="days"><input type="radio" name="team_day" value="1">Pazartesi</div>
                <div class="days"><input type="radio" name="team_day" value="2">Salı</div>
                <div class="days"><input type="radio" name="team_day" value="3">Çarşamba</div>
                <div class="days"><input type="radio" name="team_day" value="4">Perşembe</div>
                <div class="days"><input type="radio" name="team_day" value="5">Cuma</div>
                <div class="days"><input type="radio" name="team_day" value="6">Cumartesi</div>
                <div class="days"><input type="radio" name="team_day" value="7">Pazar</div>
            </div>

            <div>
                <button type="submit" name="saha_ara" id="arama">Ara</button>
            </div>
        
        
        </form>
    </div>

    <div id="teams">

    <?php
        if(isset($_GET['saha_ara'])){
            $select = array();
    
            if($_GET['team_village']!=0){
                $select[]="AND team_village=".$_GET['team_village'];
            }

            if($_GET['team_day']!=NULL){
                $ogunbugun="'"."%".$_GET['team_day']."%"."'";
                $select[]="AND team_day LIKE ".$ogunbugun;
            }
            
            if(count($select)>0){
                $hakanss=implode($select," ");
            }

            $rakipSor=$db->prepare("SELECT * FROM teams where team_city=:team_city AND team_county=:team_county AND team_rakipbul='1' $hakanss");
            $rakipSor->execute(array(
                'team_city'=>$_GET['team_city'],
                'team_county'=>$_GET['team_county']
            ));
    ?>                            
        <?php while($rakipCek=$rakipSor->fetch(PDO::FETCH_ASSOC)){?>    
        <div class="team">
            <a href="takimMenusu/takimlar?id=<?php echo $rakipCek['team_id']?>" >
                <div><img src="<?php echo $rakipCek['team_foto'] ?>" alt=""></div>
                <div><?php echo $rakipCek['team_namee'] ?></div>
                       
            </a>
        </div>
        <?php }} ?>  
    </div>
</section>

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
    </script>
    
    <script>
	    $('#nav-icon').click(function(){			
			$('#nav-container-2').toggleClass("display-none");
			return false;
		});
    </script>

    <!--SEHİR SECME-->
    <script>
        $(document).ready(function(){
            $('#iller').change(function(){
                $('#ilceler').empty();
                var deger=$(this).val();
                $.post("post/post1-ilce-cek.php",{il:deger},function(a){
                    $('#ilceler').append(a);
                })
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#ilceler').change(function(){
                $('#mahalleler').empty();
                var deger=$(this).val();
                $.post("post/post2-mahalle-cek.php",{ilce:deger},function(a){
                    $('#mahalleler').append(a);
                })
            });
        });
    </script>    
</body>
</html>