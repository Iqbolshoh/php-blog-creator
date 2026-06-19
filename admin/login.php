<?php
session_start();

// Barcha PHP mantiqiy kodlar HTML dan oldin bo'lishi kerak
if (isset($_SESSION['logined']) && $_SESSION['logined'] === true) {
    header("Location: ./index.php");
    exit;
}

if (empty($_SESSION['raqamcha'])) {
    $_SESSION['raqamcha'] = substr(uniqid(), -5);
}

// standart Login Parol 
$userName = 'admin';
$userPassword = '12345678';

// Xatolik xabarini saqlash uchun
$errorMessage = '';

// Form yuborilganda tekshirish
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['username'])) {
        $errorMessage = "Username maydonini to'ldiring!";
    } elseif (strlen($_POST['username']) < 3) {
        $errorMessage = "Username kamida 3 ta belgidan iborat bo'lishi kerak!";
    } elseif (!preg_match('/^[a-z0-9_]+$/', $_POST['username'])) {
        $errorMessage = "Username faqat a-z, 0-9 va _ belgilaridan iborat bo'lishi mumkin!";
    } elseif (empty($_POST['password'])) {
        $errorMessage = "Password maydonini to'ldiring!";
    } elseif (strlen($_POST['password']) < 8) {
        $errorMessage = "Password kamida 8 ta belgidan iborat bo'lishi kerak!";
    } elseif (empty($_POST['raqamcha'])) {
        $errorMessage = "Raqamcha maydonini to'ldiring!";
    } elseif ($_SESSION['raqamcha'] != $_POST['raqamcha']) {
        $errorMessage = "Raqamcha xato!";

        // Raqamchani yangilash (xato kiritilganda)
        $_SESSION['raqamcha'] = substr(uniqid(), -5);
    } else {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if ($username !== $userName) {
            $errorMessage = "Bunaqa foydalanuvchi mavjud emas!";
        } elseif ($userPassword !== $password) {
            $errorMessage = "Parol xato!";
        } else {
            // Muvaffaqiyatli login
            $_SESSION['logined'] = true;
            $_SESSION['username'] = $userName;
            header("Location: ./index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/login.css">
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

    <form action="" method="post">
        <!-- Icon -->
        <div class="login-icon">
            <i class="fas fa-lock"></i>
        </div>

        <!-- Sarlavha -->
        <h2 class="login-title">Xush kelibsiz</h2>
        <p class="login-subtitle">Admin panelga kirish</p>

        <!-- Username -->
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>

        <!-- Password -->
        <div class="input-group">
            <i class="fas fa-key"></i>
            <input type="password" name="password" placeholder="Password">
        </div>

        <!-- Raqamcha -->
        <div class="captcha-row">
            <div class="input-group">
                <i class="fas fa-shield-alt"></i>
                <input type="text" name="raqamcha" placeholder="Raqamchani kiriting">
            </div>
            <p class="captcha-code"
                oncopy="return false"
                oncut="return false"
                oncontextmenu="return false">
                <?= $_SESSION['raqamcha'] ?>
            </p>
        </div>

        <!-- Tugma -->
        <button type="submit">
            <i class="fas fa-sign-in-alt"></i> Kirish
        </button>

        <!-- Footer -->
        <p class="login-footer">
            <i class="far fa-copyright"></i> 2026 BlogMania Admin
        </p>
    </form>

</body>

</html>