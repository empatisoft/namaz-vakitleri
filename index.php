<?php
/**
 * Developer: ONUR KAYA
 * Contact: empatisoft@gmail.com
 */

define('DIR', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'].DIR);

require_once ROOT.'vendor'.DIR.'autoload.php';
require_once ROOT.'Diyanet.php';

$diyanet = new Diyanet();

/**
 * Üç adet parametre alır.
 * URI: Namaz vaktinin alınacağı ilçenin url adres bilgisi
 * PERIOD: monthly veya weekly değerlerini girebilirsiniz. Aylık veya haftalık olarak çeker.
 * TYPE: Çıktı türü. 0: JSON, 1: Object, 2: Array
 */
$data = $diyanet->getData('tr-TR/9541/istanbul-icin-namaz-vakti', 'monthly', 0);
echo '<pre>';
print_r($data);
echo '</pre>';