<?php

require_once('blog.php');
use Blog\blog\Blog;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    (int) $id = $_GET['id'];
    if (empty($id)) {
        exit('不正アクセス');
    }
    $blog = new blog();
    $result = $blog->getById($id);
}
$id = $result['id'];
$title = $result['title'];
$content = $result['content'];
$category = (int)$result['category'];
$publish_status = (int)$result['publish_status'];

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ作成</title>
</head>

<body>
    <h2>ブログ更新フォーム</h2>
    <form action="blogUpDate.php" method="post">
        <input type="hidden" name="id" value="<?= Blog::h($id); ?>">
        <div>ブログタイトル</div>
        <input type="text" name="title" value="<?= Blog::h($title); ?>">
        <div>ブログ本文</div>
        <textarea name="content" id="content" cols="30" rows="10"><?= $content; ?></textarea>
        <div>カテゴリ</div>
        <select name="category">
            <option value="0">選択してください</option>
            <option value="1" <?php if ($category === IDENTIFY_BLOG_CATEGORY)
                echo Blog::h('selected'); ?>>ブログ</option>
            <option value="2" <?php if ($category === IDENTIFY_DAILY_CATEGORY)
                echo Blog::h('selected'); ?>>プログラミング</option>
            <option value="3" <?php if ($category === IDENTIFY_OTHERS_CATEGORY)
                echo Blog::h('selected'); ?>>その他</option>
        </select><br>
        <input type="radio" name="publish_status" value="1" <?php if ($publish_status === PUBLIC_NUMBER)
                echo Blog::h('checked'); ?>>公開
        <input type="radio" name="publish_status" value="2" <?php if ($publish_status === PRIVATE_NUMBER)
                echo Blog::h('checked'); ?>>非公開
        <br>
        <button type="submit">登録</button>
    </form>
    <div><a href="/">戻る</a></div>
</body>

</html>
