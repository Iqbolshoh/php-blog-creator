<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Bloglar | Chiroyli dizayn</title>
    <!-- Font Awesome ikonkalar uchun -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Roboto', system-ui, -apple-system, sans-serif;
            background: linear-gradient(160deg, #f5efe6 0%, #ede0d0 50%, #f9f3ea 100%);
            min-height: 100vh;
            padding: 2rem 1.5rem;
            margin: 0;
        }

        /* Asosiy konteyner */
        .blog-page {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Sarlavha qismi */
        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header .subtitle {
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #b08968;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .page-header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #3e2e21;
            letter-spacing: -0.5px;
            margin-bottom: 0.8rem;
        }

        .page-header .header-line {
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #c9a87c, #ddc3a5);
            margin: 0 auto;
            border-radius: 5px;
        }

        /* Blog kartochkalari grid */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        /* Bitta blog kartochkasi */
        .blog-card {
            background: #ffffff;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 18px 35px rgba(80, 50, 30, 0.08), 0 5px 12px rgba(0, 0, 0, 0.04);
            transition: all 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid rgba(200, 170, 130, 0.2);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 28px 45px rgba(90, 55, 30, 0.13), 0 10px 20px rgba(0, 0, 0, 0.07);
            border-color: rgba(185, 140, 100, 0.4);
        }

        /* Rasm */
        .blog-card-image {
            width: 100%;
            height: 230px;
            object-fit: cover;
            display: block;
            transition: transform 0.55s ease;
        }

        .blog-card:hover .blog-card-image {
            transform: scale(1.04);
        }

        /* Kontent */
        .blog-card-content {
            padding: 1.5rem 1.7rem 1.8rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        /* Vaqt va kategoriya */
        .blog-meta {
            display: flex;
            align-items: center;
            gap: 0.7rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .blog-date {
            background: #f6efe6;
            color: #6b4f38;
            padding: 0.4rem 1rem;
            border-radius: 2rem;
            font-size: 0.82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            border: 1px solid #e5d3bc;
        }

        .blog-date i {
            color: #b47c5a;
            font-size: 0.8rem;
        }

        .blog-category {
            background: transparent;
            color: #8b6b4f;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            border: 1px dashed #c9aa87;
            padding: 0.35rem 0.9rem;
            border-radius: 2rem;
        }

        /* Sarlavha */
        .blog-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #3e2e21;
            line-height: 1.3;
            margin-bottom: 0.7rem;
            transition: color 0.2s;
            cursor: pointer;
        }

        .blog-title:hover {
            color: #8b5a3c;
        }

        /* Tavsif */
        .blog-description {
            font-size: 0.95rem;
            color: #5d4a38;
            line-height: 1.65;
            margin-bottom: 1.4rem;
            flex: 1;
            opacity: 0.85;
        }

        /* "Batafsil" tugmasi */
        .read-more {
            align-self: flex-start;
            background: transparent;
            border: none;
            color: #5a3f2e;
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all 0.25s;
            letter-spacing: 0.3px;
            border-bottom: 2px solid transparent;
        }

        .read-more i {
            font-size: 0.8rem;
            transition: transform 0.3s;
        }

        .read-more:hover {
            color: #2f1f12;
            border-bottom-color: #b08968;
            gap: 0.7rem;
        }

        .read-more:hover i {
            transform: translateX(5px);
        }

        /* Pagination / ko'proq tugmasi */
        .pagination-area {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .load-more {
            background: #4d3826;
            border: none;
            color: #fef8f0;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.9rem 2.8rem;
            border-radius: 3rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            cursor: pointer;
            background: linear-gradient(115deg, #5a3f2e 0%, #3f2c1f 100%);
            box-shadow: 0 10px 20px rgba(75, 45, 25, 0.25);
            transition: all 0.3s;
            border: 1px solid #775e45;
            letter-spacing: 0.4px;
        }

        .load-more i {
            font-size: 0.9rem;
        }

        .load-more:hover {
            background: linear-gradient(115deg, #6f4e38 0%, #4e3524 100%);
            box-shadow: 0 14px 24px rgba(70, 40, 20, 0.35);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 1.5rem 1rem;
            }

            .page-header h1 {
                font-size: 2.2rem;
            }

            .blog-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .blog-card-image {
                height: 210px;
            }
        }
    </style>
</head>

<body>
    <div class="blog-page">
        <!-- Sarlavha -->
        <div class="page-header">
            <p class="subtitle">📝 Bizning blog</p>
            <h1>So‘nggi maqolalar</h1>
            <div class="header-line"></div>
        </div>

        <!-- Blog kartochkalari to'plami -->
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
                        <span class="blog-category">SAYOHAT</span>
                    </div>
                    <h2 class="blog-title">Tog‘ cho‘qqilarida ilhom: bir kunlik sarguzasht</h2>
                    <p class="blog-description">
                        Tabiat qo‘ynida o‘tkazilgan bir kun inson qalbiga qanday xotiralar sovg‘a qiladi? Tiniq havo va bulutlar uzra yo‘l...
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
                        <span class="blog-category">OVQAT</span>
                    </div>
                    <h2 class="blog-title">Sog‘lom nonushta: kunni to‘g‘ri boshlash sirlari</h2>
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
                        <span class="blog-category">TEXNOLOGIYA</span>
                    </div>
                    <h2 class="blog-title">2026-yilda eng ko‘p talab qilinadigan dasturlash tillari</h2>
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
                        <span class="blog-category">KITOB</span>
                    </div>
                    <h2 class="blog-title">Yoz oqshomlarida o‘qish uchun 5 ta ajoyib roman</h2>
                    <p class="blog-description">
                        Ta'til paytida sizni o‘ziga rom qiladigan sarguzasht va drama kitoblari ro‘yxati bilan tanishing.
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
                        <span class="blog-category">OVQAT</span>
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
                        <span class="blog-category">SAYOHAT</span>
                    </div>
                    <h2 class="blog-title">Sayohatga chiqishdan oldin bilish kerak bo‘lgan 7 maslahat</h2>
                    <p class="blog-description">
                        Yuklarni to‘g‘ri joylash, hujjatlar va yo‘nalish rejasi bo‘yicha foydali tavsiyalar to‘plami.
                    </p>
                    <button class="read-more">Batafsil <i class="fas fa-arrow-right"></i></button>
                </div>
            </article>
        </div>

        <!-- "Ko'proq yuklash" tugmasi -->
        <div class="pagination-area">
            <button class="load-more">
                Yana yuklash <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>
</body>

</html>