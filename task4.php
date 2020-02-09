<?php

/*
   * Задача #4
   *
   * Используя https://simplehtmldom.sourceforge.io/ сделать скрипт, который достаёт из Архива результатов Серии А все места заданной команды по сезонам (Например Удинезе)
   * https://terrikon.com/football/italy/championship/ 
   * Передача имени команды осуществляется через POST-форму 
   *
   * */


include 'vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

// Create DOM from URL or file
$html = file_get_html('https://terrikon.com/football/italy/championship/');

$pageNews = $html->find('.news');
$strHtml = str_get_html($pageNews[1]);
$srtTeams = $html->find('.grouptable',0);
$srtTeamsList = str_get_html($srtTeams);

?>

<form action="task4.2.php" method="post">

    <select name="team">
        <?php
            for ($i = 0; $i < 20; $i++) {
                echo "<option name=" . $srtTeamsList->find('a', $i)->plaintext . ">" , $srtTeamsList->find('a', $i)->plaintext . '</option>';
            }
        ?>
    </select>

    <button>Отправить</button>
</form>



