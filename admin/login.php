<?php
session_start();

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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        form {
            width: 300px;
            border: 1px solid black;
            border-radius: 15px;
            padding: 40px 70px;
        }

        form input {
            width: 100%;
            margin: 5px;
            padding: 5px;
        }

        form button {
            width: 100%;
            margin: 7px;
            padding: 8px 15px;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <form action="" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="raqamcha" placeholder="raqamcha" style="width: 50%;">
        <p style="font-size: 28px;font-weight: bold;letter-spacing: 8px;transform: rotate(-3deg);user-select: none;-webkit-user-select: none;cursor: default;font-family: monospace; "
            oncopy="return false"
            oncut="return false"
            oncontextmenu="return false">
            <?= $_SESSION['raqamcha'] ?>
        </p>
        <button type="submit">Kirish</button>
    </form>

</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['username'])) {
        echo "<p style='color:red'>Username maydonini to'ldiring!</p>";
        exit;
    }

    if (strlen($_POST['username']) < 3) {
        echo "<p style='color:red'>Username kamida 3 ta belgidan iborat bo'lishi kerak!</p>";
        exit;
    }

    if (!preg_match('/^[a-z0-9_]+$/', $_POST['username'])) {
        echo "<p style='color:red'>Username faqat a-z, 0-9 va _ belgilaridan iborat bo'lishi mumkin!</p>";
        exit;
    }

    if (empty($_POST['password'])) {
        echo "<p style='color:red'>Password maydonini to'ldiring!</p>";
        exit;
    }

    if (strlen($_POST['password']) < 8) {
        echo "<p style='color:red'>Password kamida 8 ta belgidan iborat bo'lishi kerak!</p>";
        exit;
    }

    if (empty($_POST['raqamcha'])) {
        echo "<p style='color:red'>Raqamcha maydonini to'ldiring!</p>";
        exit;
    }

    if ($_SESSION['raqamcha'] != $_POST['raqamcha']) {
        echo "<p style='color:red'>Raqamcha xato!</p>";
        exit;
    }

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username !== $userName) {
        echo "<p style='color:red'>Bunaqa foydalanuvchi mavjud emas!</p>";
        exit;
    }

    if ($userPassword !== $password) {
        echo "<p style='color:red'>Parol xato!</p>";
        exit;
    }

    $_SESSION['logined'] = true;
    $_SESSION['username'] = $userName;
    header("Location: ./index.php");
    exit;
}
?>