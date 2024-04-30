<?php

    session_start();

    if(!isset($_POST['pw'])) { die("<script>alert('Nem írtál be jelszót!')</script>"); }

    if(!isset($_POST['user'])) { die("<script>alert('Nem írtál be felhasználónevet!')</script>"); }

    include("adbkapcsolat.php");
    
    $upw = md5($_POST['pw']);

    $user = mysqli_query($adb, "SELECT * FROM user
                                WHERE (unev = '$_POST[user]' OR umail = '$_POST[user]')
                                 AND upw = '$upw'
                                 ");

    if(mysqli_num_rows($user))
    {
        $sor = mysqli_fetch_array($user);

        $_SESSION['uid'] = $sor['uid'];
        $_SESSION['unev'] = $sor['unev'];
        $_SESSION['umail'] = $sor['umail'];
        $_SESSION['upw'] = $sor['upw'];

        mysqli_query($adb, "INSERT INTO login   (lid, luid,         ldatum, lip                     )
                            VALUES              ('', '$sor[uid]',   NOW(),  '$_SERVER[REMOTE_ADDR]' )
                        ");
                        //Beírás a login táblába

        $_SESSION['lid'] = mysqli_insert_id($adb);
        
        print("<script>
                parent.location.href='./?p=homepage'
               </script>");
    }
    else
    { 
        die("<script>alert('Hibás belépési adatok!')</script>");
    }

    mysqli_close($adb);
?>