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

            <?php
            $blogs = json_decode(file_get_contents('./data/blogs.json'), true);
            ?>

            <?php foreach ($blogs as $blog) : ?>
                <!-- blog -->
                <article class="blog-card">
                    <img
                        src="<?= $blog['image'] ?>"
                        alt="<?= $blog['alt'] ?>"
                        class="blog-card-image"
                        loading="lazy">
                    <div class="blog-card-content">
                        <div class="blog-meta">
                            <span class="blog-date"><i class="far fa-calendar-alt"></i> <?= $blog['date'] ?></span>
                            <span class="blog-category"><?= $blog['category'] ?></span>
                        </div>
                        <h2 class="blog-title"><?= $blog['title'] ?></h2>
                        <p class="blog-description">
                            <?= $blog['description'] ?>
                        </p>
                        <button class="read-more"> <?= $blog['readMoreText'] ?> <i class="fas fa-arrow-right"></i></button>
                    </div>
                </article>

            <?php endforeach ?>
        </div>
    </main>

    <!-- ==================== FOOTER ==================== -->
    <?php include './components/footer.php' ?>
</body>

</html>