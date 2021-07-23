<?php

/*==============================[Variables]==============================*/

$arStr = array();//массив для переработки

$strExp = $_POST['expression'];

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','root');
define('DB_NAME','brackets_bd');
$obMySql = @new mysqli(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);
/*==============================[Exception handling]==============================*/
if ($obMySql -> connect_error) exit('ошибка подключения к БД');
$obMySql->set_charset('utf8');
/*==============================[Processing variables]==============================*/
/*==============================[Logic]==============================*/
function doBracketsValidation($str) {
    // пары открывающих-закрывающих скобок
    $arrBr = "..(){}[]<>";
    $br = str_split($arrBr);
    $st = array();
    for ($i = 0; $i < strlen($str); $i++) {
        $ch = $str[$i];
        $ind = array_search($ch,$br);
        if ($ind >= 0 && $ind!=false) {
            if(!($ind%2) == 0){
                // проверяем, какая это скобка
                if (!count($st)) return false;
                $last_br = array_pop($st);
                // если она не соответствует закрывающей скобке - тоже плохо
                if ($last_br != $br[$ind - 1]) return false;
            }
            else {
                // открывающую скобку просто пихаем в стек
                array_push($st,$ch);
            }
        }
    }
    // если после обхода всей строки стек пуст - всё ок
    return true;
}
if (doBracketsValidation($strExp) == false){
    $strResult =  "валидация не пройдена";
}
else {
    $strResult = "валидация пройдена";
}
//скидываем результаты в бд
$obMySql->query("INSERT INTO results (expression, result) VALUE ('$strExp', '$strResult')");
//берем данные для печати
$ob_DB =  $obMySql->query("SELECT * FROM results");

foreach ($ob_DB as $key => $value){
    $arStr[$key] = $value;
}

print_r(json_encode($arStr));
$obMySql->close();