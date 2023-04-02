<?php
//requreはineludeと違って実行できなかった時に処理がここで終了する
require_once __DIR__.'/../lib/functions.php';

// $_GET は、HTTP GET メソッドで送信された値を取得する変数
// クライアントからサーバーにデータを送信するHTTPメソッドには、GET と POST の両方がある
// HTTP GET メソッドでデータを送信するとURLパラメーターとしてデータが送信される
// URLパラメータとは、URLの後に「?(クエッション)」記号を記述して、その後 「key名=値」 と続けるクエリ文字列「http://sample.com/index.php?key名=値&key名=値&key名=値・・」
// HTTP GET メソッドでデータを送信する方法はHTML の <form>タグ か <a>タグ を利用
// <form>タグ を利用し HTTP GET メソッドでデータを送信には、method属性 を GET にする
// <a>タグ を利用し HTTP GET メソッドでデータを送信には、URLの後に「?(クエッション)」記号を記述して、その後 「key名=値」 と続ける
// <a>タグ で複数の値を送信する場合は「&(アンド)」で繋げる「http://sample.com/index.php?key名=値&key名=値&key名=値・・」とする
// $_GETは、連想配列として使用する
// URLパラメーターの「'key名'」は$_GETの連想配列「'key名'」となる $_GET['key名']
// $_GETは、urldecode()関数を介して値が渡される
// クライアントから HTTP GET で送信されたリクエスト結果の値は変化しない。従ってブックマークに登録しても同じ結果を得られる。HTTP POST で送信されたリクエスト結果の値は変化する場合がある。

// 入力値を変数に入れる
//functions.phpにおける「./question.php?id=●」の●(keyと呼ぶ)を取得。結果的には、$questionの連想配列の要素であるところの['id']を取得したことになる。
//「?? ''」はNull合体演算子と言い、クライアント側で何も指示がない/適切な指示がない場合に、''で囲まれた中身が実行される
$id = escape($_GET['id'] ?? '');  
// escape関数 = HTMLで読み込めるようにする。

//ここでCSVデータの１行分のデータを取ってくる
$data = fetchById($id);

//もし$dataにデータが入らない場合はPHPのコードを終了
if (!$data){
  error404();
}

//$dataで取ってきたデータを使える形(連想配列)にする
$formattedData = generateFormattedData($data);

// //nl2brはCSV上の改行をhtml上でも反映してくれる
// //htmlspecialcharsはcsv上のhtmlコードを有効にしない役割を果たす
// //上記2関数の処理順は、後者＞前者の順。後者でhtmlで読み込まれることを防ぎ、前者でCSVで残っている改行タグ等を生きた状態でhtmlに反映させる。
// $question = $formattedData['question'];
// //correctAnswerの右辺が入る(functions.php)。これは選択肢の内容。
// $answers = $formattedData['answers'];
// //正解のアルファベット
// $correctAnswer = $formattedData['correctAnswer'] ; 
// //”正解のアルファベットの”、answersの右辺が入る(functions.php)。つまりこれは、(正解のアルファベットに対応する)正解の選択肢が入る。
// $correctAnswerValue=$answers[$correctAnswer]; 
// $explanation = $formattedData['explanation'] ;

//$formattedDataで取得した1行分のデータの内、id,question,answers(選択肢)のみ取得し配列$assignDataに
$assignData = [
  'id' => $formattedData['id'],
  'question' => $formattedData['question'],
  'answers' => $formattedData['answers'],
];

//question.tpl.phpにて、$formattedData内のid,question,answersを変数$id,$question,$answersとして利用
loadTemplate('question', $assignData);


?>

