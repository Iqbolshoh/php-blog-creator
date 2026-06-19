<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: login.php");
    exit;
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
                            required
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
                        required>
                </div>

                <!-- Kategoriya -->
                <div class="form-group">
                    <label for="category">
                        <i class="fas fa-folder"></i> Kategoriya
                    </label>
                    <select id="category" name="category" required>
                        <option value="" disabled selected>Kategoriyani tanlang</option>
                        <option value="Sayohat">Sayohat</option>
                        <option value="Ovqat">Ovqat</option>
                        <option value="Texnologiya">Texnologiya</option>
                        <option value="Kitob">Kitob</option>
                        <option value="Sport">Sport</option>
                        <option value="Salomatlik">Salomatlik</option>
                        <option value="Biznes">Biznes</option>
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
                        required></textarea>
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
                        value="Batafsil"
                        required>
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
                // Fayl nomini ko'rsatish
                fileNameText.textContent = file.name;
                fileNameEl.classList.add('show');
                fileUploadArea.classList.add('has-file');

                // Rasm oldindan ko'rish
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.add('show');
                };
                reader.readAsDataURL(file);
            } else {
                // Tozalash
                preview.classList.remove('show');
                preview.src = '';
                fileNameEl.classList.remove('show');
                fileUploadArea.classList.remove('has-file');
            }
        }
    </script>
</body>

</html>