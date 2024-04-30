<?php
    session_start();

    include("adbkapcsolat.php");

    print_r($_FILES);

    if ($_FILES['ukep']['name'] == "")
        die("<script>alert('Nem töltöttél fel képet!')</script>");

    $fajlnev = $_FILES['ukep']['name'];

    $kepnev = date("YmdHis") ."_". $_POST['ustrid']."_". randomstring(10).substr($fajlnev, strrpos($fajlnev, '.'));

    $user = mysqli_fetch_array(mysqli_query($adb, "SELECT * FROM user WHERE ustrid='$_POST[ustrid]'"));

    if (md5($_POST['upw']) != $user['upw'])
        die("<script>alert('Hibás jelszó!')</script>");

    move_uploaded_file($_FILES['ukep']['tmp_name'], "./profilkep/$kepnev");

    $_SESSION['ukep'] = "./profilkep/$kepnev";

    mysqli_query($adb, "UPDATE user SET uprofilkep = '$kepnev'
                        WHERE ustrid = '$_POST[ustrid]'");

    print("<script>alert('Sikeres képmódosítás!')</script>");

    print("<script>parent.location.href = parent.location.href</script>");

    mysqli_close($adb);
?>