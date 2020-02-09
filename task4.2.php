<?php

if (empty( $_POST['team']))
    exit();

include 'vendor/simple-html-dom/simple-html-dom/simple_html_dom.php';

$html = file_get_html('https://terrikon.com/football/italy/championship/');

$pageNews = $html->find('.news');
$strHtml = str_get_html($pageNews[1]);

for ( $i = 0; $i < 11; $i++ ) {

    $child_html = file_get_html("https://terrikon.com/" . $strHtml->find('a', $i)->href );
    $child_page_news = $child_html->find('.colored');
    $children = str_get_html($child_page_news[0]);
    for ($n = 1; $n < 20; $n++) {
        $children_str_get_html = str_get_html($children->find('tr', $n));
        if( $children_str_get_html->find('a', 0)->plaintext == $_POST['team']) {
            $header = str_get_html($children->find('tr', 0));
            echo $header->find('th',2) . '<br>';
            echo $children_str_get_html . '<br>';
        }
    }
}


?>
