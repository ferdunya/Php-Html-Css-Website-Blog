login.php
<?php
session_start();  // Oturum başlatıyoruz
include('connect.php'); //veritabanına işliyoruz

// Kullanıcı adı ve şifre kontrolü kısmı
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kullanici = $_POST['kullanici'];
    $sifre = $_POST['sifre'];

    //prepared statement ile kullanıcıyı sorgulatıyoruz
    $stmt = $baglan->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $kullanici); // Kullanıcı adını bağla
    $stmt->execute();
    $sonuc = $stmt->get_result();

    // Kullanıcı bulunursa
    if ($sonuc->num_rows === 1) {
        $kullanici_bilgisi = $sonuc->fetch_assoc();

        // Şifreyi düz metin (text) olarak karşılaştırıyoruz
        if ($sifre === $kullanici_bilgisi['password']) {
            $_SESSION['giris'] = sha1(md5("var"));  // Giriş işlemi
            $_SESSION['kullanici'] = $kullanici;    // Kullanıcı adı

            // kullanıcı Cookie'lerini ayarlıyoruz.
            setcookie('kullanici', 'msb', time() + (60 * 60 * 24 * 30));  // 30 gün boyunca cookie aktif olacak

            // Kullanıcıyı blog sayfasına yönlendirdik
            header("Location: blog_page.php");
            exit;
        } else {
            echo "<script>alert('Hatalı şifre!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Kullanıcı bulunamadı!'); window.location.href='login.php';</script>";
    }
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="all_css/login_register.css">
</head>
<body style="text-align:center; padding-top:50px;">

<form action="" method="post">

    <h2>GİRİŞ YAP</h2>
    <b>Kullanıcı Adı:</b><br>
    <input type="text" name="kullanici" required><br>
    <b>Parola:</b><br>
    <input type="password" name="sifre" required><br><br>
    <input type="submit" value="Giriş Yap">
    <a href="register.php">Hesabınız yok mu? Kayıt olun</a>
    <a href="index.php">Anasayfaya Dön</a>

</form>

</body>
</html>
