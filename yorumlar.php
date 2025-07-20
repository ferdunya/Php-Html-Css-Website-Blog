yorumlar.php
<?php
session_start();
include('connect.php');

if (!isset($_GET['blog_id'])) {
    die("Blog ID belirtilmemiş.");
}
$blog_id = $_GET['blog_id'];

// Blog yazısını çekiyoruz
$sql = "SELECT * FROM bloglar WHERE id = ?";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();
$blog = $result->fetch_assoc();

if (!$blog) {
    die("Blog yazısı bulunamadı.");
}

// Yorum ekleme bloğu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $yorum_yazar = $_SESSION['kullanici'];
    $yorum_icerik = $_POST['icerik'];

    if (!empty($yorum_icerik)) {
        $sql = "INSERT INTO yorumlar (blog_id, yazar, icerik) VALUES (?, ?, ?)";
        $stmt = $baglan->prepare($sql);
        $stmt->bind_param("iss", $blog_id, $yorum_yazar, $yorum_icerik);
        $stmt->execute();
        header("Location: yorumlar.php?blog_id=$blog_id");
        exit;
    } else {
        $mesaj = "Yorum içeriği boş olamaz.";
    }
}
// Yorumları veritabanından çekiyoruz
$sql = "SELECT * FROM yorumlar WHERE blog_id = ? ORDER BY tarih ASC";
$stmt = $baglan->prepare($sql);
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$yorumlar = $stmt->get_result();
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($blog['baslik']); ?> - Yorumlar</title>
    <link rel="stylesheet" href="all_css/blog_page.css">
</head>
<body>
<div class="container">
    <h1><?php echo htmlspecialchars($blog['baslik']); ?></h1>
    <p><em>Yazar: <?php echo htmlspecialchars($blog['yazar']); ?> | Tarih: <?php echo $blog['tarih']; ?></em></p>
    <p><?php echo nl2br(htmlspecialchars($blog['icerik'])); ?></p>

    <h2>Yorumlar</h2>
    <?php while ($yorum = $yorumlar->fetch_assoc()): ?>
        <div class="yorum">
            <p><strong><?php echo htmlspecialchars($yorum['yazar']); ?></strong> (<?php echo $yorum['tarih']; ?>):</p>
            <p><?php echo nl2br(htmlspecialchars($yorum['icerik'])); ?></p>
        </div>
    <?php endwhile; ?>

    <?php if (isset($mesaj)): ?>
        <p style="color: red;"><?php echo $mesaj; ?></p>
    <?php endif; ?>

    <h3>Yorum Yaz</h3>
    <form method="post">
        <textarea name="icerik" rows="4" required></textarea><br>
        <button type="submit">Yorum Gönder</button>

    </form>
    <a href="logout.php" >Çıkış Yap </a> <br>
    <a href="blog_yazanlar.php" >Geri Dön</a>

</div>
</body>
</html>
