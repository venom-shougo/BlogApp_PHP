<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ作成</title>
</head>

<body>
    <h2>ブログフォーム</h2>
    <form action="blogCreate.php" method="post">
        <div>ブログタイトル</div>
        <input type="text" name="title">
        <div>ブログ本文</div>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <div>カテゴリ</div>
        <select name="category">
            <option value="0">選択してください</option>
            <option value="1">ブログ</option>
            <option value="2">プログラミング</option>
            <option value="3">その他</option>
        </select><br>
        <input type="radio" name="publish_status" value="1">公開
        <input type="radio" name="publish_status" value="2">非公開
        <br>
        <button type="submit">登録</button>
    </form>
    <div><a href="index.php">戻る</a></div>
</body>

</html>
