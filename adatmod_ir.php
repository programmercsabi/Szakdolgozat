<?php

    session_start();

    if($_POST['unev'] == "") { die("<script>alert('Nem írtál be felhasználónevet!')</script>"); }

    if($_POST['umail'] == "") { die("<script>alert('Nem írtál be e-mailt!')</script>"); }

    print("$_POST[unev] | $_POST[umail]");

    include("adbkapcsolat.php");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT unev FROM user WHERE BINARY unev = '$_POST[unev]'")))
        die("<script>alert('Ez a felhasználónév már foglalt!')</script>");

    if(mysqli_num_rows(mysqli_query($adb, "SELECT umail FROM user WHERE umail = '$_POST[umail]'")))
        die("<script>alert('Ezzel az e-mail címmel már regisztráltál!')</script>");

    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT upw FROM user WHERE ustrid='$_POST[ustrid]'"));

    if (md5($_POST['upw']) != $user['upw'])
        die("<script>alert('Hibás jelszó!')</script>");

    mysqli_query($adb, "UPDATE user SET unev = '$_SESSION[unev]', umail = '$_SESSION[umail]'
                        WHERE ustrid LIKE '$_POST[strid]'");
    
    mysqli_close($adb);

    print("<script>
                parent.location.href = './?p=profil'
           </script>")
?>