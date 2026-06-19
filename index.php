<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Blog | Professional dizayn</title>
    <!-- Font Awesome 6 ikonkalar uchun -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
    <!-- ==================== HEADER ==================== -->
    <?php include './components/header.php' ?>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="main-content">
        <div class="page-header">
            <span class="badge">Bizning blog</span>
            <h1>So'nggi maqolalar</h1>
            <p class="subtitle">Ilhomlantiruvchi hikoyalar, foydali maslahatlar va qiziqarli yangiliklar</p>
        </div>

        <div class="blog-grid">
            <!-- 1-blog -->
            <article class="blog-card">
                <img
                    src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?q=80&w=2070&auto=format&fit=crop"
                    alt="Tog' manzarasi"
                    class="blog-card-image"
                    loading="lazy">
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="far fa-calendar-alt"></i> 19-iyun, 2026</span>
                        <span class="blog-category">Sayohat</span>
                    </div>
                    <h2 class="blog-title">Tog' cho'qqilarida ilhom: bir kunlik sarguzasht</h2>
                    <p class="blog-description">
                        Tabiat qo'ynida o'tkazilgan bir kun inson qalbiga qanday xotiralar sovg'a qiladi? Tiniq havo va bulutlar uzra yo'l...
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>

            <!-- 2-blog -->
            <article class="blog-card">
                <img
                    src="https://images.unsplash.com/photo-1498837167922-ddd27525d352?q=80&w=2070&auto=format&fit=crop"
                    alt="Sog'lom taom"
                    class="blog-card-image"
                    loading="lazy">
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="far fa-calendar-alt"></i> 15-iyun, 2026</span>
                        <span class="blog-category">Ovqat</span>
                    </div>
                    <h2 class="blog-title">Sog'lom nonushta: kunni to'g'ri boshlash sirlari</h2>
                    <p class="blog-description">
                        Ertalabki taom nafaqat energiya balki kayfiyat manbai hamdir. Qanday mahsulotlar tanlash kerakligini bilasizmi?
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>

            <!-- 3-blog -->
            <article class="blog-card">
                <img
                    src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop"
                    alt="Dasturlash"
                    class="blog-card-image"
                    loading="lazy">
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="far fa-calendar-alt"></i> 10-iyun, 2026</span>
                        <span class="blog-category">Texnologiya</span>
                    </div>
                    <h2 class="blog-title">2026-yilda eng ko'p talab qilinadigan dasturlash tillari</h2>
                    <p class="blog-description">
                        Sun'iy intellekt va web sohasida qaysi tillar yetakchilik qilmoqda? Ish beruvchilar nimani kutmoqda?
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>

            <!-- 4-blog -->
            <article class="blog-card">
                <img
                    src="https://images.unsplash.com/photo-1558618666-fcd25c85f82e?q=80&w=2070&auto=format&fit=crop"
                    alt="Kitob o'qish"
                    class="blog-card-image"
                    loading="lazy">
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="far fa-calendar-alt"></i> 5-iyun, 2026</span>
                        <span class="blog-category">Kitob</span>
                    </div>
                    <h2 class="blog-title">Yoz oqshomlarida o'qish uchun 5 ta ajoyib roman</h2>
                    <p class="blog-description">
                        Ta'til paytida sizni o'ziga rom qiladigan sarguzasht va drama kitoblari ro'yxati bilan tanishing.
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>

            <!-- 5-blog -->
            <article class="blog-card">
                <img
                    src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=2070&auto=format&fit=crop"
                    alt="Stol ustidagi taom"
                    class="blog-card-image"
                    loading="lazy">
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="far fa-calendar-alt"></i> 1-iyun, 2026</span>
                        <span class="blog-category">Ovqat</span>
                    </div>
                    <h2 class="blog-title">Oshxonada ijod: yangi retseptlar bilan tanishamiz</h2>
                    <p class="blog-description">
                        Oddiy mahsulotlardan ajoyib taomlar tayyorlash san'ati. Uyda restoran sifatini yaratish uchun maslahatlar.
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>

            <!-- 6-blog -->
            <article class="blog-card">
                <img
                    src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?q=80&w=2070&auto=format&fit=crop"
                    alt="Sayohat chamadoni"
                    class="blog-card-image"
                    loading="lazy">
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="far fa-calendar-alt"></i> 28-may, 2026</span>
                        <span class="blog-category">Sayohat</span>
                    </div>
                    <h2 class="blog-title">Sayohatga chiqishdan oldin bilish kerak bo'lgan 7 maslahat</h2>
                    <p class="blog-description">
                        Yuklarni to'g'ri joylash, hujjatlar va yo'nalish rejasi bo'yicha foydali tavsiyalar to'plami.
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>
        </div>
    </main>

    <!-- ==================== FOOTER ==================== -->
    <?php include './components/footer.php' ?>
</body>

</html>