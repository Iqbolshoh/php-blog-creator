<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Blog | Professional dizayn</title>
    <!-- Font Awesome 6 ikonkalar uchun -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Roboto', system-ui, -apple-system, sans-serif;
            background: #faf7f2;
            color: #3e2e21;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ========== HEADER ========== */
        .site-header {
            background: #ffffff;
            border-bottom: 1px solid #e8ddd0;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 2px 20px rgba(80, 50, 20, 0.05);
        }

        .header-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            color: #3e2e21;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: -0.3px;
        }

        .logo i {
            font-size: 1.7rem;
            color: #b08968;
            background: #f5ede2;
            padding: 0.45rem;
            border-radius: 0.7rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .btn-search {
            background: none;
            border: none;
            font-size: 1.15rem;
            color: #5d4a38;
            cursor: pointer;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .btn-search:hover {
            background: #f3ede5;
        }

        .btn-subscribe {
            background: #4d3826;
            color: #fef8f0;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            letter-spacing: 0.3px;
        }

        .btn-subscribe:hover {
            background: #5a3f2e;
            box-shadow: 0 6px 18px rgba(75, 45, 25, 0.25);
        }

        /* ========== MAIN CONTENT ========== */
        .main-content {
            flex: 1;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 2.5rem 1.5rem;
        }

        /* Sahifa sarlavhasi */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header .badge {
            display: inline-block;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            color: #b08968;
            font-weight: 700;
            background: #f5ede2;
            padding: 0.4rem 1.2rem;
            border-radius: 2rem;
            margin-bottom: 0.8rem;
        }

        .page-header h1 {
            font-size: 2.6rem;
            font-weight: 700;
            color: #3e2e21;
            letter-spacing: -0.5px;
            margin-bottom: 0.6rem;
        }

        .page-header .subtitle {
            color: #7a6550;
            font-size: 1.05rem;
            font-weight: 400;
        }

        /* Blog grid */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2rem;
        }

        /* Blog kartochkasi */
        .blog-card {
            background: #ffffff;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 12px 28px rgba(80, 50, 20, 0.06), 0 2px 8px rgba(0, 0, 0, 0.03);
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid rgba(200, 170, 130, 0.15);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 40px rgba(90, 55, 20, 0.1), 0 6px 14px rgba(0, 0, 0, 0.05);
            border-color: rgba(185, 140, 100, 0.3);
        }

        .blog-card-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-card-image {
            transform: scale(1.03);
        }

        .blog-card-content {
            padding: 1.4rem 1.6rem 1.7rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .blog-meta {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-bottom: 0.9rem;
            flex-wrap: wrap;
        }

        .blog-date {
            font-size: 0.8rem;
            color: #8b6b4f;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .blog-date i {
            color: #b47c5a;
            font-size: 0.85rem;
        }

        .blog-category {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            color: #b08968;
            background: #f8f2ea;
            padding: 0.3rem 0.8rem;
            border-radius: 2rem;
        }

        .blog-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #3e2e21;
            line-height: 1.35;
            margin-bottom: 0.6rem;
            transition: color 0.2s;
            cursor: pointer;
        }

        .blog-title:hover {
            color: #8b5a3c;
        }

        .blog-description {
            font-size: 0.9rem;
            color: #6b5a48;
            line-height: 1.6;
            flex: 1;
            margin-bottom: 1.2rem;
        }

        .read-more {
            align-self: flex-start;
            background: transparent;
            border: none;
            color: #5a3f2e;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            padding: 0.4rem 0;
            transition: all 0.25s;
            border-bottom: 2px solid transparent;
        }

        .read-more i {
            font-size: 0.75rem;
            transition: transform 0.3s;
        }

        .read-more:hover {
            color: #2f1f12;
            border-bottom-color: #b08968;
            gap: 0.65rem;
        }

        .read-more:hover i {
            transform: translateX(4px);
        }

        /* ========== FOOTER ========== */
        .site-footer {
            background: #ffffff;
            border-top: 1px solid #e8ddd0;
            padding: 2.5rem 2rem 1.5rem;
            margin-top: auto;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .footer-brand p {
            color: #7a6550;
            font-size: 0.9rem;
            max-width: 350px;
            line-height: 1.5;
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 2rem auto 0;
            padding-top: 1.2rem;
            border-top: 1px solid #ede3d7;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.8rem;
            font-size: 0.85rem;
            color: #8b7a66;
        }

        .social-icons {
            display: flex;
            gap: 0.7rem;
        }

        .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.2rem;
            height: 2.2rem;
            background: #f5ede2;
            color: #5e4232;
            border-radius: 50%;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .social-icons a:hover {
            background: #d9b694;
            color: #2f2117;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-header h1 {
                font-size: 2rem;
            }

            .blog-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .footer-brand {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- ==================== HEADER ==================== -->
    <header class="site-header">
        <div class="header-inner">
            <a href="#" class="logo">
                <i class="fas fa-feather-alt"></i>
                <span>BlogMania</span>
            </a>

            <div class="header-actions">
                <button class="btn-search" aria-label="Qidirish">
                    <i class="fas fa-search"></i>
                </button>
                <button class="btn-subscribe">
                    <i class="fas fa-bell"></i> Obuna bo'lish
                </button>
            </div>
        </div>
    </header>

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
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <a href="#" class="logo" style="font-size: 1.3rem;">
                    <i class="fas fa-feather-alt"></i>
                    <span>BlogMania</span>
                </a>
                <p>Ilhomlantiruvchi hikoyalar, foydali maslahatlar va qiziqarli yangiliklar har kuni siz uchun.</p>
            </div>

            <div class="social-icons">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Telegram"><i class="fab fa-telegram-plane"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; 2026 BlogMania. Barcha huquqlar himoyalangan.</span>
        </div>
    </footer>
</body>

</html>