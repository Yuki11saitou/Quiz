<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- srcとhrefの違い：https://www.rekiwo.com/technology/20210520/ -->
    <!-- question.phpで「include __DIR__.'/../template/question.tpl.php';」としたため、jsとcssがカレントディレクトリから指定できる -->
    <link rel="stylesheet" href="./style.css" type="text/css">
    <!-- question.phpで「include __DIR__.'/../template/question.tpl.php';」としたため、jsとcssがカレントディレクトリから指定できる -->
    <!-- DOM構築後にJSリクエスト -->
    <script src="./questions.js" defer></script>      
    <!-- $idは読み込み先のquestion.phpで定義 -->
    <title>問題<?php echo $id; ?> | Quiz!</title>
</head>
<body>
    <!-- 「id」は一つのHTML内で一つしか付けられない名前 -->
    <div id="main">
        <h1>Quiz!</h1>

        <!-- 「class」は一つのHTML内で複数存在してもよい名前 -->
        <div class="section">
            <h2>問題<?php echo $id; ?></h2>
            <p>
                <!-- $questionは読み込み先のquestion.phpで定義 -->
                <?php echo $question; ?>        
            </p>

            <h3>選択肢</h3>
            <ol class="answers" data-id="<?php echo $id; ?>">
                <?php foreach($answers as $key => $value): ?>
                    <!-- functions.php - quesition.php - quesiton.tpl.php と繫がり、'A'のような要素を$key、連想配列 escape($data[2])のような要素を$valueと置いている -->
                    <li data-answer="<?php echo $key; ?>"><?php echo $value; ?></li>
                <?php endforeach; ?>
            </ol>
        </div>

        <div id="section-correct-answer" class="section">
            <h2>答え</h2>
            <p>
                <span id="correct-answer"></span><br />
                <span id="explanation"></sapn>
            </p>
        </div>

        <div class="section">
            <a href="./index.php">戻る</a>
        </div>

    </div>
</body>
</html>