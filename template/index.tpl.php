<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css" type="text/css">
    <title>Quiz!</title>
</head>
<body>
    <div id="main">
        <h1>Quiz!</h1>
    
        <h2>問題一覧</h2>
        <ul>
            <!-- $questionsの出どころはindex.phpで全(行分の)データが、$questionには1行のデータが入っている -->
            <?php foreach($questions as $question): ?>
            <!-- functions.php-index.php-index.tpl.phpの連携により、$question['id']や$question['question']の表現が可能に -->
            <li><a href="./question.php?id=<?php echo $question['id']; ?>"><?php echo $question['question']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>