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

$id = $_GET['id']; // String yoki integer bo'lishi mumkin
$blogs = json_decode(file_get_contents('../data/blogs.json'), true);

// Blogni ID bo'yicha topish
$blog = null;
$blogIndex = null;
foreach ($blogs as $i => $b) {
    if ((string)$b['id'] === (string)$id) {
        $blog = $b;
        $blogIndex = $i;
        break;
    }
}

// Blog topilmasa
if ($blog === null) {
    header("Location: index.php");
    exit;
}

$message = '';
$messageType = '';
$errorMessage = '';

// Form yuborilganda
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validatsiya
    if (empty($_POST['alt'])) {
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
        // Rasmni saqlash
        $imagePath = $blog['image']; // Eski rasm

        // Yangi rasm yuklangan bo'lsa
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && !empty($_FILES['image']['name'])) {
            // Fayl hajmi tekshirish
            if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                $errorMessage = "Rasm hajmi 5 MB dan oshmasligi kerak!";
            } else {
                // Eski rasmni o'chirish
                if (!empty($blog['image']) && strpos($blog['image'], 'http') !== 0) {
                    $oldFile = '../' . $blog['image'];
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $targetFile = '../uploads/' . $fileName;

                if (!is_dir('../uploads/')) {
                    mkdir('../uploads/', 0755, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'uploads/' . $fileName;
                }
            }
        }

        if (empty($errorMessage)) {
            // Ma'lumotlarni yangilash
            $blogs[$blogIndex] = [
                'id' => $blog['id'],
                'image' => $imagePath,
                'alt' => $_POST['alt'],
                'date' => $_POST['date'],
                'category' => $_POST['category'],
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'readMoreText' => $_POST['readMoreText']
            ];

            file_put_contents('../data/blogs.json', json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            // Yangilangan blogni qayta o'qish
            $blog = $blogs[$blogIndex];
            $message = "Blog muvaffaqiyatli yangilandi!";
            $messageType = "success";
        }
    }
}

// Rasm yo'lini aniqlash
$imageSrc = $blog['image'];
if (strpos($imageSrc, 'http') === 0) {
    $displaySrc = $imageSrc;
} else {
    $displaySrc = '../' . $imageSrc;
}
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
            <h1>Blogni tahrirlash</h1>
            <p>ID: <?= htmlspecialchars($id) ?> - "<?= htmlspecialchars($blog['title']) ?>"</p>
        </div>

        <!-- Muvaffaqiyat xabari -->
        <?php if ($message): ?>
            <div class="success-toast" id="successToast">
                <i class="fas fa-check-circle"></i>
                <?= htmlspecialchars($message) ?>
                <button class="close-toast" onclick="document.getElementById('successToast').remove()">&times;</button>
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
                        value="<?= htmlspecialchars($blog['alt']) ?>">
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
                        value="<?= htmlspecialchars($blog['date']) ?>">
                </div>

                <!-- Kategoriya -->
                <div class="form-group">
                    <label for="category">
                        <i class="fas fa-folder"></i> Kategoriya
                    </label>
                    <select id="category" name="category">
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
                        value="<?= htmlspecialchars($blog['title']) ?>">
                </div>

                <!-- Tavsif -->
                <div class="form-group full-width">
                    <label for="description">
                        <i class="fas fa-align-left"></i> Tavsif (description)
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Blog haqida qisqacha tavsif yozing..."><?= htmlspecialchars($blog['description']) ?></textarea>
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
                        value="<?= htmlspecialchars($blog['readMoreText']) ?>">
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
        const originalSrc = "<?= htmlspecialchars($displaySrc) ?>";

        function previewFile() {
            const fileInput = document.getElementById('image');
            const currentImage = document.getElementById('currentImage');
            const fileUploadArea = document.getElementById('fileUploadArea');
            const fileNameIndicator = document.getElementById('fileNameIndicator');
            const fileNameText = document.getElementById('fileNameText');
            const file = fileInput.files[0];

            if (file) {
                fileNameText.textContent = file.name;
                fileNameIndicator.classList.add('show');
                fileUploadArea.classList.add('has-file');

                const reader = new FileReader();
                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                fileNameIndicator.classList.remove('show');
                fileUploadArea.classList.remove('has-file');
                currentImage.src = originalSrc;
            }
        }
    </script>
</body>

</html>