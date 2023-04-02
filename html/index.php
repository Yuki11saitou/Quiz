<?php
//requreはineludeと違って実行できなかった時に処理がここで終了する
//require_onceは一度だけ読み込むことを明示して、再読み込みによる変数の再定義等を避ける目的アリ。
require_once __DIR__.'/../lib/functions.php';

//ここでCSVデータの全"行"分のデータを取ってくる
$dataList = fetchAll();

//もし$dataListにデータが入らない場合はPHPのコードを終了
//index.php-functions.php-404.tpl.phpを使用
if (!$dataList){
  error404();
}

//読み込んだ全(行分の)データを配列にしている
$questions = [];
foreach($dataList as $data){
  //1行に含まれる一つ一つの列別データが、連想配列になるように。というのを各行繰り返す。
  // generateFormattedDataによって配列['id','question','answers'['A','B','C','D'],'correctAnswer','explanation']が返される
  $questions[] = generateFormattedData($data);
}

$assignData = [
  //これにより、$assignData = ['questions' => $questions(これはCSVから持ってきた全(行分の)データ)]となり
  // 'question'を変数$questionとして使えるようになる。
  //こんなことしなくても、loadTemplate()の第二引数で$questionsとすればいいのだが、functions.phpにて汎用性を持たせるため$assignDataを用いたくて、やっている。
  'questions' => $questions,
];

//$questionsの情報だけを、index.tpl.phpを読み込んで適用する = index.tpl.phpにて$questionsが使えるようになる
loadTemplate('index', $assignData);


?>