<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- question.phpで 404.tpl.php を読み込むため、cssはカレントディレクトリからの指定でよい -->
    <link rel="stylesheet" href="./style.css" type="text/css">
    <title>エラー時の表示(クイズの問題が見つからない or 年齢未入力)</title>
</head>
<body>
    <div id="main">
        <h1>エラー！</h1>
        <p>
            クイズの問題が見つからないか、適切な年齢が入力されていません。
        </p>
        <div class="section">
            <a href="./index.php">戻る</a>
        </div>
    </div>
</body>
</html>
