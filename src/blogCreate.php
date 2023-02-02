<?php

require_once('blog.php');
use Blog\blog\Blog;



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $blogCreate = $_POST;
    $blog = new blog();
    $blog->ValidateForm($blogCreate);
    $registrationResult = $blog->blogCreate($blogCreate);
    echo $registrationResult;
}

?>
