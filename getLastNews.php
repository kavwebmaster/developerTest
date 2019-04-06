<?php
$_SERVER['DOCUMENT_ROOT'] = __DIR__;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
while (ob_get_level())
    ob_end_flush();

$result = \Project\Helpers\RssHelper::getLentaNews();

/** @var SimpleXMLElement $xmlNewsItem */
foreach (array_slice($result, 0, 5) as $xmlNewsItem){
    echo $xmlNewsItem->title.PHP_EOL;
    echo $xmlNewsItem->link.PHP_EOL;
    echo trim($xmlNewsItem->description).PHP_EOL.PHP_EOL;
}
