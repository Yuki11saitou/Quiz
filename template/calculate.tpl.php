<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- question.phpで「include __DIR__.'/../template/question.tpl.php';」としたため、jsとcssがカレントディレクトリから指定できる -->
    <link rel="stylesheet" href="./style.css" type="text/css">

    <!-- $idは読み込み先のquestion.phpで定義 -->
    <title>体感寿命シミュレーション</title>
</head>
<body>
    <!-- 「id」は一つのHTML内で一つしか付けられない名前 -->
    <div id="main">
        <h1>体感寿命シミュレーション</h1>

        <form method="post" action="./calculate.php">
            <h2>あなたの体感寿命は残りどれくらい？</h2>
            <img src="https://2.bp.blogspot.com/-ySXp7IOKvbA/U-8Fwdt8XsI/AAAAAAAAkxs/ax9ZIk6CYOk/s800/sunadokei.png" class='sunadokei'>
            <p class="ask-age">あなたの年齢は？(80歳まで生きると仮定します。)</p>
            <input type="text" value="<?php echo $_POST['age'] ; ?>" name="age">
            <span>歳</span>

            <div class="btn">
                <input type="submit" value="体感寿命を計算する" name="calculate">
            </div>
        </form>

        <p class="life-span">残りの体感寿命は、全体の</p>
        <input type="text" value="<?php calculateLifeSpan($_POST['age']); ?>" name="remaining-life">
        <span>%</span>

        <div class="section">
            <a href="./index.php">戻る</a>
        </div>

    </div>
</body>
</html>
