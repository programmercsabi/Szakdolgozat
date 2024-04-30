<?php
    date_default_timezone_set("Europe/Budapest");
    session_start();

    if($_POST['comment_name'] == '')//Ha nincs név
        die("<script>alert('Nem írtál be nevet!')</script>");

    if($_POST['comment_text'] == '')//Ha nincs szöveg
        die("<script>alert('Nem írtál szöveget!')</script>");

    if($_SESSION['cc'] != $_POST['Captcha'])
        die("alert('Nem jól számoltál!')".$_SESSION['cc']."*".$_POST['Captcha']);

    $csatolmany = $_FILES["comment_file"];//Csatolmány elmentése
    $fajlnev = $csatolmany["name"];//Fájl neve
    $kiterj = substr($fajlnev, strrpos($fajlnev, '.'));//Kiterjesztés
    $ujnev = date("YmdHis").$kiterj;//Egyedi név

    move_uploaded_file($csatolmany['tmp_name'], "./files/$ujnev");//Feltöltött fájl áthelyezése
    
    $clearname = str_replace("\r\n", "", nl2br(str_replace(";", ",", $_POST['comment_name'])));//Komment név formázása

    $clearcomment = str_replace("\r\n", "", nl2br(str_replace(";", ",", $_POST['comment_text'])));//Komment szöveg formázása

    file_put_contents("all_comments.txt",
                        date("Y.m.d H:i:s").";$clearname;$clearcomment;$fajlnev;$ujnev\r\n",
                        FILE_APPEND);//Komment elmentése

    $mailszoveg = "Kedves Admin, új komment érkezett a weboldaladra.\r\nÜdv,\r\nAdmin";
    mail("admin@uzenofal.hu", "Új bejegyzés", $mailszoveg, "From:admin@uzenofal.hu");
?>
<script>
    parent.location.href = parent.location.href
</script>