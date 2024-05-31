<?php
include "koneksi.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head> 
    <body>
        <div class="login_box">
            <p class="text_login">LOGIN SYNTORY SEJUTAKADO</p>
            <form action="ceklogin.php  " method="post" role="form">
                <label>Username</label>
                <input type="text" name="id_user" class="form_login" placeholder="id_user" auto complete="off">
                <label>Password</label>
                <input type="password" name="sandi" class="form_login" placeholder="sandi" auto complete="off">
                <input type="submit" class="tombol_login" value="login">
            </form>
        </div>
    </body>
</html>