<?php
$orszagok = array("Spanyolország", "Görögország", "Törökország", "Örményország");
    if(!isset($_SESSION['Taxi']))
    {    
        print("<style>
               input[type='radio']{
                   margin: 5px 5px;
               }
               input[type='submit']{
                   margin-top: 5px;
               }
               </style>
               <h4>Szavazás</h4>
               <form action='szavazas_ir.php' method='post' target='kisablak'>
                   <input type='radio' name='szavazas' value='1'>$orszagok[0]<br>
                   <input type='radio' name='szavazas' value='2'>$orszagok[1]<br>
                   <input type='radio' name='szavazas' value='3'>$orszagok[2]<br>
                   <input type='radio' name='szavazas' value='4'>$orszagok[3]<br>
                   <input type='submit' value='Szavazok'>
               </form>");
    }
    else{
        $fp = fopen("szavazasok.txt", "r");
        $allas = fread($fp, filesize("szavazasok.txt"));
        $db = explode(";", $allas);
        fclose($fp);

        $ossz = array_sum($db);
        $szazalek = array($db[0]/$ossz*100, $db[1]/$ossz*100, $db[2]/$ossz*100, $db[3]/$ossz*100);
        print "Szavazás állása:<br>
            <style>
                table#eredmeny tr td span{
                    display: inline-block;
                    height: 12px;
                    background-color: #008;
                }
            </style>
            <table id='eredmeny'>
               <tr><td>$orszagok[0] <td> $db[0] <td> $szazalek[0] % <td> <span style='width:".($szazalek[0]*10)."px'></tr>
               <tr><td>$orszagok[1] <td> $db[1] <td> $szazalek[1] % <td> <span style='width:".($szazalek[1]*10)."px'></tr>
               <tr><td>$orszagok[2] <td> $db[2] <td> $szazalek[2] % <td> <span style='width:".($szazalek[2]*10)."px'></tr>
               <tr><td>$orszagok[3] <td> $db[3] <td> $szazalek[3] % <td> <span style='width:".($szazalek[3]*10)."px'></tr>
            </table>";
    }
?>