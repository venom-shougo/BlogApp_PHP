<?php

require_once('blog.php');
use Blog\blog\Blog;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    (int)$id = $_GET['id'];
    if (empty($id)) {
        exit('不正アクセス');
    }
    $blog = new blog();
    $blog->Delete($id);
}
?>
<div><a href="/">戻る</a></div>
