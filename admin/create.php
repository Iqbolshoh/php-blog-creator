<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: login.php");
    exit;
}

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validatsiya
    if (empty($_FILES['image']['name'])) {
        $errorMessage = "Rasmni tanlang!";
    } elseif ($_FILES['image']['size'] > 5 * 1024 * 1024) {
        $errorMessage = "Rasm hajmi 5 MB dan oshmasligi kerak!";
    } elseif (empty($_POST['alt'])) {
        $errorMessage = "Rasm uchun alt matni kiriting!";
    } elseif (empty($_POST['date'])) {
        $errorMessage = "Sana kiriting!";
    } elseif (empty($_POST['category'])) {
        $errorMessage = "Kategoriyani tanlang!";
    } elseif (empty($_POST['title'])) {
        $errorMessage = "Sarlavha kiriting!";
    } elseif (empty($_POST['description'])) {
        $errorMessage = "Tavsif kiriting!";
    } elseif (empty($_POST['readMoreText'])) {
        $errorMessage = "Batafsil tugmasi matnini kiriting!";
    } else {
        // Rasm yuklash
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetFile = '../uploads/' . $fileName;

        if (!is_dir('../uploads/')) {
            mkdir('../uploads/', 0755, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $blogs = json_decode(file_get_contents('../data/blogs.json'), true);

            if (!is_array($blogs)) {
                $blogs = [];
            }

            // Yangi ID: mavjud ID larning eng kattasidan 1 ta katta
            $maxId = 0;
            foreach ($blogs as $b) {
                if (isset($b['id']) && (int)$b['id'] > $maxId) {
                    $maxId = (int)$b['id'];
                }
            }
            $newId = $maxId + 1;

            $blogs[] = [
                'id' => $newId,
                'image' => 'uploads/' . $fileName,
                'alt' => $_POST['alt'],
                'date' => $_POST['date'],
                'category' => $_POST['category'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'readMoreText' => $_POST['readMoreText']
            ];

            file_put_contents('../data/blogs.json', json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            header("Location: index.php");
            exit;
        } else {
            $errorMessage = "Faylni yuklashda xatolik yuz berdi!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yangi blog yaratish | Admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/create-edit.css">
</head>

<body>

    <!-- Xatolik xabari -->
    <?php if (!empty($errorMessage)): ?>
        <div class="error-toast" id="errorToast">
            <i class="fas fa-exclamation-circle"></i>
            <?= htmlspecialchars($errorMessage) ?>
            <button class="close-toast" onclick="document.getElementById('errorToast').remove()">&times;</button>
        </div>
    <?php endif; ?>

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
            <h1>Yangi blog yaratish</h1>
            <p>Barcha maydonlarni to'ldiring va saqlash tugmasini bosing</p>
        </div>

        <!-- Form -->
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-grid">
                <!-- Rasm yuklash -->
                <div class="form-group full-width">
                    <label>
                        <i class="fas fa-image"></i> Rasm yuklash
                    </label>
                    <div class="file-upload-area" id="fileUploadArea">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span class="upload-text">Rasm tanlash uchun bosing</span>
                        <span class="upload-hint">JPG, PNG yoki WEBP (max 5MB)</span>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg, image/png, image/webp"
                            onchange="previewFile()">
                    </div>
                    <img id="imagePreview" class="image-preview" alt="Rasm oldindan ko'rish">
                    <span class="file-name" id="fileName">
                        <i class="fas fa-check-circle"></i>
                        <span id="fileNameText"></span>
                    </span>
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
                        value="<?= isset($_POST['alt']) ? htmlspecialchars($_POST['alt']) : '' ?>">
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
                        value="<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '' ?>">
                </div>

                <!-- Kategoriya -->
                <div class="form-group">
                    <label for="category">
                        <i class="fas fa-folder"></i> Kategoriya
                    </label>
                    <select id="category" name="category">
                        <option value="" disabled selected>Kategoriyani tanlang</option>
                        <?php
                        $categories = ['Sayohat', 'Ovqat', 'Texnologiya', 'Kitob', 'Sport', 'Salomatlik', 'Biznes'];
                        foreach ($categories as $cat):
                            $selected = (isset($_POST['category']) && $_POST['category'] === $cat) ? 'selected' : '';
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
                        value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
                </div>

                <!-- Tavsif -->
                <div class="form-group full-width">
                    <label for="description">
                        <i class="fas fa-align-left"></i> Tavsif (description)
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Blog haqida qisqacha tavsif yozing..."><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
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
                        value="<?= isset($_POST['readMoreText']) ? htmlspecialchars($_POST['readMoreText']) : 'Batafsil' ?>">
                </div>
            </div>

            <!-- Tugmalar -->
            <div class="form-actions">
                <a href="index.php" class="btn btn-cancel">
                    <i class="fas fa-times"></i> Bekor qilish
                </a>
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save"></i> Saqlash
                </button>
            </div>
        </form>
    </div>

    <!-- Rasm oldindan ko'rish JavaScript -->
    <script>
        function previewFile() {
            const fileInput = document.getElementById('image');
            const preview = document.getElementById('imagePreview');
            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileNameEl = document.getElementById('fileName');
            const fileNameText = document.getElementById('fileNameText');
            const file = fileInput.files[0];

            if (file) {
                fileNameText.textContent = file.name;
                fileNameEl.classList.add('show');
                fileUploadArea.classList.add('has-file');

                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('show');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.remove('show');
                preview.src = '';
                fileNameEl.classList.remove('show');
                fileUploadArea.classList.remove('has-file');
            }
        }
    </script>
</body>

</html>