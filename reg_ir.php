<?php

    session_start();
    include("adbkapcsolat.php");

    if(!isset($_POST['upw'])) { die("<script>alert('Nem írtál be jelszót!')</script>"); }

    if($_POST['pwc'] != $_POST['upw']) { die("<script>alert('Nem egyezik a két jelszó!')</script>"); }

   

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE unev='$_POST[unev]'")))
        die("<script>alert('Ez a felhasználónév már foglalt!')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT * FROM user WHERE umail='$_POST[umail]'")))
        die("<script>alert('Ezzel az e-mail címmel már regisztráltál!')</script>");

    $upw = md5($_POST['upw']);

    mysqli_query ($adb, "INSERT INTO user (uid,           unev,          umail,           upw,             udatum,  uip,             ustatusz) 
                               VALUES (NULL, '$_POST[unev]', '$_POST[umail]', '$upw', NOW(),'$_SERVER[REMOTE_ADDR]',  'A');
                               ");



    mysqli_close($adb);

    print("
        <script>
            alert('Köszönjük regszitrációdat.')
            parent.location.href = './?p=login'
        </script>
    ")
?>