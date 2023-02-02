<?php

require_once('blog.php');
use Blog\blog\Blog;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogUpDate = $_POST;
    $blog = new blog();
    $blog->ValidateForm($blogUpDate);
    $registrationResult = $blog->blogUpdate($blogUpDate);
    echo $registrationResult;
}
?>
<div><a href="/">戻る</a></div>
