<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: login.php");
    exit;
}

// ID parametrini tekshirish
if (!isset($_GET['id']) || $_GET['id'] === '') {
    header("Location: index.php");
    exit;
}

$id = (int)$_GET['id'];
$blogs = json_decode(file_get_contents('../data/blogs.json'), true);

foreach ($blogs as $i => $b) {
    if ($b['id'] === $id) {
        $blog = $b;
        break;
    }
}

$message = '';
$messageType = '';

?>

<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogni tahrirlash | Admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Roboto', system-ui, -apple-system, sans-serif;
            background: linear-gradient(160deg, #f7f4ef 0%, #efe8dc 100%);
            color: #3e2e21;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
        }

        .form-container {
            background: #ffffff;
            border-radius: 2rem;
            box-shadow: 0 20px 50px rgba(80, 50, 20, 0.08), 0 5px 15px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(200, 170, 130, 0.2);
            padding: 2.5rem 2.8rem;
            width: 100%;
            max-width: 750px;
        }

        /* Xabar */
        .alert {
            padding: 0.9rem 1.2rem;
            border-radius: 0.9rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .alert-success i {
            color: #4caf50;
        }

        /* Header */
        .form-header {
            text-align: center;
            margin-bottom: 2.2rem;
        }

        .form-header .icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: #f5ede2;
            border-radius: 50%;
            margin-bottom: 1rem;
        }

        .form-header .icon-circle i {
            font-size: 1.6rem;
            color: #b08968;
        }

        .form-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #3e2e21;
            margin-bottom: 0.4rem;
        }

        .form-header p {
            color: #8b7a66;
            font-size: 0.95rem;
        }

        /* Form guruhlari */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.2rem;
            margin-bottom: 1.2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #5a3f2e;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            letter-spacing: 0.3px;
        }

        .form-group label i {
            color: #b08968;
            font-size: 0.8rem;
            width: 16px;
            text-align: center;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 0.75rem 1rem;
            border: 1.5px solid #e5d9cb;
            border-radius: 0.9rem;
            font-size: 0.9rem;
            font-family: inherit;
            color: #3e2e21;
            background: #fdfaf6;
            transition: all 0.25s;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #b08968;
            box-shadow: 0 0 0 4px rgba(176, 137, 104, 0.08);
            background: #ffffff;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #b8a590;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 90px;
            line-height: 1.5;
        }

        /* Fayl yuklash maydoni */
        .file-upload-wrapper {
            position: relative;
        }

        .current-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 0.9rem;
            margin-bottom: 1rem;
            border: 1px solid #e5d9cb;
        }

        .current-image.hidden {
            display: none;
        }

        .file-upload-area {
            position: relative;
            border: 2px dashed #d6c4ab;
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #fdfaf6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .file-upload-area:hover {
            border-color: #b08968;
            background: #faf6f0;
        }

        .file-upload-area.has-file {
            border-style: solid;
            border-color: #b08968;
            background: #f9f4ec;
        }

        .file-upload-area i {
            font-size: 2rem;
            color: #b08968;
            transition: all 0.3s;
        }

        .file-upload-area .upload-text {
            font-weight: 600;
            color: #5a3f2e;
            font-size: 0.9rem;
        }

        .file-upload-area .upload-hint {
            font-size: 0.78rem;
            color: #8b7a66;
        }

        .file-upload-area input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .file-name-indicator {
            font-size: 0.85rem;
            color: #5a3f2e;
            font-weight: 500;
            display: none;
            align-items: center;
            gap: 0.4rem;
            margin-top: 0.5rem;
        }

        .file-name-indicator.show {
            display: flex;
        }

        .file-name-indicator i {
            color: #4caf50;
        }

        .keep-current {
            font-size: 0.8rem;
            color: #8b7a66;
            margin-top: 0.3rem;
            font-style: italic;
        }

        /* Tugmalar */
        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.8rem;
            border-radius: 2.5rem;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .btn i {
            font-size: 0.85rem;
        }

        .btn-save {
            background: #4d3826;
            color: #fef8f0;
            box-shadow: 0 8px 20px rgba(75, 45, 25, 0.22);
        }

        .btn-save:hover {
            background: #5a3f2e;
            box-shadow: 0 12px 26px rgba(75, 45, 25, 0.32);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: transparent;
            color: #6b5a48;
            border: 1.5px solid #d6c4ab;
        }

        .btn-cancel:hover {
            background: #f5ede2;
            border-color: #b08968;
        }

        /* Orqaga havola */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: #8b7a66;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #3e2e21;
        }

        .back-link i {
            font-size: 0.8rem;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .form-container {
                padding: 1.8rem 1.5rem;
                border-radius: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-header h1 {
                font-size: 1.4rem;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <!-- Orqaga -->
        <a href="index.php" class="back-link">
            <i class="fas fa-arrow-left"></i> Blog ro'yxatiga qaytish
        </a>

        <!-- Sarlavha -->
        <div class="form-header">
            <div class="icon-circle">
                <i class="fas fa-pen-to-square"></i>
            </div>
            <h1>Blogni tahrirlash</h1>
            <p>ID: <?= $id ?> - "<?= htmlspecialchars($blog['title']) ?>"</p>
        </div>

        <!-- Muvaffaqiyat xabari -->
        <?php if ($message): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-grid">
                <!-- Joriy rasm -->
                <div class="form-group full-width">
                    <label>
                        <i class="fas fa-image"></i> Joriy rasm
                    </label>
                    <?php
                    $imageSrc = $blog['image'];
                    // Agar rasm URL bo'lsa to'g'ridan-to'g'ri, aks holda uploads papkasidan
                    if (strpos($imageSrc, 'http') === 0) {
                        $displaySrc = $imageSrc;
                    } else {
                        $displaySrc = '../' . $imageSrc;
                    }
                    ?>
                    <img
                        src="<?= htmlspecialchars($displaySrc) ?>"
                        alt="<?= htmlspecialchars($blog['alt']) ?>"
                        class="current-image"
                        id="currentImage">
                </div>

                <!-- Yangi rasm yuklash -->
                <div class="form-group full-width">
                    <label>
                        <i class="fas fa-cloud-upload-alt"></i> Yangi rasm yuklash
                    </label>
                    <div class="file-upload-wrapper">
                        <div class="file-upload-area" id="fileUploadArea">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span class="upload-text">Yangi rasm tanlash uchun bosing</span>
                            <span class="upload-hint">JPG, PNG yoki WEBP (max 5MB)</span>
                            <input
                                type="file"
                                id="image"
                                name="image"
                                accept="image/jpeg, image/png, image/webp"
                                onchange="previewFile()">
                        </div>
                        <span class="file-name-indicator" id="fileNameIndicator">
                            <i class="fas fa-check-circle"></i>
                            <span id="fileNameText"></span>
                        </span>
                        <p class="keep-current">
                            <i class="fas fa-info-circle"></i> Agar yangi rasm tanlamasangiz, joriy rasm saqlanib qoladi.
                        </p>
                    </div>
                </div>

                <!-- Alt matni -->
                <div class="form-group full-width">
                    <label for="alt">
                        <i class="fas fa-tag"></i> Rasm uchun alt matni
                    </label>
                    <input
                        type="text"
                        id="alt"
                        name="alt"
                        placeholder="Tog' manzarasi"
                        value="<?= htmlspecialchars($blog['alt']) ?>"
                        required>
                </div>

                <!-- Sana -->
                <div class="form-group">
                    <label for="date">
                        <i class="far fa-calendar-alt"></i> Sana
                    </label>
                    <input
                        type="text"
                        id="date"
                        name="date"
                        placeholder="19-iyun, 2026"
                        value="<?= htmlspecialchars($blog['date']) ?>"
                        required>
                </div>

                <!-- Kategoriya -->
                <div class="form-group">
                    <label for="category">
                        <i class="fas fa-folder"></i> Kategoriya
                    </label>
                    <select id="category" name="category" required>
                        <option value="" disabled>Kategoriyani tanlang</option>
                        <?php
                        $categories = ['Sayohat', 'Ovqat', 'Texnologiya', 'Kitob', 'Sport', 'Salomatlik', 'Biznes'];
                        foreach ($categories as $cat):
                            $selected = ($blog['category'] === $cat) ? 'selected' : '';
                        ?>
                            <option value="<?= $cat ?>" <?= $selected ?>><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sarlavha -->
                <div class="form-group full-width">
                    <label for="title">
                        <i class="fas fa-heading"></i> Sarlavha
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        placeholder="Blog sarlavhasini kiriting"
                        value="<?= htmlspecialchars($blog['title']) ?>"
                        required>
                </div>

                <!-- Tavsif -->
                <div class="form-group full-width">
                    <label for="description">
                        <i class="fas fa-align-left"></i> Tavsif (description)
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Blog haqida qisqacha tavsif yozing..."
                        required><?= htmlspecialchars($blog['description']) ?></textarea>
                </div>

                <!-- Tugma matni -->
                <div class="form-group">
                    <label for="readMoreText">
                        <i class="fas fa-arrow-right"></i> "Batafsil" tugmasi matni
                    </label>
                    <input
                        type="text"
                        id="readMoreText"
                        name="readMoreText"
                        placeholder="Batafsil"
                        value="<?= htmlspecialchars($blog['readMoreText']) ?>"
                        required>
                </div>
            </div>

            <!-- Tugmalar -->
            <div class="form-actions">
                <a href="index.php" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Bekor qilish
                </a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save"></i> Yangilash
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript -->
    <script>
        function previewFile() {
            const fileInput = document.getElementById('image');
            const currentImage = document.getElementById('currentImage');
            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileNameIndicator = document.getElementById('fileNameIndicator');
            const fileNameText = document.getElementById('fileNameText');
            const file = fileInput.files[0];

            if (file) {
                // Fayl nomini ko'rsatish
                fileNameText.textContent = file.name;
                fileNameIndicator.classList.add('show');
                fileUploadArea.classList.add('has-file');

                // Joriy rasm o'rniga yangi rasmni ko'rsatish
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                // Qayta tiklash
                fileNameIndicator.classList.remove('show');
                fileUploadArea.classList.remove('has-file');
                // Asl rasmga qaytish
                currentImage.src = "<?= htmlspecialchars($displaySrc) ?>";
            }
        }
    </script>
</body>

</html>