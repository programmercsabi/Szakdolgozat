<style>
    ul li{
        margin: 10px 5px;
    }
    ul{
        margin: 10px 10px;
    }
    #adatok{
        display: inline-block;
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
                                               WHERE unev LIKE '$_SESSION[unev]'"));

?>
<h1 class="cim">Profil</h1>
<h2 class="alcim">Profilképmódosítás</h2>
<hr>
<div id="adatok">
    <h2 class="nev"><?=$user['unev']?></h2>
    <form action="profilkep_ir.php" method="post" enctype="multipart/form-data" target="kisablak">
        <input type="file" name="ukep"><br>
        <input type="password" name="upw" placeholder="Jelszó az ellenőrzéshez"><br>
        <input type="hidden" name="ustrid" value="<?=$user['ustrid']?>">
        <input type="submit" value='Képmódosítás'>
    </form>
    <img src="<?=$_SESSION["ukep"]?>">
</div>