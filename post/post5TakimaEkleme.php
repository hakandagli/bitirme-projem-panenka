<?php
    include '../baglan.php';
                    $yolla=1;
                    $t_id=$_POST['team1']."-".$_POST['tuser1']."-".$_POST['tuser2'];
                    $tuser1=$_POST['tuser1'];
                    $tuser2=$_POST['tuser2'];
                    $team1=$_POST['team1'];

                    $takimlarimEkle=$db->prepare("INSERT into takimlarim set 
                        t_id=:t_id,
                        t_user1=:t_user1,
                        t_user2=:t_user2,
                        t_team=:t_team,
                        t_user1_yolla=:t_user1_yolla
                    ");
                    $insert=$takimlarimEkle->execute(array(
                        't_id'=>$t_id,
                        't_user1'=>$tuser1,
                        't_user2'=>$tuser2,
                        't_team'=>$team1,
                        't_user1_yolla'=>$yolla
                    ));
?> 