<?php

    /*
     * Задача #2
     *
     * Реализовать Тест Струпа
     * на экран вывести сообщение 5 строк по 5 слов в каждом
     * цвета|слова - red, blue, green, yellow, lime, magenta, black, gold, gray, tomato
     * цвет и слово не должны совпадать (например слово lime может быть покрашено в любой из цветов кроме lime), выбор цвета - случайный
     *
     *
     * */

    class RandomColorWords {

        private $listStr = [];
        private $listColor = [];

        public function getStrDefList() {
            return $this->listStr;
        }

        public function getColorDefList() {
            return $this->listColor;
        }

        public function addColor( $color ) {
            switch ( gettype( $color ) ) {
                case 'string': $this->listColor[] = $color;
                    break;
                case 'array': $this->listColor = array_merge( $this->listColor, $color );
            }
        }

        public function addWord( $word ) {
            switch ( gettype( $word ) ) {
                case 'string': $this->listStr[] = $word;
                break;
                case 'array': $this->listStr = array_merge( $this->listStr, $word );
            }
        }

        public function getListWordsColor() {
           $list = $this->listStr;
           $count = count($this->listColor) -1;
           foreach ($list as $listVal) {
               $color = rand(0, $count);
               echo '<span style="color: ' . $this->listColor[$color] . ' ">' . $listVal . '</span>';
           }
           echo '<br>';
        }
    }

    $randomColorWords = new RandomColorWords();
    $randomColorWords->addWord(['red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato']);
    $randomColorWords->addColor(['#FF6633', '#FFB399', '#FF33FF', '#FFFF99', '#00B3E6',
                                 '#E6B333', '#3366E6', '#999966', '#99FF99', '#B34D4D',
                                 '#80B300', '#809900', '#E6B3B3', '#6680B3', '#66991A',
                                 '#FF99E6', '#CCFF1A', '#FF1A66', '#E6331A', '#33FFCC',
                                 '#66994D', '#B366CC', '#4D8000', '#B33300', '#CC80CC',
                                 '#66664D', '#991AFF', '#E666FF', '#4DB3FF', '#1AB399',
                                 '#E666B3', '#33991A', '#CC9999', '#B3B31A', '#00E680',
                                 '#4D8066', '#809980', '#E6FF80', '#1AFF33', '#999933',
                                 '#FF3380', '#CCCC00', '#66E64D', '#4D80CC', '#9900B3',
                                 '#E64D66', '#4DB380', '#FF4D4D', '#99E6E6', '#6666FF']);

    for ($i = 0; $i < 5; $i++) {
        $randomColorWords->getListWordsColor();
    }