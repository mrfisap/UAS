<!DOCTYPE HTML>
<html>
    <head>
        <title>Halaman Daftar</title>
        <link href="style_daftar.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
          <h1>Daftar</h1>
            <form method="POST" action="admin/register.php">
                <label>Username</label><br>
                <input name="username" type="text" required><br>

                <label>Email</label><br>
                <input name="email" type="email" required><br>

                <label>Password</label><br>
                <input name="password" type="password" required><br>

                <label>Nama</label><br>
                <input name="nama" type="text" required><br>

                <button type="submit">Register</button>
                <p> Sudah punya akun?
                  <a href="index.php">Login di sini</a>
                </p>
            </form>
        </div>
    </body>
</html>