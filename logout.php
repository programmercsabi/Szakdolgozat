<?php
    session_start();
    include("adbkapcsolat.php");
    
    unset($_SESSION['uid']);
    unset($_SESSION['unev']);
    unset($_SESSION['umail']);
    unset($_SESSION['upw']);
    unset($_SESSION['ujog']);

    print("<script>parent.location.href = './'</script>");

    mysqli_close($adb);
?>