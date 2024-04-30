<?php
session_start();
include("adbkapcsolat.php");
if(isset($_SESSION['uid']))
{
    $belepve = 1;
    mysqli_query($adb, "INSERT INTO naplo (NURL, NDatum, NIP, NLID)
                                VALUES('$_SERVER[REQUEST_URI]', NOW(), '$_SERVER[REMOTE_ADDR]', '$_SESSION[lid]')");
}
else
{
    $belepve = 0;
    mysqli_query($adb, "INSERT INTO naplo (NURL, NDatum, NIP, NLID)
                                VALUES('$_SERVER[REQUEST_URI]', NOW(), '$_SERVER[REMOTE_ADDR]', -1)");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
    <title>
    <?php
        isset($_GET['p']) ? $p = $_GET['p']: $p = "";
        switch($p){//A oldalcímke címe
            case "homepage":
                print("Üdv nálunk");
                break;
            case "rolunk":
                print("Rólunk!");
                break;
            case "termekek":
                print("Böngéssz termékeink között!");
                break;
            case "karrier":
                print("Kezd nálunk a karriered!");
                break;
            case "forum":
                print("Kérdezz egy aktív közösségtől!");
                break;
            case "kapcs":
                print("Vedd fel a kapcsolatot az ügyfélszolgálatunkkal!");
                break;
            case "vendeg":
                print("Szólj hozzá az oldalhoz!");
                break;
            case "login":
                print("Fiók");
                break;
            case "reg":
                print("Regisztráció");
                break;
            case "profil":
                print("Hello, ".$_SESSION["unev"]."!");
                break;
            case "adatmod":
                print("Adatmódosítás");
                break;
            case "kepmod":
                print("Profilképmódosítás");
                break;
            default:
                print("404 - Nincs iyen oldal");
                break;
        }
    ?>
    </title>
</head>
<body>
    <?php
        if (!$belepve)
        {
            print('<div id="menu">
                    [<a href="./?p=homepage">Kezdőoldal</a> |
                    <a href="./?p=termekek">Termék Bázis</a> |
                    <a href="./?p=kapcs">Kapcsolat</a> |
                    <a href="./?p=login">Bejelentkezés</a> ]
                </div>');
        }
        else
        {
            print("<div id='menu'>
                    [<a href='./?p=homepage'>Kezdőoldal</a> ||
                    <a href='./?p=termekek'>termekek</a> |
                    <a href='./?p=kapcs'>Kapcsolat</a> | ]
                    <a href='./?p=profil'>$_SESSION[unev]</a>
                </div>");
        }
    ?>
    <div>
    <?php
    isset($_GET['p']) ? $p = $_GET['p']:  $p = null;
        switch($p){//Actual oldalak
            case "":
                if($belepve)
                {
                    print("<span></span>");
                }
                else
                {
                    include("start_ir.php");
                }
                break;
            case "homepage":
                include("homepage.html");
                break;
            case "termekek":
                include("termekbazis.php");
                break;
            case "kapcs":
                include("elerhetoseg.php");
                break;
            case "login":
                include("login.php");
                break;
            case "reg":
                include("reg.php");
                break;
            case "profil":
                include("profil.php");
                break;
            case "adatmod":
                include("adatmod.php");
                break;
            case "kepmod":
                include("profilkep.php");
                break;
            case "logout":
                include("logout.php");
                break;
            default:
                print("<h1>404</h1>");
                break;
        }
        $fajlnev = date("Ymd").".txt";

        if(!file_exists("./logins/$fajlnev"))//Ha nincs ilyen fájl
        {
            $fp = fopen("./logins/$fajlnev", "w");//Fájl létrehozás
            //Az fopen method egy resource-t ad vissza ami egy memóriában eltárolt(logikai) fájl.
            fwrite($fp, "0");
            fclose($fp);
        }
    
        $fp = fopen("./logins/$fajlnev", "r");
        $n = fread($fp,filesize("./logins/$fajlnev"));
        fclose($fp);
    
        if(!isset($_SESSION['eg']))
        {
            $n++;
        
            $fp = fopen($fajlnev, "w");//Felülírás
            fwrite($fp, $n);
            fclose($fp);
        
            $_SESSION['eg'] = "kábel";
        }

        
        mysqli_close($adb);
    ?>
    </div>
</body>
</html>