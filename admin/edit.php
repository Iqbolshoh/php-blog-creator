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
    <link rel="stylesheet" href="../assets/create-edit.css">
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