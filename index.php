index.php
<?php
session_start();
include('connect.php');
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Sayfasına Hoş Geldiniz</title>
    <link rel="stylesheet" href="all_css/style.css">
</head>
<body style="text-align:center; padding-top:50px;">

<div class="container">
    <div class="left-side">
        <h2>Yardımlaşma Blogu Nedir?</h2>
        <p>Yardımlaşma blogu, insanların bilgi ve deneyimlerini paylaşarak birbirlerine yardımcı olduğu bir platformdur. Burada farklı konularda yazılar yazabilir, sorular sorabilir ve topluluk üyelerinin cevaplarını okuyabilirsiniz.</p>
        <p>Amacımız, kullanıcıların farklı konularda birbirlerine yardımcı olmasını sağlamak ve sorulara en doğru yanıtları bulmalarını sağlamaktır. Bu platformda herkesin sesini duyurabilmesi için yazı yazabilir ve diğerlerinin yazılarına yorum yapabilirsiniz.</p>
        <p>Blogumuzda, teknoloji, yaşam tarzı, eğitim ve diğer birçok konuda içerik bulunmaktadır. Yardımlaşma temalı yazılar, topluluğun birbirine destek olduğu ve bilgi paylaştığı bir ortam yaratır.</p>
    </div>

    <div class="right-side">
        <h2>Blog Sayfamıza Hoş Geldiniz!</h2>
        <p>Yararlı içerikler, eğitici yazılar ve topluluğumuzun katkılarıyla birbirimize yardımcı olmak adına bir araya geldik. Burada kendi yazılarınızı paylaşabilir veya başkalarına sorular sorabilirsiniz.</p>
        <p>Herkesin yazı yazması teşvik edilmektedir. Kendi deneyimlerinizi paylaşarak başkalarına yardımcı olabilirsiniz. Ayrıca, paylaşılan yazılara yorum yaparak topluluğa katkı sağlayabilirsiniz.</p>
        <p>Blog sayfamızda gezinirken faydalı içeriklere rastlayabilirsiniz. Eğer üyeliğiniz yoksa, hemen kaydolarak yazılarınızı paylaşmaya başlayabilirsiniz.</p>
        <br>
        <a href="register.php">Kayıt Ol</a> | <a href="login.php">Giriş Yap</a>
    </div>
</div>
</body>
</html>
