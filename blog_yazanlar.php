blog_yazanlar.php
<?php
session_start();
include('connect.php');

// Blog yazılarını çekiyoruz
$sql = "SELECT * FROM bloglar ORDER BY tarih DESC";
$result = $baglan->query($sql);
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Blog Sayfası</title>
    <link rel="stylesheet" href="all_css/blog_page.css">
</head>
<body>
<div class="container">
    <h1>Blog Yazıları</h1>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="blog-post">
            <h2><?php echo htmlspecialchars($row['baslik']); ?></h2>
            <p><em>Yazar: <?php echo htmlspecialchars($row['yazar']); ?> | Tarih: <?php echo $row['tarih']; ?></em></p>
            <p><?php echo nl2br(htmlspecialchars($row['icerik'])); ?></p>
            <a href="yorumlar.php?blog_id=<?php echo $row['id']; ?>">Yorumları Gör</a>

        </div>
    <?php endwhile; ?>
    <br>

    <a href="blog_page.php">Geri Dön</a>

</div>
</body>
</html>
