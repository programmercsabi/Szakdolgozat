<style>
    ul li{
        margin: 10px 5px;
    }
    ul{
        margin: 10px 10px;
    }
    #adatok{
        display: block;
        background-color: #DDD;
        border: 1px solid;
        border-radius: 15px;
        box-shadow: 2px 2px 2px #BBB;
        padding: 25px;
    }
    hr{
        margin: 20px -20px;
        
    }
    h2{
        margin-left: 25px;
    }
    input{
        margin: 5px 0px;
    }
    .nev{
        margin-left: 10px;
    }
</style>
<?php

if (!$belepve)
{
    die("<script>alert('Nem vagy bejelentkezve!')</script>");
}

$user = mysqli_fetch_array(mysqli_query($adb, "SELECT * FROM user



--*

WHERE unev LIKE '$_SESSION[unev]'"));

?>
<h1 class="cim">Profil</h1>
<h2 class="alcim">Adatmódosítás</h2>
<hr>
<div id="adatok">
    <h2 class="nev"><?=$user['unev']?></h2>
    <form action="adatmod_ir.php" method="post">
        <input type="text" name="unev" placeholder='Felhasználónév' value='<?=$user['unev']?>'><br>
        <input type="text" name="umail" placeholder='E-mail cím' value='<?=$user['umail']?>'><br>
        <input type="password" name="upw" placeholder="Jelszó az ellenőrzéshez"><br>
        <input type="hidden" name="strid" value='$user[ustrid]'>
        <input type="submit" value='Adatmódosítás'>
    </form>
</div>