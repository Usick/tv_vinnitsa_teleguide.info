<?php
/**
 *Список телеканалов и id'шек
 *300061 ТК Мега
 *300039 Канал 1+1
 *300038 Первый национальный (Украина)
 *300059 ICTV (Украина)
 *315 Новый Канал
 *300016 Интер
 *319 ТЕТ
 *300062 НТН (Украина)
 *300077 К1
 *314 М-1
 *318 СТБ
 *300058 5 канал (Украина)
 *321 Украина
 *300046 2+2 (кино)
 *$ids = '(314|315|318|319|321|300016|300038|300039|300046|300058|300059|300061|300062|300077)';
 */

$ids = '(3(1[4-5,8-9]|21|0{3}(16|3[8-9]|46|5[8-9]|6[1-2]|77)))';
$handle = fopen('xmltv.xml', 'r');
//Выводить только список каналов?
$only_channels = false;
$pattern = $only_channels ? '/<channel id=.*>/' : '/<.*channel.*="' . $ids . '">/';

//Выводим "шапку" xmltv'шки
echo '<?xml version="1.0" encoding="utf-8" ?><!DOCTYPE tv SYSTEM "http://www.teleguide.info/download/xmltv.dtd">', PHP_EOL;
echo '<tv generator-info-name="TVH_W/0.751l" generator-info-url="http://www.teleguide.info/">', PHP_EOL;
//Выводим "тело"
while ($temp = (fgets($handle))) {
    if (preg_match($pattern, $temp, $matches)) {
        echo $matches[0], PHP_EOL;
        while (!preg_match('/<\/(programme|channel)>/', $temp)) {
            $temp = fgets($handle);
            echo $temp;
        };
    };
}
//Выводим закрывающий тэг
echo '</tv>', PHP_EOL;
fclose($handle);
