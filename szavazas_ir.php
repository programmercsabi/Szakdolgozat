<?php
    session_start();

    if(isset($_SESSION['Taxi']))
    {    
        die("<script>alert('Már szavaztál!')</script>");
    }
    else
        $_SESSION['Taxi'] = "Kuplung";

    if(!isset($_POST['szavazas'])){
        die("<script>alert('Nem is szavaztál!')</script>");
    }

    if(!file_exists("szavazasok.txt")){
        $fp = fopen("szavazasok.txt", "w");
        fwrite($fp, "0;0;0;0");
        fclose($fp);
    }

    $fp = fopen("szavazasok.txt", "r");
    $allas = fread($fp, filesize("szavazasok.txt"));
    fclose($fp);

    $db = explode(';', $allas);
    $db[$_POST['szavazas'] - 1]++;
    $allas = implode(";", $db);
    
    $fp = fopen("szavazasok.txt", "w");
    fwrite($fp, $allas);
    fclose($fp);
    print $allas;
?>
<script>
    parent.location.href = parent.location.href//frissítés
</script>