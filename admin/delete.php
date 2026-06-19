<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: login.php");
    exit;
}

$blogs = json_decode(file_get_contents('../data/blogs.json'), true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    foreach ($blogs as $i => $b) {
        if ($b['id'] == $id) {

            $imagePath = '../uploads/' . $b['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            unset($blogs[$i]);
            $blogs = array_values($blogs);
            file_put_contents('../data/blogs.json', json_encode($blogs));
            header("Location: index.php");
            exit;
        }
    }
}
