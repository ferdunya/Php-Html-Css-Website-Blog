register.php
<?php
include('connect.php');

if ($_POST) {
    $kullanici = $_POST['kullanici'];
    $sifre = $_POST['sifre'];

    // Böyle bir kullanıcı var mı yok mu mi kontrol et
    $kontrol = $baglan->query("SELECT * FROM users WHERE username = '$kullanici'");
    if ($kontrol->num_rows > 0) {
        echo "<script>alert('Bu kullanıcı adı zaten kayıtlı.'); window.location.href='register.php';</script>";
    } else {
        // Kullanıcıyı kaydettik hashleme yok direk veritabana text olarak kaydeder
        $baglan->query("INSERT INTO users (username, password) VALUES ('$kullanici', '$sifre')");
        echo "<script>alert('Kayıt başarılı. Giriş yapabilirsiniz.'); window.location.href='index.php';</script>";
    }
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="all_css/login_register.css">
</head>
<body style="text-align:center; padding-top:50px;">
<form action="" method="post">

    <h2>KAYIT OL</h2>
    <b>Kullanıcı Adı:</b><br>
    <input type="text" name="kullanici" required><br>
    <b>Parola:</b><br>
    <input type="password" name="sifre" required><br><br>
    <input type="submit" value="Kayıt Ol">
    <a href="login.php">Giriş Yap</a>
    <a href="index.php">Anasayfaya Dön</a>

</form>
</body>
</html>

