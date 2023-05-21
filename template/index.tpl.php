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

        <h2>時間に関するクイズ一覧</h2>
        <ul>
            <!-- $questionsの出どころはindex.phpで全(行分の)データが、$questionには1行のデータが入っている -->
            <?php foreach($questions as $question): ?>
            <!-- functions.php-index.php-index.tpl.phpの連携により、$question['id']や$question['question']の表現が可能に -->
            <li><a href="./question.php?id=<?php echo $question['id']; ?>"><?php echo $question['question']; ?></a></li>
            <?php endforeach; ?>
        </ul>

        <form method="post" action="./calculate.php">
            <h2>体感寿命シミュレーション</h2>
            <img src="https://2.bp.blogspot.com/-ySXp7IOKvbA/U-8Fwdt8XsI/AAAAAAAAkxs/ax9ZIk6CYOk/s800/sunadokei.png" class='sunadokei'>
            <p class="ask-age">あなたの年齢は？(80歳まで生きると仮定します)</p>
            <input type="text" value="0" name="age">
            <span>歳</span>

            <div class="btn">
                <input type="submit" value="体感寿命を計算する" >
            </div>
        </form>

        <h2></h2>
        <a href="../html/history.html" class="history-link">★★★私の秘密(プログラミング学習歴)をご覧ください！★★★</a>

    </div>
</body>
</html>
