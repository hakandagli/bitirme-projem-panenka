
<?php
    //Oturum Kodları
    $userSor=$db->prepare("SELECT * FROM users where user_nickname=:nickname");
    $userSor->execute(array(
        'nickname'=>$_SESSION['user_nickname']
    ));
    $say=$userSor->rowCount();
    $userCek=$userSor->fetch(PDO::FETCH_ASSOC);
    if($say==0){
        Header("Location:index.php?durum=izinsiz");
        exit;
    }
?>
<header>
        <nav>
            <div id="nav-container-1">
                <div class="telefon" id="navi"><button id="nav-icon"><i class="fas fa-align-justify"></i></button></div>
                <div class="telefon display-none" id="navi2"><button id="nav-icon2"><i class="fas fa-times"></i></button></div>
                <div id="baslik"><a href="../../userpanel.php">panenka</a></div>
                <div class="telefon">
                    <a href="" class="yan-yana">
                        <div><i class="fas fa-envelope"></i></div>
                        <div><i class="fas fa-exclamation alert"></i></div>
                    </a>
                </div>
            </div>
           
            <div id="nav-container-2" class="display-none">
                <div >
                    <a href="../../takimMenusu" class="nav-item">
                        <div>
                            <i class="fas fa-trophy"></i> Takım Menüsü
                        </div>
                        <div>
                            
                        </div>
                    </a>
                </div>
                
                <div>
                    <a  class="nav-item"><i class="fas fa-user"></i> <?php echo $userCek['user_nickname'];?></a>
                </div>
                
                <div >
                    <a href="../../arkadaslar.php" class="nav-item">
                        <div><i class="fas fa-users"></i>Arkadaşlar</div>
                        <div></div>
                    </a>    
                </div>
                
                <div class="masaustu">
                    <a href="" class="nav-item">
                        <div><i class="fas fa-envelope"></i></div>
                        <div></div>
                    </a>
                </div>
                
                <div >
                    <a href="../../logout.php" class="nav-item"><i class="fas fa-sign-out-alt"></i> Çıkış yap</a>
                </div>
                
            </div>
        </nav>
</header>

<script
        src="https://code.jquery.com/jquery-3.3.1.min.js">
</script>

    <script>
	    $('#nav-icon').click(function(){			
			$('#nav-container-2').toggleClass("display-none");
            $('#navi2').toggleClass("display-none");
            $('#navi').toggleClass("display-none");
			return false;
		});
    </script>

    <script>
    $('#nav-icon2').click(function(){			
        $('#nav-container-2').toggleClass("display-none");
        $('#navi2').toggleClass("display-none");
        $('#navi').toggleClass("display-none");
        return false;
    });
</script>