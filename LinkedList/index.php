<?php

require('LinkedList.php');

$list = new LinkedList();

$list->append(0);
$list->append(1);
$list->append(2);
$list->append(3);
$list->append(5);
$list->append(6);

echo 'size = ' . $list->size() . '<br>';

$list->insert(99, 'TESTE');



echo $list . PHP_EOL;
// echo 'size = ' . $list->size();
// echo 'is empty = ' . $list->isEmpty();

?>

<h1>Teste</h1>