<?php

require_once('blog.php');
use Blog\blog\Blog;

$blog = new Blog();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
</head>

<body>
    <h2>ブログ一覧</h2>
    <div><a href="blogForm.php">ブログ新規作成</a></div>
    <table>
        <tr>
            <th>タイトル</th>
            <th>カテゴリ</th>
            <th>投稿日時</th>
        </tr>
        <?php foreach ($blog->getAll() as $value) : ?>
            <tr>
                <td><a href="detail.php?id=<?= Blog::h($value['id']); ?>"><?= Blog::h($value['title']); ?></a></td>
                <td><?= Blog::h($blog->setCategoryName($value['category'])); ?></td>
                <td><?= Blog::h($value['post_at']); ?></td>
                <td><a href="updateForm.php?id=<?= Blog::h($value['id']); ?>">編集</a></td>
                <td><a href="deleteForm.php?id=<?= Blog::h($value['id']); ?>">削除</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
