<?php

require_once __DIR__.'/../lib/functions.php';

$age = $_POST['age'];
// 齋藤の年齢
$myAge = 26;

if ($age<0 || $age>80){
  error404();
} elseif ($age == $myAge){
  print '<br><a href="./history.html" class="blinking-text">★★★私と同い年のあなた！是非私のプログラミング学習歴もご覧ください！★★★</a></br>';
}

loadTemplate('calculate');

?>
