<?php
    $server ='localhost';
    $user ='root';
    $dpw ='csaba1991';
    $db ='pelda';
    $adb = mysqli_connect($server, $user, $dpw, $db);

    function randomstring($h=10)
    {
		$s = "";
        $source = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i=0; $i <= $h; $i++)
        {
            $randchar = $source[rand(0, strlen($source) - 1)];
            $s .= $randchar;
        }
        return $s;
    };
?>