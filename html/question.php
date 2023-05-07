<?php

require_once __DIR__.'/../lib/functions.php';

//「?? ''」はNull合体演算子と言い、クライアント側で何も指示がない/適切な指示がない場合に、''で囲まれた中身が実行される
$id = escape($_GET['id'] ?? '');

// ここでCSVデータの１行分のデータを取ってくる
$data = fetchById($id);

//もし$dataにデータが入らない場合はPHPのコードを終了
if (!$data){
  error404();
}

//$dataで取ってきたデータを使える形(改行等有効、連想配列)にする
$formattedData = generateFormattedData($data);

// $formattedDataで取得した1行分のデータの内、id,question,answers(選択肢)のみ取得し配列$assignDataに
$assignData = [
  'id' => $formattedData['id'],
  'question' => $formattedData['question'],
  'answers' => $formattedData['answers'],
];

// question.tpl.phpにて、$formattedData内のid,question,answersを変数$id,$question,$answersとして利用
loadTemplate('question', $assignData);

?>
