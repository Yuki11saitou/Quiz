<?php

require_once __DIR__.'/../lib/functions.php';

$age = $_POST['age'];

if ($age<0 || $age>80){
  error404();
}

loadTemplate('calculate');

?>
