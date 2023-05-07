<?php
//requreはineludeと違って実行できなかった時に処理がここで終了。require_onceは一度だけ読み込むことを明示して、再読み込みによる変数の再定義等を避ける目的アリ。
require_once __DIR__.'/../lib/functions.php';

//ここでCSVデータの全"行"分のデータを取ってくる。
$dataList = fetchAll();

//もし$dataListにデータが入らない場合はPHPのコードを終了
if (!$dataList){
  error404();
}

//読み込んだ全(行分の)データを配列にしている
$questions = [];
foreach($dataList as $data){
  //1行に含まれる一つ一つの列別データが、連想配列になるように。というのを各行繰り返す。
  // $questions[]に、配列['id','question','answers'['A','B','C','D'],'correctAnswer','explanation']が入っていく(改行等考慮済み)
  $questions[] = generateFormattedData($data);
}

$assignData = [
  //これにより、$assignData = ['questions' => $questions(これはCSVから持ってきた全(行分の)データ)]となり'question'を変数$questionとして使えるようになる。
  'questions' => $questions,
];

//$questionsの情報だけを、index.tpl.phpを読み込んで適用する = index.tpl.phpにて$questionsが使えるようになる
loadTemplate('index', $assignData);

?>
