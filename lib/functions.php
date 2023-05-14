<?php

//テンプレートファイルの読み込みを$filenameを使うことで自由度を持たせる
function loadTemplate($filename, array $assignData = []){
    // extract();は、()内の文字を変数として使用できるようになる便利なもの。例えば、今回 $assignData = ['apple' => 'りんご']; とすれば、今後$apple (='りんご')として使用できるというもの
    extract($assignData);
    include __DIR__.'/../template/'.$filename.'.tpl.php';
}


function error404(){
    // HTTPレスポンスのヘッダを404にする
    header('HTTP/1.1 404 Not Found');
    // レスポンスがHTML形式であり、文字セットはUTF-8であることを指定
    header('Content-Type: text/html; charset=UTF-8');

    loadTemplate('404');

    exit(0);
}


function fetchAll() {
    //CSVファイルを開く
    $handler = fopen(__DIR__.'/data.csv','r');
    //データを取得
    $questions = [];
    while($row = fgetcsv($handler)){
      if (isDataRow($row)){
        //$questionsの空配列に次々と値を入れていく
        $questions[] = $row ;
      }
    }
    //ファイルを閉じる
    fclose($handler);
    //データを返す = 質問データの全配列が$questionsに代入される
    return $questions;
  }


function fetchById($id) {
  //CSVファイルを開く
  $handler = fopen(__DIR__.'/data.csv','r');
  //データを取得
  //$idの定義はquestion.phpでしている
  $question = [];
  while($row = fgetcsv($handler)){
    if (isDataRow($row)){
      //csvの$row[0]が$idと等しければ以下を実行
      if ($row[0] === $id){
        $question = $row ;
        break;
      }
    }
  }
  //ファイルを閉じる
  fclose($handler);
  //データを返す = $idが決定されれば、それに対応した一行の質問データの配列が$questionに代入される
  return $question;
}


function isDataRow(array $row){
    // データの項目数(1行のCSVデータにおける列数)が足りているか判定
    if (count($row) !== 8) {
        return false;
    }
    // データの項目の中身がすべて埋まっているか確認する（$row:配列名、$value:要素）
    foreach ($row as $value) {
        // 項目の値が空か判定
        if (empty($value)) {
            return false;
        }
    }
    // idの項目が数字ではない場合は無視する
    if (!is_numeric($row[0])) {
        return false;
    }
    // 小文字を大文字に変換
    $correctAnswer = strtoupper($row[6]);
    // 正しい答えはa,b,c,dのどれか
    $availableAnswers = ['A', 'B', 'C', 'D'];
    //左が対象となるデータ、右が参照データ
    if (!in_array($correctAnswer, $availableAnswers)) {
        return false;
    }
    // すべてチェックが問題なければtrue
    return true;
}


function generateFormattedData($data){
    // 構造化した配"列"を作成する
    //question.phpにて「$data=fetchById($id)」と定義
    $formattedData = [
        'id' => escape($data[0]),
        'question' => escape($data[1], true),
        'answers' => [
            //これは選択肢の問題に該当。escape関数は下で定義。
            'A' => escape($data[2]),
            'B' => escape($data[3]),
            'C' => escape($data[4]),
            'D' => escape($data[5]),
        ],
        'correctAnswer' => escape(strtoupper($data[6])),
        'explanation' => escape($data[7], true),
    ];
    return $formattedData;
}


//第2引数の方は、右辺にこのように記載することで「何もなければfalse」という処理になる。即ち、$formattedDataの中の'question'及び'explanation'の場合だけは true = CSV内での改行がそのまま生き残る ということになる。
function escape($data, $nl2br = false) {
    // HTMLに埋め込んでも大丈夫な文字に変換する($data内で意図せずhtmlの文法として解釈されることを防ぐ)
    $convertedData = htmlspecialchars($data, ENT_HTML5);
    // 改行コードを<br>タグに変換するか判定
    if ($nl2br) {
        /// 改行コードを<br>タグに変換したものを返却
        return nl2br($convertedData);
    }
    return $convertedData;
}


// 体感寿命を算出する
function calculateLifeSpan($age){
  // 生まれてから現在の年齢($age)までの体感時間[年] (実経過時間は$age)
  $experienceTime = log($age+1);
  // 80歳まで生きると仮定
  $lifeSpan = 80;
  // 生まれてから死ぬまでの体感時間[年]
  $experienceLifeSpan = log($lifeSpan+1);
  // 残りの体感寿命[%]を出力
  $remainingExperienceLifeSpan = ($experienceLifeSpan-$experienceTime)/($experienceLifeSpan);
  echo round($remainingExperienceLifeSpan*100,2);
}

; ?>
