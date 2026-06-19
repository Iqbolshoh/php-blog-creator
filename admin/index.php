<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: login.php");
    exit;
}

$blogs = json_decode(file_get_contents('../data/blogs.json'), true);
?>

<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog boshqaruvi | Admin panel</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/admin.css">
</head>

<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <h1>
                <i class="fas fa-newspaper"></i>
                Blog boshqaruvi
            </h1>
            <div class="header-actions">
                <a href="dashboard.php" class="btn btn-back">
                    <i class="fas fa-arrow-left"></i> Orqaga
                </a>
                <a href="create.php" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Yangi blog yaratish
                </a>
                <a href="logout.php" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Chiqish
                </a>
            </div>
        </div>

        <!-- Jadval -->
        <div class="table-wrapper">
            <div class="table-scroll">
                <?php if (!empty($blogs)) : ?>
                    <table>
                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Rasm</th>
                                <th>Sana</th>
                                <th>Kategoriya</th>
                                <th>Sarlavha</th>
                                <th>Tavsif</th>
                                <th>Tugma matni</th>
                                <th>Harakatlar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($blogs as $i => $blog) : ?>
                                <tr>
                                    <td><strong><?= $i + 1 ?></strong></td>
                                    <td class="td-image">
                                        <img src="<?= htmlspecialchars($blog['image']) ?>" alt="<?= htmlspecialchars($blog['alt']) ?>">
                                    </td>
                                    <td class="td-date">
                                        <i class="far fa-calendar-alt" style="color:#b47c5a; margin-right:4px;"></i>
                                        <?= htmlspecialchars($blog['date']) ?>
                                    </td>
                                    <td>
                                        <span class="category-badge"><?= htmlspecialchars($blog['category']) ?></span>
                                    </td>
                                    <td class="td-title"><?= htmlspecialchars($blog['title']) ?></td>
                                    <td class="td-desc"><?= htmlspecialchars($blog['description']) ?></td>
                                    <td><?= htmlspecialchars($blog['readMoreText']) ?></td>
                                    <td>
                                        <div class="action-btns">
                                            <!-- Edit tugmasi -->
                                            <a href="edit.php?id=<?= $i ?>" class="btn btn-edit">
                                                <i class="fas fa-pen-to-square"></i> Tahrirlash
                                            </a>
                                            <!-- Delete form -->
                                            <form action="delete.php" method="POST" class="delete-form" onsubmit="return confirm('Rostdan ham ushbu blogni o\'chirmoqchimisiz?');">
                                                <input type="hidden" name="id" value="<?= $i ?>">
                                                <button type="submit" class="btn btn-delete">
                                                    <i class="fas fa-trash-can"></i> O'chirish
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <p>Hozircha hech qanday blog mavjud emas.</p>
                        <a href="create.php" class="btn btn-primary" style="margin-top:1rem;">
                            <i class="fas fa-plus-circle"></i> Birinchi blogni yaratish
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>