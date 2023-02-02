<?php

require_once('blog.php');
use Blog\blog\Blog;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    (int)$id = $_GET['id'];
    if (empty($id)) {
        exit('不正アクセス');
    }
    $blog = new blog();
    $result = $blog->getById($id);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ詳細</title>
</head>

<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル：<?= $result['title']; ?></h3>
    <p>投稿日時：<?= $result['post_at']; ?></p>
    <p>カテゴリ：<?= $blog->setCategoryName($result['category']); ?></p>
    <hr>
    <p>本文：<?= $result['content']; ?></p>
    <div><a href="/">戻る</a></div>
</body>

</html>
