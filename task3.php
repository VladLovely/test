<?php

/*
 *
 * 3. Реализовать консольный скрипт на php, который в качестве параметра будет принимать строку из разделённых между собой натуральных чисел.
 *  Выводит этот же массив отсортированный в порядке возрастания.
 *   Во входной строке числа разделены как минимум одним пробелом, в сортировке участвуют только числа
 *   Пример команды в консоли - php 3.php “1 -2 -3 4 5 -f ss3 0 0 0 -0 0.0 0.05”
 *   Результат: -3 -2 0 1 4 5 
 *
 * */

if (!empty($argv[1])) {
    $srt = $argv[1];
} else {
    $srt = 'dsfdsfdsf ddfgdfgdfg 435 sfd 23234 sdf23 0 -234 -5345345 -3434534 -234234';
}


$wordsList = ( preg_split('/ /', $srt) );
$listNumber = [];

foreach ( $wordsList as $wordsListVal ) {
    $statusStr = false;
    $strProperty = '';
    $strValideLen = 0;
    for ( $i = 0; $i < strlen($wordsListVal); $i++ ) {
        for ( $n = 0; $n < 10; $n++ ) {
            $f = $n;
            $f .= '';
            if ( $wordsListVal[$i] == $f ||
                $wordsListVal[$i] == '-'
            ) {
                $strProperty .= $wordsListVal[$i];
                break;
            }
        }
    }
    $listNumber[] = $strProperty;
}

//unset
foreach ( $listNumber as $listNumberKey => $listNumberItem ) {
    if ( empty( $listNumberItem ) || $listNumberItem == '-' )
        unset($listNumber[$listNumberKey]);
}

sort($listNumber);

print_r($listNumber);