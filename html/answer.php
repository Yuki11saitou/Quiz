<?php

require_once __DIR__.'/../lib/functions.php';

// $_POST は HTTP POST で渡された値を取得する変数
// クライアントからサーバーにデータを送信するHTTPメソッドには、GET と POST の両方がある
// HTTP POST メソッドでデータを送信する方法はHTML の <form>タグ の 属性 を POST にする
// $_POST は 連想配列として使用する
// クライアントから HTTP GET で送信されたリクエスト結果の値は変化しない。従ってブックマークに登録しても同じ結果を得られる。HTTP POST で送信されたリクエスト結果の値は変化する場合がある。
// 入力値を変数に入れる
$id = $_POST['id'] ?? '';
$selectedAnswer = $_POST['selectedAnswer'] ?? '';

//ここでCSVデータの１行分のデータを取ってくる
$data=fetchById($id);

//もし$dataにデータが入らない場合はPHPのコードを終了
if (!$data){
  // HTTPレスポンスのヘッダを404にする
  header('HTTP/1.1 404 Not Found');
  // レスポンスの種類を指定する（jsonコードが読めるように）
  header('Content-Type: application/json; charset=UTF-8');
  
  $response = [
    'message' => 'The specified id could not be found',
  ];
  //json_encode()でPHPのコードをJSで読み込めるようになる
  echo json_encode($response);

  exit(0);
}


$formattedData = generateFormattedData($data);

//nl2brはCSV上の改行をhtml上でも反映してくれる
//htmlspecialcharsはcsv上のhtmlコードを有効にしない役割を果たす
//上記2関数の処理順は、後者＞前者の順。後者でhtmlで読み込まれることを防ぎ、前者でCSVで残っている改行タグ等を生きた状態でhtmlに反映させる。

//アルファベット
$correctAnswer = $formattedData['correctAnswer'] ;
//正解の選択肢
$correctAnswerValue=$formattedData['answers'][$correctAnswer] ;
//説明
$explanation = $formattedData['explanation'] ;


//本来IF文で書いてもよいが、こういう書き方もある。選択した回答と答えが合っているか照合
$result = $selectedAnswer === $correctAnswer;

$response = [
  'result' => $result,
  'correctAnswer'=> $correctAnswer,
  'correctAnswerValue'=> $correctAnswerValue,
  'explanation'=> $explanation,
];

// レスポンスの種類を指定する（jsonコードになるように）
header('Content-Type: application/json; charset=UTF-8');
//json_encode()でPHPのコードをJSで読み込めるようになる
echo json_encode($response);

?>