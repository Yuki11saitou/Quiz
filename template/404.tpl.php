<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- question.phpで「include __DIR__.'/../template/404.tpl.php';」としたため、jsとcssがカレントディレクトリから指定できる -->
    <link rel="stylesheet" href="./style.css" type="text/css">

    <title>問題 | Quiz!</title>
</head>
<body>
    <div id="main">
        <h1>Quiz!</h1>

        <p>
            クイズの問題が見つかりませんでした。
        </p>

        <div class="section">
            <a href="./index.php">戻る</a>
        </div>
    </div>
</body>
</html>