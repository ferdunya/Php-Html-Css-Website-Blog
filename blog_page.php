blog_page.php
<?php
session_start();
include('connect.php');

if (!isset($_SESSION["giris"]) || $_SESSION["giris"] !== sha1(md5("var")) || $_COOKIE["kullanici"] !== "msb") {
    header("Location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $baslik = $_POST['baslik'];
    $icerik = $_POST['icerik'];
    $yazar = $_SESSION['kullanici'];

    if (!empty($baslik) && !empty($icerik)) {
        $stmt = $baglan->prepare("INSERT INTO bloglar (baslik, icerik, yazar, tarih) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("sss", $baslik, $icerik, $yazar);
        $stmt->execute();
        $stmt->close();
        $mesaj = "Blog gönderiniz başarıyla eklendi.";
    } else {
        $mesaj = "Lütfen tüm alanları doldurun.";
    }
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Blog Ekle</title>
    <link rel="stylesheet" href="all_css/blog_page.css">
</head>
<body>
<div class="container">
    <h1>Blog Yaz</h1>
    <p>Hoş geldin, <strong><?php echo htmlspecialchars($_SESSION['kullanici']); ?></strong></p>

    <?php if (isset($mesaj)) echo "<div class='mesaj'>$mesaj</div>"; ?>

    <form method="post" class="blog-form">
        <label for="baslik">Başlık</label>
        <input type="text" name="baslik" id="baslik" required>

        <label for="icerik">İçerik</label>
        <textarea name="icerik" id="icerik" rows="6" required></textarea>

        <button type="submit">Blogu Yayınla</button>
    </form>

    <a href="logout.php" class="logout">Çıkış Yap</a>
    <a href="blog_yazanlar.php" >Blog Yazanlar</a>

</div>
</body>
</html>
