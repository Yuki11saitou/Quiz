<?php

require_once __DIR__.'/../lib/functions.php';

// 回答フォームに入力された「回答の問題に対応するid」と「回答(A,B,C,D)」を受け取る。
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
