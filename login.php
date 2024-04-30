<h1>Fiók</h1>
<form action="login_ir.php" 
      method='post'
      target='kisablak' 
      style='margin: 24px 48px; line-height: 32px'>
    <input type="text" name='user' placeholder="Felhasználónév vagy e-mail"><br>
    <input type="password" name='pw' placeholder='Jelszó'><br><br>
    <input type="submit">
    <hr><br>
    <input type="button" value='Regisztráció' onclick="location.href='./?p=reg'">
    <input type="button" class="gomb" value='Kilépés' onclick ='location.href="kilep_ir.php"'>
    </form>